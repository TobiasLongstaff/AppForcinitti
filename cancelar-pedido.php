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
    $id_usuario = '';

    if(isset($_GET['id']))
    {
        $id_pedido = $_GET['id'];
        
        $sql="SELECT * FROM id_pedido WHERE id = '$id_pedido'";
        $resultado = mysqli_query($conecta, $sql);
        while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
        {        
            $nombre_usuario_pedido = $filas['vendedor'];
        }
        
        $sql="SELECT * FROM usuarios";
        $resultado = mysqli_query($conecta, $sql);
        while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
        {
            $nombre_usuario_usuarios = $filas['nombre'];
            if($nombre_usuario_pedido == $nombre_usuario_usuarios)
            {
                $id_usuario = $filas['id'];
            }        
        }

        $sql = "UPDATE id_pedido SET estado = 'Cancelado' WHERE id = '$id_pedido'";
        $resultado = mysqli_query($conexion,$sql);
        if (!$resultado)
        {
            echo 'Error al cancelar';
        }
        else
        {
            header("Location: /AppForcinitti/menu.php?id=$id_usuario");
        }          
    }
?>
