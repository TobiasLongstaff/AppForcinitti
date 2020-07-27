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

    if(isset($_GET['id_update']) && isset($_GET['vendedor']) && isset($_GET['tipo']))
    {
        $idPedido = $_GET['id_update'];
        $vendedor = $_GET['vendedor'];
        $tipo = $_GET['tipo'];
        
        $sql1= "SELECT * FROM id_pedido WHERE id = '$idPedido'";
        $resultado1= mysqli_query($conecta, $sql1);
        while($fila = mysqli_fetch_array($resultado1, MYSQLI_ASSOC))
        {
            $estado = $fila['estado']; 
        }

        if($tipo == 'Facturado')
        {
            if($estado == 'Listo' or $estado == 'Preparado')
            {
                $sql = "UPDATE id_pedido SET estado = '$estado-fac' WHERE id = '$idPedido'";
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
            else
            {
                $sql = "UPDATE id_pedido SET estado = '$estado' WHERE id = '$idPedido'";
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
        }
        else
        {
            if($estado != 'Listo-fac')
            {
                $sql = "UPDATE id_pedido SET estado = '$tipo' WHERE id = '$idPedido'";
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
            else
            {
                $sql = "UPDATE id_pedido SET estado = 'Preparado-' WHERE id = '$idPedido'";
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
   
        }
    }
    mysqli_close($conexion); 
?>