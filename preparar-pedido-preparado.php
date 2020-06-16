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

    if(isset($_GET['id_update']) && isset($_GET['vendedor']))
    {
        $idPedido = $_GET['id_update'];
        $vendedor = $_GET['vendedor'];        
        $sql = "UPDATE id_pedido SET estado = 'Preparado' WHERE id = '$idPedido'";
        $resultado = mysqli_query($conexion,$sql);
        if (!$resultado)
        {
            echo 'Error al cancelar';
        }
        else
        {
            header("Location: menu/$vendedor");
        } 
    }
?>