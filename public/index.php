<?php
/*
|---------------------------------------------
| Register the application autoload
|---------------------------------------------
|
|
*/
require __DIR__ . '/../vendor/autoload.php';

/*
|---------------------------------------------
| Load the application class
|---------------------------------------------
|
|
*/
require __DIR__ . '/../bootstrap/Application.php';

/*
|---------------------------------------------
| Load the environment variables
|---------------------------------------------
|
|
*/
$env = \Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$env->load();

/*
|---------------------------------------------
| Running the application
|---------------------------------------------
|
|
*/
Application::run(__DIR__ . '/../');
