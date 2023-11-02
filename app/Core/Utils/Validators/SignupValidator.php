<?php

namespace App\Core\Utils\Validators;

use App\Core\Models\Database\Entities\Avatar;
use App\Core\Models\Database\Entities\User;
use App\Core\Models\Database\Dao\UserDAO;
use Config\Config;
use Framework\Http\Constants\StatusCodes;
use Framework\Http\Response;
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_clean();
class SignupValidator
{

    public static function googleSignUp()
    {

    }

    public static function validateSignUp(): Response
    {
        $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';

        if (empty($recaptchaResponse) || !self::validateRecaptcha($recaptchaResponse)) {
            return new Response('', StatusCodes::OK, ['Location' => '/signup?erro=Por%20favor,%20complete%20o%20reCAPTCHA.']);
        }

        $name         = $_POST["name"];
        $email        = $_POST["email"];
        $password     = $_POST["password"];
        $passwordConf = $_POST["passwordConfirmation"];

        self::validateFields($name, $email, $password, $passwordConf);
        self::validateEmail($email);
        self::validatePassword($password, $passwordConf);

        $user = new User([
            "name" => $name,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT)
        ]);

        $user->save();

        $randomAvatar = rand(0, Config::MAX_PROFILE_PICTURES);
        $avatar = new Avatar([
            "url" => "https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/{$randomAvatar}.webp",
            "user_id" => UserDAO::getId($email)
        ]);
        $avatar->save();

        self::startSession($email);
        return self::redirectToDashboard();
    }

    private static function validateRecaptcha($response): bool
    {
        $secretKey = '6LdHhq8oAAAAAD4PrMAvLbNmIx9C2bpil5YC6lcn';
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => $secretKey,
            'response' => $response
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result);

        return $response->success;
    }

    private static function startSession($email): void
    {
        $_SESSION["email"] = $email;
        $id = UserDAO::getId($email);
        $_SESSION["id"] = $id;
    }

    private static function redirectToDashboard(): Response
    {
        return new Response('', StatusCodes::OK, ['Location' => '/dashboard']);
    }


    private static function validateEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: /signup?erro=Email%20inválido");
        }

        if (UserDAO::userExists($email))
        {
            header("Location: /signup?erro=Email%20já%20em%20uso");
        }
    }

    private static function validatePassword($password, $passwordConf): void
    {
        if ($password !== $passwordConf) {
            header("Location: /signup?erro=Senhas%20não%20coincidem");
            exit();
        }
        //must contain one lowercase letter, one uppercase letter, one digit, one special character, and be at least 8 characters long
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);


        if(!$uppercase) {
            header("Location: /signup?erro=Senha%20deve%20conter%20letra%20maiúscula");
            exit();
        }

        if(!$lowercase) {
            header("Location: /signup?erro=Senha%20deve%20conter%20letra%20minúscula");
            exit();
        }
        if(!$number) {
            header("Location: /signup?erro=Senha%20deve%20conter%20número");
            exit();
        }

        if(strlen($password) < 8) {
            header("Location: /signup?erro=Senha%20deve%20conter%20no%20mínimo%208%20caracteres");
            exit();
        }
    }

    private static function validateFields($name, $email, $password, $passwordConfirmation): void
    {
        if (empty($name) || empty($email) || empty($password) || empty($passwordConfirmation))
        {
            header("Location: /signup?erro=Todos%20os%20campos%20são%20obrigatórios");
            exit();
        }
    }

}