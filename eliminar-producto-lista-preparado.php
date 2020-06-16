<?php

    require ('database.php');

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        $_SESSION['message-error'] = 'Error al conectar la base de datos';
        exit();
    }
    mysqli_select_db($conecta, $database) or die ($_SESSION['message-error'] = 'Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

    if(isset($_GET['vendedor']) &&  isset($_GET['id']))
    {
        $vendedor = $_GET['vendedor'];
        $idPedido = $_GET['id'];

        $sql = "DELETE FROM lista_preparar WHERE descripcion = ''";
        $resultado = mysqli_query($conecta, $sql);  
        if(!$resultado)
        {
            die('error al eliminar');
        }
        else
        {
            header("Location: preparar-pedidos-panel/$vendedor/$idPedido/");
        }
    }


?>