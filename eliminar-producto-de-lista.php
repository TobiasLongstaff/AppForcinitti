<?php

    include 'database.php';

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        echo "Error al conectar la base de datos";
        exit();
    }
    mysqli_select_db($conecta, $database) or die ('Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "DELETE FROM lista WHERE id = $id";
        $resultado = mysqli_query($conecta, $sql);  
        if(!$resultado)
        {
            die('error al eliminar');
        } 
        
        header('Location: lista.php');
    }
    mysqli_close($conecta);


?>