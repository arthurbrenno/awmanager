<?php

namespace App\Core\Controllers;
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_clean();

use App\Core\Models\Database\Dao\AvatarDAO;
use App\Core\Models\Database\Dao\UserDAO;
use App\Core\Utils\ViewRenderer;
use Framework\Http\Response;

class DashboardController
{
    public static function dashboard(): Response
    {
        $user = self::checkAuthentication();

        $email = $user["email"];
        $userId = $user["id"];
        $userName = UserDAO::getUserName($email);
        $avatarUrl = AvatarDAO::getUserAvatarUrl($userId);
        $tasks = UserDAO::getUserTasks($email);

        $priorityClasses = [
            'Baixa' => 'bg-blue-100 text-blue-800',
            'Media' => 'bg-yellow-100 text-yellow-800',
            'Alta'  => 'bg-red-100 text-red-800'
        ];

        $htmlTasks = $tasks->reduce(function ($carry, $task) use ($priorityClasses) {
            return $carry . ViewRenderer::renderRawViewWithParams('layout/task', [
                    "titulo"     => $task->title,
                    "descricao"  => $task->description,
                    "prioridade" => $task->priority,
                    "id"         => $task->id,
                    "cor"        => $priorityClasses[$task->priority],
                ]);
        }, '');

        $content = ViewRenderer::renderPage('dashboard', [
            "titulo"           => "Dashboard",
            "nome"             => $userName,
            "tarefas"          => $htmlTasks,
            "modalCriarTarefa" => ViewRenderer::renderRawView('layout/modals/createtask'),
            "avatarUrl"        => $avatarUrl,
        ], 'layout/dashboardheader', '');

        return new Response($content);
    }

    private static function checkAuthentication()
    {
        if (!isset($_SESSION["email"]) || !isset($_SESSION["id"])) {
            header("Location: /login?erro=Você%20precisa%20logar%20primeiro");
            exit;
        }

        return [
            "email" => $_SESSION["email"],
            "id"    => $_SESSION["id"],
        ];
    }




}
