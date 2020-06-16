<?php

    require ('database.php');    
    session_start();  

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        $_SESSION['message-error'] = 'Error al conectar la base de datos';
        exit();
    }
    mysqli_select_db($conecta, $database) or die ($_SESSION['message-error'] = 'Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

    $id_pedido = '';
    $vendedor = '';

    if(isset($_GET['id']) && isset($_GET['vendedor']))
    {
        $id_pedido = $_GET['id'];
        $vendedor = $_GET['vendedor'];

        $sql = "UPDATE id_pedido SET estado = 'Cancelado' WHERE id = '$id_pedido'";
        $resultado = mysqli_query($conexion,$sql);
        if (!$resultado)
        {
            echo 'Error al cancelar';
        }
        else
        {
            header("Location: /AppForcinitti/menu/$vendedor");
        }          
    }
?>
