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
        $hashPass = $this->db->quote(md5($pass));
        $login = $this->db->quote($login);
        
        $sql = "SELECT `id` FROM `users` WHERE `login` = {$login} AND `password` = {$hashPass}";
        $stmt = $this->db->query($sql);

        return $stmt->fetchAll();
    }
}