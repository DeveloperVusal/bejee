<?php

namespace App\Services;

use Core\Facades\Database\MariaDB;

class TasksService {

    private \PDO $db; 

    /**
     * Connection to database
     * 
     * @return void
     */
    function __construct()
    {
        $this->db = MariaDB::connection();
    }

    public function save(): array
    {
        $mock = ['id' => 1];
        return $mock;
    }

    public function get(): array
    {
        $mock = [
            ['id' => 1, 'name' => 'Vusal', 'email' => 'vusal@gmail.com', 'text' => 'Test 1', 'is_done' => false],
            ['id' => 2, 'name' => 'Alex', 'email' => 'alex@gmail.com', 'text' => 'Test 2', 'is_done' => true],
            ['id' => 3, 'name' => 'Ilon', 'email' => 'ilon@gmail.com', 'text' => 'Test 3', 'is_done' => false],
        ];

        return $mock;
    }
}