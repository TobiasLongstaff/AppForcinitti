<?php

    $conexion = mysqli_connect("localhost:3307", "root", "", "php_appforcinitti_database");

    $server = 'localhost:3307';
    $nombre = 'root';
    $password = '';
    $database = 'php_appforcinitti_database';

    try
    {
        $conn = new PDO("mysql:host=$server;dbname=$database;",$nombre, $password);
    } catch (PDOException $e)
    {
        die('Connected failed: '. $e->getMessage());
    }

?>