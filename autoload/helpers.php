<?php

use Core\Facades\Render\View;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__.'./../');
$dotenv->load();

function env($name) {
    return  $_ENV[$name];
}

function view($template, $filepath) {
    View::get($template, $filepath);
}