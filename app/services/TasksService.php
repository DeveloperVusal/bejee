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

    public function save(array $fields, ?int $id = 0): array
    {
        $result = [];

        if ($id) {
            $sql = "UPDATE `tasks` SET `name` = ?, `email` = ?, `text` = ? WHERE id = ?";
            $sth = $this->db->prepare($sql);
            $is = $sth->execute([$fields['name'], $fields['email'], $fields['text']]);

            $result = [
                'action' => 'state',
                'result' => $is
            ];
        } else {
            $sql = "INSERT INTO `tasks` (`name`, `email`, `text`) VALUES(?, ?, ?)";
            $sth = $this->db->prepare($sql);
            $is = $sth->execute([$fields['name'], $fields['email'], $fields['text']]);

            $result = [
                'action' => 'insert',
                'result' => (int)$this->db->lastInsertId()
            ];
        }

        return $result;
    }

    public function get(int $offset = 0): mixed
    {
        $sql = "SELECT * FROM `tasks` LIMIT {$offset}, 3";
        $stmt = $this->db->query($sql);

        return $stmt->fetchAll();
    }
}