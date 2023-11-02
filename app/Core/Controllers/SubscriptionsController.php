<?php

namespace App\Core\Controllers;

use App\Core\Utils\ViewRenderer;
use Framework\Http\Response;

class SubscriptionsController
{
    public static function subscriptions(): Response
    {
        $content = ViewRenderer::renderPage('subscriptions', ['titulo' => 'Subscriptions']);
        return new Response($content);
    }
}