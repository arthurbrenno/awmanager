<?php

namespace App\Core\Models\Database\Dao;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Collection;

ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_clean();
class UserDAO
{
    public static function getUserTasks($email): Collection
    {
        $user = Capsule::table('users')
            ->where('email', $email)
            ->first();

        $id = $user->id;

        $tasks = Capsule::table('tasks')
            ->where('user_id', $id)
            ->get();

        return $tasks;
    }

    public static function getUserName($email)
    {
        $user = Capsule::table('users')
            ->where('email', $email)
            ->first();

        return $user->name;
    }

    public static function userExists(string $email): bool
    {
        $user = Capsule::table('users')
            ->where('email', $email)
            ->first();

        return $user !== null;
    }

    public static function validateUserLogin($email, $password): bool
    {
        $user = Capsule::table('users')
            ->where('email', $email)
            ->first();

        if ($user === null || !password_verify($password, $user->password)){
            return false;
        }

        return true;
    }

    public static function getId(string $email): string
    {
        $user = Capsule::table('users')
            ->where('email', $email)
            ->first();

        if ($user === null) return '';

        return $user->id;
    }


}