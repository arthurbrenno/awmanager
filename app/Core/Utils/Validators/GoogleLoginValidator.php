<?php

namespace App\Core\Utils\Validators;

use App\Core\Models\Database\Dao\UserDAO;
use App\Core\Models\Database\Entities\Avatar;
use App\Core\Models\Database\Entities\User;
use Config\Config;
use Exception;
use Framework\Http\Constants\StatusCodes;
use Framework\Http\Response;
use Google\Client;
use Google\Service\Oauth2;

/**
 * Classe para validar o login com o Google.
 */
class GoogleLoginValidator
{
    /**
     * Valida o login com o Google.
     *
     * @return Response
     * @throws \Google\Exception
     */
    public static function validateGoogleLogin(): Response
    {
        if (!isset($_GET["code"])) {
            header("Location: /login?erro=Ocorreu%20um%20erro%20ao%20tentar%20logar%20com%20o%20Google");
            exit;
        }

        $client = self::instantiateClient();
        $client->fetchAccessTokenWithAuthCode($_GET["code"]);

        $google_oauth = new Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        $email = $google_account_info->email;
        $name = $google_account_info->name;

        if (!UserDAO::userExists($email)) {
            $user = new User([
                "name" => $name,
                "email" => $email,
            ]);

            $user->save();

            $randomAvatar = rand(0, Config::MAX_PROFILE_PICTURES);
            $avatar = new Avatar([
                "url" => "https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/{$randomAvatar}.webp",
                "user_id" => UserDAO::getId($email)
            ]);
            $avatar->save();
        }

        self::startSession($email, UserDAO::getId($email));
        return self::redirectToDashboard();
    }

    /**
     * Obtém a URL de autenticação do cliente Google.
     *
     * @return string
     */
    public static function getClientAuthUrl(): string
    {
        try {
            $client = self::instantiateClient();
            return $client->createAuthUrl();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Redireciona para a página do painel de controle.
     *
     * @return Response
     */
    private static function redirectToDashboard(): Response
    {
        return new Response(null, StatusCodes::OK, ['Location' => '/dashboard']);
    }

    /**
     * Inicia uma sessão com o email e ID do usuário.
     *
     * @param string $email
     * @param int $id
     */
    private static function startSession($email, $id): void
    {
        $_SESSION["email"] = $email;
        $_SESSION["id"] = $id;
    }

    /**
     * Instancia e configura o cliente Google.
     *
     * @return Client
     * @throws \Google\Exception
     */
    private static function instantiateClient(): Client
    {
        $client = new Client();
        $client->setAuthConfig(Config::GOOGLE_CREDENTIALS);
        $client->setScopes('https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile');
        $client->setRedirectUri('http://localhost:3000/glogin');
        return $client;
    }
}
