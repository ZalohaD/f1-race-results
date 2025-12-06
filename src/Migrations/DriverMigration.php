<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../Repositories/DriverRepository.php';
require_once __DIR__ . '/../Services/DriverService.php';
require_once __DIR__ . '/../Database/Connection.php';

use src\Repositories\DriverRepository;
use src\Services\DriverService;
use src\Database\Connection;
use Faker\Factory;

$driverRepository = new DriverRepository();
$driverService = new DriverService($driverRepository);

class DriverMigration
{
    private PDO $db;
    public $faker;

    public function __construct(private DriverService $driverService)
    {
        $this->db = Connection::make();
        $this->faker = Factory::create();
    }

    public function createTable()
    {
        $stmt = $this->db->prepare('
            CREATE TABLE IF NOT EXISTS drivers (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255),
                surname VARCHAR(255),
                age INT
            )
        ');
        $stmt->execute();
        echo "✅ Table `drivers` created successfully.<br>";
    }

    public function up(int $count )
    {
        for ($i = 0; $i < $count; $i++) {
            $driver = $this->driverService->create([
                'name' => $this->faker->firstName,
                'surname' => $this->faker->lastName,
                'age' => $this->faker->numberBetween(18, 60)
            ]);
            echo "✅ Driver added: " . htmlspecialchars($driver['name']) . " " . htmlspecialchars($driver['surname']) . " (age " . $driver['age'] . ")<br>";
        }
    }
}

$migration = new DriverMigration($driverService);
$migration->createTable();
$migration->up(10);
