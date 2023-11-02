<?php

namespace App\Core\Controllers;

use App\Core\Utils\Validators\GoogleLoginValidator;
use App\Core\Utils\ViewRenderer;
use Config\Config;
use CurlHandle;
use Framework\Http\Response;
use Google\Client;
use Google\Exception;
use Google\Service\Oauth2;

class SignUpController
{
    public static function signup(): Response
    {
        $erro         = $_GET["erro"] ?? '';
        $code         = $_GET["code"] ?? null;
        $googleStatus = $_GET["gstatus"] ?? '';
        $url          = GoogleLoginValidator::getClientAuthUrl();

        $content = ViewRenderer::renderPage(
            'cadastro',
            ["titulo" => "Sign Up", "erro" => $erro, "errogoogle" => $googleStatus, "authurl" => $url],
            'layout/loginheader'
        );
        return new Response($content);
    }


}