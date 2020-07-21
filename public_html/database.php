<?php

    $conexion = mysqli_connect("localhost", "c1850246_sisfoci", "98WUnuwepo", "c1850246_sisfoci");

    $server = 'localhost';
    $nombre = 'c1850246_sisfoci';
    $password = '98WUnuwepo';
    $database = 'c1850246_sisfoci';

    try
    {
        $conn = new PDO("mysql:host=$server;dbname=$database;",$nombre, $password);
    } catch (PDOException $e)
    {
        die('Connected failed: '. $e->getMessage());
    }

?>