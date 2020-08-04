<?php

    include 'database.php';
    include 'config.php';

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
                // else
                // {
                //     header("Location: menu/$vendedor");
                // }            
            }
            else
            {
                $sql = "UPDATE id_pedido SET estado = '$estado' WHERE id = '$idPedido'";
                $resultado = mysqli_query($conexion,$sql);
                if (!$resultado)
                {
                    echo 'Error al cancelar';
                }
                // else
                // {
                //     header("Location: menu/$vendedor");
                // }                  
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
                // else
                // {
                //     header("Location: menu/$vendedor");
                // }                 
            }
            else
            {
                $sql = "UPDATE id_pedido SET estado = 'Preparado-' WHERE id = '$idPedido'";
                $resultado = mysqli_query($conexion,$sql);
                if (!$resultado)
                {
                    echo 'Error al cancelar';
                }
                // else
                // {
                //     header("Location: menu/$vendedor");
                // }    
            }
   
        }
    }
    mysqli_close($conexion); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- LOGO -->
    <link rel="icon" href="<?php echo SERVERURL;?>assets/img/logo.ico">

    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">   

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo SERVERURL;?>assets/styles/menu-preparado.css">

    <!-- ICONOS -->
    <script src="https://kit.fontawesome.com/1b601aa92b.js" crossorigin="anonymous"></script>

    <!-- ANIMACIONES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
     
    <title>Pedido Preparado</title>
</head>
<body>
    <main class="contenido">
        <div class="card animate__animated animate__fadeIn">
            <span>Seleccionar una de las dos opciones</span>
            <div class="botones">
                <a href="imprimir-ticket/<?php echo $vendedor?>/<?php echo $idPedido?>/" class="efecto-botones">Imprimir</a>
                <a href="menu/<?php echo $vendedor?>" class="efecto-botones">Salir</a>             
            </div>
        </div>
    </main>
</body>
</html>