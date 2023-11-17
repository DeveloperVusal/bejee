<?php

$query = $_SERVER['REQUEST_URI'];

switch ($query) {
    case '/':
        include __DIR__.'./../web/todo/index.htm';
        break;

    case '/tasks':
        include __DIR__.'./../web/todo/tasks.htm';
        break;
    
    default:
        echo '404';
        break;
}