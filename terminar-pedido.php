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

    $id_usuario = '';
    $idPedido = '';
    $id_cliente = '';
    $id_lista = '';
    
    if(isset($_GET['id']) && isset($_GET['vendedor']))
    {
        $idPedido = $_GET['id'];
        $vendedor = $_GET['vendedor'];

        $sql="SELECT * FROM id_pedido WHERE id = '$idPedido'";
        $resultado = mysqli_query($conecta, $sql);
        while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
        {        
            $nombre_usuario_pedido = $filas['vendedor'];
            $id_cliente = $filas['id_cliente'];
        }

        $sql="SELECT * FROM lista WHERE id_pedido = '$idPedido'";
        $resultado = mysqli_query($conecta, $sql);
        while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
        {        
            $id_lista = $filas['id'];
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
        if(isset($_GET['total']))
        {
            $total = $_GET['total'];

            if($id_cliente != '0')
            {
                if($id_lista != '')
                {
                    $sql = "UPDATE id_pedido SET estado = 'Listo', total = '$total' WHERE id = '$idPedido'";
                    $resultado = mysqli_query($conexion,$sql);
                    if (!$resultado)
                    {
                        echo 'Error al terminar';
                    }
                    else
                    {
                        header("Location: menu/$vendedor");
                    }                     
                }
                else
                {
                    header("Location: lista/$vendedor/2/");
                }
            }
            else
            {
                header("Location: lista/$vendedor/1/");
            }
        }
    }
    mysqli_close($conexion); 
?>