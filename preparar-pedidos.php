<?php

    include 'database.php';

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

    if (isset($_SESSION['user_id']))
    {
        $id_usuario = $_SESSION['user_id'];        
        $records = $conn->prepare('SELECT id, nombre, password FROM usuarios WHERE id =:id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if(count($results) > 0)
        {
            $user = $results;
        }
        
        $vendedor = $user['nombre'];
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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/styles/lista.css">
    <link rel="stylesheet" href="assets/styles/message.css">

    <!-- ICONOS -->
    <script src="https://kit.fontawesome.com/1b601aa92b.js" crossorigin="anonymous"></script>

    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">   

    <title>Preparado</title>
</head>
<body>
    <div class="contenido-productos">
        <main class="contenido">
            <header class="titulo">
                <h2>Preparar pedidos</h2>
            </header>
            <span>ID del pedidos</span>
            <form method="POST" action="preparar-pedidos.php">
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
                                    $nombreCliente = $filas['cliente']; 
                    ?>     
                    <tr>              
                                <td><?php echo $idPedido;?></td>                        
                                <td><?php echo $nombreCliente;}?></td>
                                <td><?php echo $cabecera;?></td>
                                <td><?php echo $estadoPedido;?></td>
                                <td><?php echo $fechaDeEntrega;?></td>
                                <td><?php echo $direccion;?></td>
                                <td class="controles">
                                    <a href="preparar-pedido-panel.php?id_update=<?php echo $idPedido; ?>">
                                        <button type="button" class="fas fa-edit boton-controles efecto-botones"></button>
                                    </a> 
                                </td>                        
                    </tr>
                    <?php
                            } 
                            mysqli_close($conecta);                           
                        }
                        else
                        {
                            $nombreCliente = '';
                            $sql = "SELECT * FROM id_pedido WHERE id LIKE '%".$buscar."%' LIMIT 400";
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
                                        <a href="preparar-pedido-panel.php?id_update=<?php echo $idPedido; ?>">
                                            <button type="button" class="fas fa-edit boton-controles efecto-botones"></button>
                                        </a>  
                                    </td>                
                    </tr>                                    
                    <?php
                                    }                                
                                    else
                                    {
                                        $_SESSION['message-error'] = 'No se escontro el pedido';
                                    }
                                }  
                            } 
                            mysqli_close($conecta);  
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
                <a href="menu.php?id=<?php echo $id_usuario;?>">
                    <input class="efecto-botones" type="button" value="Salir">
                </a>
            </div>
        </main>        
    </div>
</body>
</html>