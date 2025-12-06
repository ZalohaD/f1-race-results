<?php
namespace src\Database;

use PDO;

class Connection{
    public static function make()
    {
     $config = require_once __DIR__ . '/../../config/db.php';
     return new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname']. $config['user'] . $config['password'].';charset='.$config['charset']);
    }
}