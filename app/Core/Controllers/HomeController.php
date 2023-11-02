<?php

namespace App\Core\Controllers;

use App\Core\Utils\ViewRenderer;
use Framework\Http\Response;

class HomeController
{
    public static function home(): Response
    {

        $content = ViewRenderer::renderPage('home', ['titulo' => 'Home']);
        return new Response($content);
    }
}
