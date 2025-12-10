<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;
use Medoo\Medoo;

$dotEnv = Dotenv::createImmutable(__DIR__);
$dotEnv->safeLoad();

$servername = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$dbname = $_ENV['DB_NAME'];

$database = new Medoo([
    'type' => 'mysql',
    'host' => $servername,
    'database' => $dbname,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8mb4',
]);