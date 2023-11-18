<?php

use Core\Facades\Database\MariaDB;
use Core\Facades\Render\View;

$query = $_SERVER['REQUEST_URI'];

switch ($query) {
    // case '/db':
    //     $db = MariaDB::connection();
    //     break;

    case '/':
        // include __DIR__.'./../web/todo/index.htm';

        $v = View::get('todo', 'index.htm.php');

        break;

    case '/tasks':
        include __DIR__.'./../web/todo/tasks.htm';
        break;
    
    default:
        echo '404';
        break;
}