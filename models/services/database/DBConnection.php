<?php

namespace models\database;

require_once __DIR__ . "/../../config.php";

use PDO;

class DBConnection
{
    /**
     * @var PDO
     */
    private ?PDO $pdo;
    private static ?DBConnection $instance = null;

    private function __construct()
    {
        $config = $GLOBALS["config"];
        $host = $config['connection']['host'] . ":" . $config['connection']['port'];
        $dbname = $config['connection']['database'];
        $username = $config['connection']['username'];
        $password = $config['connection']['password'];

        $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset-utf8;", $username, $password);

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(): DBConnection
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }

    function __destruct()
    {
        $this->pdo = null;
    }
}