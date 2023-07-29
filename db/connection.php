<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'db_shop';

$connection = new mysqli($host, $user, $password, $database);

if ($connection->connect_errno) {
    die("Failed to connect to MySQL: " . $connection->connect_error);
}

?>
