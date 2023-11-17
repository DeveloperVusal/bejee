<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__.'./../');
$dotenv->load();

function env($name) {
    return  $_ENV[$name];
}