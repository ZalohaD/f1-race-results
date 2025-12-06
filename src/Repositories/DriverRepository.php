<?php

namespace src\Repositories;

use PDO;
use src\Database\Connection;

class DriverRepository
{
    private PDO $db;

    public function __construct(){
        $this->db = Connection::make();
    }

    public function all()
    {
        return $this->db->query('SELECT * FROM drivers')->fetchAll();
    }

    public function find($id)
    {
        return $this->db->query('SELECT * FROM drivers WHERE id = ?', [$id])->fetch();
    }
    public function create($data)
    {
        return $this->db->prepare('INSERT INTO drivers (name, surname, age) VALUES (:name, :surname, :age, :number)')->execute($data);
    }
    public function update($data, $id)
    {
        return $this->db->prepare('UPDATE drivers SET name = :name, surname = :surname, age = :age, number = :number WHERE id = :id')->execute($data + ['id' => $id]);
    }
    public function delete($id)
    {
        return $this->db->prepare('DELETE FROM drivers WHERE id = :id')->execute(['id' => $id]);
    }
}