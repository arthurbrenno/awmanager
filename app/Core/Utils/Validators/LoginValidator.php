<?php

namespace App\Core\Utils\Validators;
ob_start();
session_start();
ob_clean();
use App\Core\Models\Database\Dao\UserDAO;
use Framework\Http\Constants\StatusCodes;
use Framework\Http\Response;
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_clean();
class LoginValidator
{
    public static function validateLogin(): Response
    {

        $email    = $_POST['email']    ?? '';
        $password = $_POST['password'] ?? '';
        self::validateFields($email, $password);

        if (!UserDAO::validateUserLogin($email, $password))
        {
            return new Response('', StatusCodes::OK, ['Location' => '/login?erro=Credenciais%20inválidas.']);
        }

        self::startSession($email);
        return self::redirectToDashboard();
    }

    private static function startSession($email): void
    {
        $_SESSION["email"] = $email;
        $id = UserDAO::getId($email);
        $_SESSION["id"] = $id;
    }

    private static function redirectToDashboard(): Response
    {
        return new Response(null, StatusCodes::OK, ['Location' => '/dashboard']);
    }

    public static function validateFields($email, $password): void
    {
        if (empty($email) || empty($password)) {
            header('Location: /login?erro=Email e senha são obrigatórios');
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: /login?erro=Email inválido');
            exit();
        }
    }
}