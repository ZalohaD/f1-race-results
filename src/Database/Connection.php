<?php

namespace src\Database;

use PDO;
use PDOException;

class Connection
{
    private static ?PDO $pdo = null;

    public static function make(): PDO
    {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../../config/db.php';
            $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', $config['host'], $config['dbname']);

            try {
                self::$pdo = new PDO($dsn, $config['user'], $config['password']);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("DB connection failed: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }


    //Protect from clone and create
    private function __construct() {}
    private function __clone() {}
}
