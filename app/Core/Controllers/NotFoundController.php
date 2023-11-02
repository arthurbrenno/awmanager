<?php

namespace App\Core\Controllers;

use App\Core\Utils\ViewRenderer;
use Framework\Http\Response;

class NotFoundController
{
    public static function notFound(): Response
    {
        $content = ViewRenderer::renderPage(view: '_404',params:  ["titulo" => "Não encontrado"],header: 'layout/loginheader',footer: '');
        return new Response($content);
    }
}