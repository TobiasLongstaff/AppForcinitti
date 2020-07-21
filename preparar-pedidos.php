<?php

    include 'database.php';
    require 'config.php';

    session_start();
    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        $_SESSION['message-error'] = 'Error al conectar la base de datos';
        exit();
    }
    mysqli_select_db($conecta, $database) or die ($_SESSION['message-error'] = 'Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

    $botonPreparar = '';
    $buscar = '';
    $id_producto = '';
    $id_predido = '';
    $cantidad = '';
    $descuento = '';
    $condicionIva = '';
    $descripcion = '';
    $precio = '';
    $cabecera = '';
    $vendedor = '';


    if(isset($_GET['vendedor']))
    {
        $url=explode("/", $_GET['vendedor']);
        $vendedor = $url[0];
    }

    $sql="SELECT * FROM id_pedido";
    $resultado = mysqli_query($conecta, $sql);
    while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
    {        
        $id_pedido = $filas['id'];
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
    if(isset($_POST['search']))
    {
        $buscar = $_POST['search'];  
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

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo SERVERURL;?>assets/styles/lista.css">
    <link rel="stylesheet" href="<?php echo SERVERURL;?>assets/styles/message.css">

    <!-- ICONOS -->
    <script src="https://kit.fontawesome.com/1b601aa92b.js" crossorigin="anonymous"></script>

    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">   

    <!-- ANIMACIONES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">

    <title>Preparado</title>
</head>
<body>
    <div class="contenido-productos">
        <main class="contenido animate__animated animate__backInRight">
            <header class="titulo">
                <h2>Preparar pedidos</h2>
            </header>
            <span>Cabecera del pedido</span>
            <form method="POST" action="<?php echo SERVERURL;?>preparar-pedidos/<?php echo $vendedor;?>/">
                <div class="pedido">
                    <input class="text efecto" type="search" name="search" value="<?php $buscar?>">               
                    <button type="submit" class="fas fa-search boton-buscar efecto-botones"></button>
                </div>            
            </form>
            <div class="tabla">
                <table>
                    <tr>
                        <th>ID</th>                        
                        <th>Cliente</th>
                        <th>Cabecera</th>                    
                        <th>Estado</th>
                        <th>Fecha Entrega</th>
                        <th>Direccion</th>
                        <th>Controles</th>
                    </tr>
                    <?php
                        if($buscar == '')
                        {
                            $nombreCliente = '';
                            $sql= "SELECT * FROM id_pedido WHERE estado = 'Listo'";
                            $resultado= mysqli_query($conecta, $sql);
                            while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                            {
                                $idPedido =  $fila['id'];
                                $estadoPedido = $fila['estado'];
                                $idClienteId_pedido = $fila['id_cliente'];
                                $fechaDeEntrega = $fila['fecha_entrega'];
                                $direccion = $fila['entrega'];
                                $cabecera = $fila['cabecera'];
                                                        
                                $sql2= "SELECT * FROM clientes WHERE id = $idClienteId_pedido";
                                $resultado2= mysqli_query($conecta, $sql2);
                                while($filas= mysqli_fetch_array($resultado2, MYSQLI_ASSOC))
                                {
                                    $nombreCliente = $filas['nombre']; 
                    ?>     
                    <tr>              
                                <td><?php echo $idPedido;?></td>                        
                                <td><?php echo $nombreCliente;}?></td>
                                <td><?php echo $cabecera;?></td>
                                <td><?php echo $estadoPedido;?></td>
                                <td><?php echo $fechaDeEntrega;?></td>
                                <td><?php echo $direccion;?></td>
                                <td class="controles">
                                    <a href="<?php echo SERVERURL;?>preparar-pedidos-panel/<?php echo $vendedor;?>/<?php echo $idPedido; ?>/">
                                        <button type="button" class="fas fa-edit boton-controles efecto-botones"></button>
                                    </a> 
                                </td>                        
                    </tr>
                    <?php
                            } 
                            mysqli_close($conecta);                           
                        }
                        elseif( $buscar != '')
                        {
                            $nombreCliente = '';
                            $sql = "SELECT * FROM id_pedido WHERE cabecera LIKE '%".$buscar."%' LIMIT 400";
                            $resultado= mysqli_query($conecta, $sql);
                            while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                            {
                                $idPedido =  $fila['id'];
                                $estadoPedido = $fila['estado'];
                                $idClienteId_pedido = $fila['id_cliente'];
                                $fechaDeEntrega = $fila['fecha_entrega'];
                                $direccion = $fila['entrega'];
                                $cabecera = $fila['cabecera'];
                                                        
                                $sql2= "SELECT * FROM clientes WHERE id = $idClienteId_pedido";
                                $resultado2= mysqli_query($conecta, $sql2);
                                while($filas= mysqli_fetch_array($resultado2, MYSQLI_ASSOC))
                                {
                                    $nombreCliente = $filas['cliente']; 

                                    if($estadoPedido == 'Listo')
                                    {
                                        $idPedido =  $fila['id'];         
                    ?>     
                    <tr>              
                                        <td><?php echo $idPedido;?></td>                        
                                        <td><?php echo $nombreCliente;?></td>
                                        <td><?php echo $cabecera;?></td>
                                        <td><?php echo $estadoPedido;?></td>
                                        <td><?php echo $fechaDeEntrega;?></td>
                                        <td><?php echo $direccion;?></td>
                                        <td class="controles">
                                            <a href="<?php echo SERVERURL;?>preparar-pedidos-panel/<?php echo $vendedor;?>/<?php echo $idPedido; ?>/">
                                                <button type="button" class="fas fa-edit boton-controles efecto-botones"></button>
                                            </a>  
                                        </td>                
                    </tr>                                    
                    <?php
                                    }                                
                                }  
                            } 
                            mysqli_close($conecta);  
                        }
                        else
                        {
                            $_SESSION['message-error'] = 'No se escontro el pedido';
                        } 
                    ?> 
                    <!--ALERTAS-->           
                    <?php if(!empty($_SESSION['message-error'])){?>
                        <div class='mensaje-error'>
                            <span><?= $_SESSION['message-error']?></span>
                        </div>
                    <?php session_unset(); } ?>
                    <?php if(!empty($_SESSION['message-correcto'])){?>
                        <div class='mensaje-correcto'>
                            <span><?= $_SESSION['message-correcto']?></span>
                        </div>
                    <?php session_unset(); } ?>
                </table>            
            </div>
            <div class="botones">
                <a href="<?php echo SERVERURL;?>menu/<?php echo $vendedor;?>">
                    <input class="efecto-botones" type="button" value="Salir">
                </a>
            </div>
        </main>        
    </div>
</body>
</html>