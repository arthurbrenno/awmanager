<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

namespace App\Core\Models\Database;

use Config\Config;
use Exception;
use Illuminate\Database\Capsule\Manager;

class Connection
{
    private bool $isClosed = false;
    private static Connection $instance;

    /**
     * @throws Exception
     */
    private function __construct(
        private readonly Manager $manager,
        string $configPath
    )
    {
        $configIsNotAFile = !is_file($configPath);
        $configIsNotJson  = pathinfo($configPath, PATHINFO_EXTENSION) != 'json';

        if ($configIsNotAFile || $configIsNotJson)
        {
            throw new Exception("Arquivo de configuração não encontrado.");
        }

        $config = file_get_contents($configPath);

        $this->manager->addConnection(
            json_decode($config)
        );

        $this->manager->setAsGlobal();
        $this->manager->bootEloquent();
    }

    /**
     * @throws Exception
     */
    public static function getInstance(): static
    {
        if (self::$instance == null)
        {
            self::$instance = new Connection(
                new Manager(),
                Config::DB_CONFIG_PATH
            );
        }

        return self::$instance;
    }

    public function close(): void{}

    public function isClosed(): bool
    {
        return $this->isClosed;
    }

}