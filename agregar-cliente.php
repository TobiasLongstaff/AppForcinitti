<?php 


    require ('database.php');

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        echo "Error al conectar la base de datos";
        exit();
    }
    mysqli_select_db($conecta, $database) or die ('Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

    $id_cliente = '';
    $vendedor = '';
    $id_pedido = '';


    if(isset($_GET['id']) && isset($_GET['vendedor']) && isset($_GET['id_cliente']))
    { 
        echo $id_pedido = $_GET['id'];
        echo $vendedor = $_GET['vendedor'];
        echo $id_cliente = $_GET['id_cliente'];

        $sql = "UPDATE id_pedido SET id_cliente = '$id_cliente' WHERE id = '$id_pedido'";
        $resultado = mysqli_query($conexion,$sql);
        if(!$resultado)
        {
            $verificacion_cliente = '0';
            header("Location: pedidos/$vendedor/$verificacion_cliente");
        }
        else
        {
            $verificacion_cliente = '1';
            header("Location: pedidos/$vendedor/$verificacion_cliente");  
        }
    }
    mysqli_close($conecta);

?>