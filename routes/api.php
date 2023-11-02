<?php


use App\Core\Models\Database\Dao\AvatarDAO;
use App\Core\Models\Database\Dao\TaskDAO;
use App\Core\Utils\Validators\LoginValidator;
use App\Core\Utils\Validators\SignupValidator;

return [
    ['POST', '/signupvalidator', [SignupValidator::class, 'validateSignUp']],
    ['POST', '/loginvalidator', [LoginValidator::class, 'validateLogin']],
    ['POST', '/createtask', [TaskDAO::class, 'createTask']],
    ['POST', '/deltask', [TaskDAO::class, 'deleteTask']],
    ['POST', '/updatetask', [TaskDAO::class, 'updateTask']],
    ['POST', '/changeavatar', [AvatarDAO::class, 'changeAvatar']]
    //['GET', '/task/{id:\d+}', [HomeController::class, 'index']]
];
