<?php

namespace App\Core\Utils;

use Config\Config;

class ViewRenderer
{

    public static function renderPage(string $view, array $params = [], string $header = 'layout/header', string $footer = 'layout/footer'): string
    {
        $mainLayout   = self::renderRawView('layout/main'); //new

        $viewContents = str_replace(
            [
                Config::HEADER_PATTERN,
                Config::FOOTER_PATTERN,
                Config::CONTENT_PATTERN
            ],
            [
                self::renderRawView($header),
                self::renderRawView($footer),
                self::renderRawView($view)
            ],
            $mainLayout
        );

        if (!empty($params)) 
        {
            $opening = Config::VIEW_OPENING_PATTERN;
            $closing = Config::VIEW_CLOSING_PATTERN;

            foreach ($params as $key => $value)
            {
                $viewContents = str_replace(
                    $opening . $key . $closing,
                    $value,
                    $viewContents
                );
            }
        }

        return $viewContents;
    }

    public static function renderRawView(string $view): string
    {
        $view = Config::VIEWS_PATH . $view . '.php';
        if (!file_exists($view)) {
            return '';
        }

        return file_get_contents($view);
    }

    public static function renderRawViewWithParams(string $view, array $params = []): string
    {
        $viewContents = self::renderRawView($view);
        return self::replaceParams($viewContents, $params);
    }

    private static function replaceParams(string $viewContents, array $params = []): string
    {
        $opening = Config::VIEW_OPENING_PATTERN;
        $closing = Config::VIEW_CLOSING_PATTERN;

        foreach ($params as $key => $value)
        {
            $viewContents = str_replace(
                $opening . $key . $closing,
                $value,
                $viewContents
            );
        }

        return $viewContents;
    }
}
