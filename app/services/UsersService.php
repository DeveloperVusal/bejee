<?php

namespace App\Services;

use Core\Facades\Database\MariaDB;

class UsersService {

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
     * The method finds user by login and password
     * 
     * @access public
     * @param string $login
     * @param string $pass
     * @return array
     */
    public function findUser(string $login, string $pass): array
    {
        $hashPass = md5($pass);

        $sql = "SELECT id FROM `users` WHERE `login` = {$login} AND `password` = {$hashPass} LIMIT 1";
        $stmt = $this->db->query($this->db->quote($sql));

        return $stmt->fetchAll();
    }
}