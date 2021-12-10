<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'stocksystem';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
die ('Connected failded:' .$e ->getMessage());
}

?>