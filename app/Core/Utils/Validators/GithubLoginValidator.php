<?php

namespace App\Core\Utils\Validators;

use App\Core\Models\Database\Dao\UserDAO;
use App\Core\Models\Database\Entities\Avatar;
use App\Core\Models\Database\Entities\User;
use Config\Config;
use Framework\Http\Constants\StatusCodes;
use Framework\Http\Response;

class GithubLoginValidator
{
    public static function validateGithubLogin(): Response
    {
        $authCode = $_GET['code'] ?? '';

        if (!$authCode) {
            return new Response(null, StatusCodes::BAD_REQUEST, ['Location' => '/']);
        }

        $authData = self::authenticateWithGithub($authCode);

        if (!isset($authData['access_token'])) {
            return new Response(null, StatusCodes::BAD_REQUEST, ['Location' => '/']);
        }

        $accessToken = $authData['access_token'];
        $user = self::getUserData($accessToken);

        $name = $user['login'];
        $email = $user['id'];

        if (!UserDAO::userExists($email)) {
            self::createNewUser($name, $email);
        }

        self::setSessionData($email);

        return new Response(null, StatusCodes::OK, ['Location' => '/dashboard']);
    }

    private static function authenticateWithGithub($authCode): array
    {
        $clientConfig = json_decode(file_get_contents(dirname(__DIR__, 4) . '/config/Client/gith.json'), true);

        $data = [
            'client_id'     => $clientConfig["id"],
            'client_secret' => $clientConfig["secret"],
            'code'          => $authCode
        ];

        $ch = curl_init('https://github.com/login/oauth/access_token');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'User-Agent: awmanager'
        ]);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }

    private static function getUserData(string $accessToken): array
    {
        $curl = curl_init('https://api.github.com/user');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
            'User-Agent: awmanager'
        ]);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response, true);
    }

    private static function createNewUser($name, $email): void
    {
        $user = new User([
            "name"  => $name,
            "email" => $email,
        ]);

        $user->save();

        $id = UserDAO::getId($email);
        $randomAvatar = rand(0, Config::MAX_PROFILE_PICTURES);

        $avatar = new Avatar([
            "url"     => "https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/{$randomAvatar}.webp",
            "user_id" => $id
        ]);

        $avatar->save();
    }

    private static function setSessionData($email): void
    {
        $_SESSION["email"] = $email;
        $_SESSION["id"] = UserDAO::getId($email);
    }
}
