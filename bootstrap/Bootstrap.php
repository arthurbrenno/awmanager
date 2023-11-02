<?php

namespace Bootstrap;

use App\Core\Models\Database\Migrations\AvatarMigration;
use App\Core\Models\Database\Migrations\ProjectMigration;
use App\Core\Models\Database\Migrations\TaskMigration;
use App\Core\Models\Database\Migrations\UserMigration;
use Config\Config;
use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;
use PDO;

readonly class Bootstrap
{

    public static function start(): void
    {
        self::setupSessionSecurity();
        self::setupCapsule();
        self::migrate();
    }

    private static function setupCapsule(): void
    {
        $capsule = new Capsule();
        $config = parse_ini_file(Config::DB_CONFIG_PATH);

        $databaseName = $config['database'];
        $pdo = new PDO("mysql:host={$config['host']};port={$config['port_number']}", $config['username'], $config['password']);

        if ($pdo->exec("CREATE DATABASE IF NOT EXISTS $databaseName") === false) {
            throw new Exception($pdo->errorInfo()[2]);
        }

        $pdo = null;

        $capsule->addConnection($config);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }




    private static function setupSessionSecurity(): void
    {
        ini_set('session.use_only_cookies', 1);
        ini_set('session.use_strict_mode', 1);
        session_set_cookie_params([
            "lifetime" => 3600,
            "domain"   => "localhost",
            "path"     => "/",
            "secure"   => false,
            "httponly" => true
        ]);
        session_start();
        session_regenerate_id(true);
    }

    private static function migrate(): void
    {
        UserMigration::up();
        TaskMigration::up();
        ProjectMigration::down();
        AvatarMigration::up();
    }


}