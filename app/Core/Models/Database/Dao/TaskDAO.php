<?php

namespace App\Core\Models\Database\Dao;

use Framework\Http\Constants\StatusCodes;
use Framework\Http\Response;
use Illuminate\Database\Capsule\Manager as Capsule;

ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_clean();
class TaskDAO
{
    public static function createTask(): Response
    {
        if (!isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['priority'])) {
            return new Response(null, StatusCodes::OK, ['Location' => '/dashboard?erro=Todos%20os%20campos%20são%20obrigatórios']);
        }

        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $userId = $_SESSION['id'];

        $taskId = Capsule::table('tasks')->insertGetId([
            'title' => $title,
            'description' => $description,
            'status' => 'Pendente',
            'priority' => $priority,
            'user_id' => $userId,
        ]);

        $priorityClasses = [
            'Baixa' => 'bg-blue-100 text-blue-800',
            'Media' => 'bg-yellow-100 text-yellow-800',
            'Alta'  => 'bg-red-100 text-red-800'
        ];

        $color = $priorityClasses[$priority];

        $content = <<<CONTENT
            <div class="formContainer {$color} rounded-lg shadow-md p-6 transform transition-all hover:scale-105">
                <form method="post" action="/updatetask">
                    <input type="hidden" name="taskId" value="{$taskId}">
                    <textarea name="title" class="text-2xl font-semibold text-black mb-2 bg-transparent border-none outline-none resize-none h-20 w-5/6">{$title}</textarea>
                    <textarea name="description" class="text-gray-500 bg-transparent border-none outline-none resize-none h-20 w-5/6">{$description}</textarea>
                </form>
                <form method="post" action="/deltask">
                    <input type="hidden" name="id" value="{$taskId}">
                    <div class="flex justify-end mt-4">
                        <button class="deleteButton w-8 h-8 rounded-full bg-gray-500 flex items-center justify-center hover:bg-gray-900 transition-colors duration-300" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        CONTENT;

        return new Response($content, StatusCodes::OK);
    }


    public static function deleteTask(): Response
    {
        if (!isset($_POST['id'])) {
            return new Response('', StatusCodes::OK);
        }

        $id = $_POST['id'];
        $userId = $_SESSION['id'];

        Capsule::table('tasks')->where('id', $id)->where('user_id', $userId)->delete();

        return new Response(null, StatusCodes::OK);
    }

    public static function updateTask(): Response
    {
        if (!isset($_POST['taskId']) || !isset($_POST['title']) || !isset($_POST['description'])) {
            return new Response(null, StatusCodes::OK);
        }

        $taskId      = $_POST['taskId'];
        $title       = $_POST['title'];
        $description = $_POST['description'];

        Capsule::table('tasks')->where('id', $taskId)
            ->update([
                "title" => $title,
                "description" => $description,
            ]);

        return new Response(null, StatusCodes::OK);
    }

}
