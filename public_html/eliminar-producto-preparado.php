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

    $idPedido = '';
    $id = '';

    if(isset($_GET['id']) && isset($_GET['vendedor']))
    {
        $id = $_GET['id'];
        $vendedor = $_GET['vendedor'];
        $sql = "SELECT id_pedido FROM lista_preparar WHERE id = $id";
        $resultado = mysqli_query($conecta, $sql);
        while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
        {
            $idPedido = $filas['id_pedido'];
        }

        $sql = "DELETE FROM lista_preparar WHERE id = $id";
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
    mysqli_close($conecta);
?>