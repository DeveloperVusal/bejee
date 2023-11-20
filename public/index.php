<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../autoload/register.php';
require __DIR__.'/../autoload/helpers.php';

session_start();

include __DIR__.'/../routes/api.php';
include __DIR__.'/../routes/web.php';