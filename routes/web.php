<?php

use App\Core\Controllers\DashboardController;
use App\Core\Controllers\HomeController;
use App\Core\Controllers\LoginController;
use App\Core\Controllers\NotFoundController;
use App\Core\Controllers\SignUpController;
use App\Core\Controllers\SubscriptionsController;
use App\Core\Utils\Validators\GithubLoginValidator;
use App\Core\Utils\Validators\GoogleLoginValidator;
use App\Core\Utils\Validators\LoginValidator;

return [
    ['GET', '/', [HomeController::class, 'home']],
    ['GET', '/login', [LoginController::class, 'login']],
    ['GET', '/signup', [SignUpController::class, 'signup']],
    ['GET', '/dashboard', [DashboardController::class, 'dashboard']],
    ['GET', '/glogin', [GoogleLoginValidator::class, 'validateGoogleLogin']],
    ['GET', '/gitlogin', [GithubLoginValidator::class, 'validateGithubLogin']],
    ['GET', '/logout', [LoginController::class, 'logout']],
    ['GET', '/notfound', [NotFoundController::class, 'notFound']],
    ['GET', '/subscriptions',  [SubscriptionsController::class, 'subscriptions']]
];