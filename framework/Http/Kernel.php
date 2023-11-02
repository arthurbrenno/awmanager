<?php

namespace Framework\Http;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

readonly class Kernel
{
    public function handle(Request $request): Response
    {
        $dispatcher = simpleDispatcher(function(RouteCollector $routeCollector) {
            $webRoutes = require_once BASE_PATH . '/routes/web.php';
            $apiRoutes = require_once BASE_PATH . '/routes/api.php';

            foreach ($webRoutes as $webRoute) {
                $routeCollector->addRoute(...$webRoute);
            }

            foreach ($apiRoutes as $apiRoute) {
                $routeCollector->addRoute(...$apiRoute);
            }

        });

        $routeInfo = $dispatcher->dispatch(
            $request->getMethod(),
            $request->getPathInfo()
        );

        if ($routeInfo[0] === Dispatcher::NOT_FOUND) {
            header('Location: /notfound');
            exit;
        }

        [, [$controller, $method], $vars] = $routeInfo;

        $response = call_user_func_array([new $controller(), $method], $vars);
        return $response;
    }
}
