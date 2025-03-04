<?php
require 'vendor/autoload.php';

use Medoo\Medoo;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "desk";

$database = new Medoo([
    'type' => 'mysql',
    'host' => $servername,
    'database' => $dbname,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8mb4',
]);