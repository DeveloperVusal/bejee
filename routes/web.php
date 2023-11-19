<?php

use App\Controllers\TasksController;
use Core\Facades\Render\View;

$query = $_SERVER['REQUEST_URI'];

switch ($query) {
    case '/':
        $tc = new TasksController();

        View::get('todo', 'index.htm.php', [
            'data' => $tc->get(),
        ]);

        break;
    
    default:
        http_response_code(404);
        echo "404 Not found";
        break;
}