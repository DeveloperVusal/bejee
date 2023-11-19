<?php

use Core\Facades\Database\MariaDB;
use Core\Facades\Render\View;

$query = $_SERVER['REQUEST_URI'];

switch ($query) {
    case '/':
        // include __DIR__.'./../web/todo/index.htm';

        $v = View::get('todo', 'index.htm.php');

        break;

    case '/tasks':
        include __DIR__.'./../web/todo/tasks.htm';
        break;
    
    default:
        http_response_code(404);
        echo "404 Not found";
        break;
}