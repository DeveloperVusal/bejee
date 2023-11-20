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

    /**
     * The method inserting or updating the tasks
     * 
     * @param array $fields
     * @param ?int $id default = 0
     * @return array
     */
    public function save(array $fields, ?int $id = 0): array
    {
        $result = [];

        if ($id) {
            $sql = "UPDATE `tasks` SET `text` = ?, `is_done` = ? WHERE id = ?";
            $sth = $this->db->prepare($sql);
            $is = $sth->execute([$fields['text'], $fields['is_done'], $id]);

            $result = [
                'action' => 'update',
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

    /**
     * The method get the tasks
     * 
     * @param int $offset default = 0
     * @return array
     */
    public function get(int $offset = 0, ?string $sorts = ''): array
    {
        $orderby = '`id` DESC';

        if ($offset > 0) {
            $offset--;
            $offset *= 3;
        }
        if (strlen($sorts)) $orderby = $sorts;

        $selects = '`id`, `name`, `email`, `text`, `is_done`, `save_user_id`';
        $sql = "SELECT {$selects} FROM `tasks` ORDER BY {$orderby} LIMIT {$offset}, 3";
        $stmt = $this->db->query($sql);

        $sql2 = "SELECT COUNT(id) AS count FROM `tasks`";
        $stmt2 = $this->db->query($sql2);

        return ['list' => $stmt->fetchAll(), 'count' => $stmt2->fetchColumn()];
    }
}