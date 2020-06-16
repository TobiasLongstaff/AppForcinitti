<?php

    require ('database.php');
    require 'config.php'; 
    session_start(); 

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        echo "Error al conectar la base de datos";
        exit();
    }
    mysqli_select_db($conecta, $database) or die ('Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

    $idPedido = '';
    $cliente = '';
    $productos = '';
    $nombre = '';
    $cantidad = '';
    $total = 0;
    $id_usuario = '';


    //EXTRAER DATOS

    if(isset($_GET['vendedor']))
    {
        $url=explode("/", $_GET['vendedor']);
        $vendedor = $url[0];
        if($url[1] == '1')
        {
            $_SESSION['message-error'] = 'Falta agregar el cliente';
        }
        elseif($url[1] == '2')
        {
            $_SESSION['message-error'] = 'Agrega algun producto';
        }
    }

    $sql="SELECT * FROM id_pedido";
    $resultado = mysqli_query($conecta, $sql);
    while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
    {        
        $idPedido = $filas['id'];
        $nombre_usuario_pedido = $filas['vendedor'];
        $idCliente = $filas['id_cliente'];
    }
    
    $sql="SELECT * FROM clientes WHERE id = $idCliente";
    $resultado = mysqli_query($conecta, $sql);
    while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
    {        
        $cliente = $filas['cliente'];
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
?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">   

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo SERVERURL;?>assets/styles/lista.css">
    <link rel="stylesheet" href="<?php echo SERVERURL;?>assets/styles/message.css">

    <!-- ICONOS -->
    <script src="https://kit.fontawesome.com/1b601aa92b.js" crossorigin="anonymous"></script>
    
    <title>Lista</title>
</head>
<body>
    <div class="contenido-productos">
        <main class="contenido">
            <header class="titulo">
                <h2>Lista</h2>
            </header>
            <div class="informacion">                
                <?php                       
                    $sql= "SELECT * FROM lista WHERE id_pedido = $idPedido";
                    $resultado= mysqli_query($conecta, $sql);
                    while($filas= mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                    {
                        $idLista = $filas ['id'];
                        $precio = $filas['precio'];
                        $cantidad = $filas['cantidad'];
                        $descuento = $filas['descuento'];

                        $sql2= "SELECT SUM((precio * cantidad) - descuento) AS total FROM lista WHERE id_pedido = $idPedido";
                        $resultado2= mysqli_query($conecta, $sql2);
                        while($fila= mysqli_fetch_array($resultado2, MYSQLI_ASSOC))
                        {
                            $total= $fila['total'];
                        }
                    }
                ?>
                
                <div class="cliente preparar-panel">
                    <span>ID del pedido: <?php echo $idPedido?> </span> <br>
                    <span>Cliente: <?php echo $cliente?></span>
                </div>
                <div class="datos preparar-panel">
                    <span>CANTIDAD TOTAL DE PRODUCTOS</span>
                    <hr>
                    <?php
                        $sql= "SELECT SUM(cantidad) AS total_cantidad FROM lista WHERE id_pedido = $idPedido";
                        $resultado= mysqli_query($conecta, $sql);
                        while($fila= mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                        {
                            $cantidadDeProductos= $fila['total_cantidad'];
                        }
                    ?>
                    <span>Cantidad: <?php echo $cantidadDeProductos;?></span>
                </div>                    
            </div>
            <div class="tabla-lista">
                <table>
                    <tr>
                        <th>Cant.</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Controles</th>
                    </tr>
                    <?php
                        $sql="SELECT * FROM lista WHERE id_pedido = $idPedido";
                        $resultado = mysqli_query($conecta, $sql);      
                        while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                        {    
                            $precio = $fila['precio'];
                            $productos = $fila['id_producto'];
                            $cantidad = $fila['cantidad'];
                    ?>
                        <tr>
                            <td>
                                <?php echo $cantidad;?>
                            </td>
                    <?php
                            $sql2 = "SELECT * FROM productos WHERE id = $productos";
                            $resultado2 = mysqli_query($conecta, $sql2);
                            if(mysqli_num_rows($resultado2) == 1)     
                            {
                                $filas = mysqli_fetch_array($resultado2);
                                $nombre = $filas['descripcion'];
                    ?>
                            <td>
                                <?php echo $nombre;?>
                            </td>
                            <td>
                                <?php echo '$'.$precio;?>
                            </td>
                    <?php
                            }
                    ?>
                            <td>
                                <a class="btn-eliminar" href="<?php echo SERVERURL;?>eliminar-producto-de-lista.php?id=<?php echo $fila['id'] ?>"> 
                                    <button class="fas fa-trash-alt boton-controles efecto-botones"></button> 
                                </a>
                            </td> 
                        </tr>
                    <?php     
                        }  
                        mysqli_close($conecta);
                    ?>
                </table>
            </div>
            <div class="precio-final">
                <span>Total: $<?php echo $total;?> </span>
            </div>
            <!--ALERTAS-->
            <?php if(!empty($_SESSION['message-error'])){?>
                <div class='mensaje-error'>
                    <span><?= $_SESSION['message-error']?></span>
                </div>
            <?php session_unset(); } ?>
            <div class="botones">
                <a class="btn-finalizar form-botones" href="<?php echo SERVERURL;?>terminar-pedido.php?id=<?php echo $idPedido?>&total=<?php echo $total;?>&vendedor=<?php echo $vendedor;?> ">
                    <input class="efecto-botones" type="button" value="Terminar">   
                </a>
                
                <a href="<?php echo SERVERURL;?>pedidos/<?php echo $vendedor;?>/">
                    <input class="efecto-botones" type="submit" value="Agregar">                
                </a>
                <a class="form-botones btn-cancelar" href="<?php echo SERVERURL;?>cancelar-pedido.php?id=<?php echo $idPedido;?>&vendedor=<?php echo $vendedor;?>">
                    <input class="efecto-botones " type="button" value="Cancelar"> 
                </a>               
            </div>
        </main>        
    </div>
    <script src="<?php echo SERVERURL;?>assets/plugins/jquery-3.5.1.min.js"></script>
	<script src="<?php echo SERVERURL;?>assets/plugins/sweetalert2.all.min.js"></script>
	<script src="<?php echo SERVERURL;?>assets/scripts/app.js"></script>
</body>
</html>