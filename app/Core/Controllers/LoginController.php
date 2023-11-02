<?php

namespace App\Core\Controllers;

use App\Core\Utils\Validators\GoogleLoginValidator;
use App\Core\Utils\ViewRenderer;
use Config\Config;
use Framework\Http\Constants\StatusCodes;
use Framework\Http\Response;
use Google\Client;
use Google\Service\Iam\Status;
use Google\Service\Oauth2;

class LoginController
{
    public static function login(): Response
    {
        $erro    = $_GET['erro'] ?? '';
        $gUrl    = GoogleLoginValidator::getClientAuthUrl();
        $gitHubClientSecret = json_decode(file_get_contents(dirname(__DIR__, 3) . '/config/Client/gith.json'), true)["id"];
        $githubScope = 'read:user%20user:email';
        $content = ViewRenderer::renderPage(
            'login',
            [
                'titulo'       => 'Área de login',
                'erro'         => $erro,
                'authurl'      => $gUrl,
                'githubsecret' => $gitHubClientSecret,
                'githubscope'  => $githubScope
            ],
            'layout/loginheader');
        return new Response($content);
    }

    public static function logout(): Response
    {
        session_destroy();
        return new Response(null, StatusCodes::OK, ['Location' => '/dashboard']);
    }

}