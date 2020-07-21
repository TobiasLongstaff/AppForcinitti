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

    $vendedor = '';

    if(isset($_GET['id']) && isset($_GET['vendedor']))
    {
        $id = $_GET['id'];
        $vendedor = $_GET['vendedor'];
        $sql = "DELETE FROM lista WHERE id = $id";
        $resultado = mysqli_query($conecta, $sql);
        $sql2 = "DELETE FROM lista_preparar WHERE id = $id";
        $resultado2 = mysqli_query($conecta, $sql2);   
        if(!$resultado)
        {
            die('error al eliminar');
        } 
        else
        {
            header("Location: lista/$vendedor");
        }
    }
    mysqli_close($conecta);


?>