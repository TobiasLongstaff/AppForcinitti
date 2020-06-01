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

    $idPedido = '';
    $idPedidoCliente = '';
    $cliente = '';
    $productos = '';
    $nombre = '';
    $cantidad = '';
    $numeroDeProducto = 0;
    $total = 0;
    $terminarPedido = '';
    $boton_cancelar = '';
    $id_usuario = '';


    //EXTRAER DATOS

    $sql="SELECT * FROM id_pedido";
    $resultado = mysqli_query($conecta, $sql);

    while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
    {        
        $idPedido = $filas['id'];
        $nombre_usuario_pedido = $filas['vendedor'];
    }
    
    $sql="SELECT * FROM lista_clientes";
    $resultado = mysqli_query($conecta, $sql);

    while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
    {        
        $idPedidoCliente = $filas['id_pedido'];
        if($idPedidoCliente == $idPedido)
        {
            $cliente = $filas['cliente'];
        }
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

    if(isset($_POST['pedido-cancelado']))
    {
        $boton_cancelar = $_POST['pedido-cancelado'];        
    }

    if($boton_cancelar)
    {
        $sql = "UPDATE id_pedido SET estado = 'Cancelado' WHERE id = '$idPedido'";
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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">   

    <!-- CSS -->
    <link rel="stylesheet" href="assets/styles/lista.css">

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
            <div class="cabecera">                
                <div class="precio-final">
                    <div class="subtitulo">
                        <span>PRECIO</span>                        
                    </div>
                    <hr>
                        <?php                       
                            $sql= "SELECT * FROM lista WHERE id_pedido = $idPedido";
                            $resultado= mysqli_query($conecta, $sql);
                            while($filas= mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                            {
                                $idLista = $filas ['id'];
                                $precio = $filas['precio'];
                                $cantidad = $filas['cantidad'];
                                $descuento = $filas['descuento'];
                                $numeroDeProducto++;
                        ?>
                                <span>p<?php echo $numeroDeProducto;?></span> 
                                <span>$<?php echo $precio; 
                                if(!empty($descuento))
                                {
                                    echo ' - $'.$descuento;
                                }
                                ?><br></span>
                        <?php   
                                $sql2= "SELECT SUM((precio * cantidad) - descuento) AS total FROM lista WHERE id_pedido = $idPedido";
                                $resultado2= mysqli_query($conecta, $sql2);
                                while($fila= mysqli_fetch_array($resultado2, MYSQLI_ASSOC))
                                {
                                    $total= $fila['total'];
                                }
                            }

                            // ACTUALIZAR DATOS
                            
                            if(isset($_POST['boton-terminar']))
                            {
                                $terminarPedido = $_POST['boton-terminar'];
                            }

                            if($terminarPedido)
                            {
                                $sql = "UPDATE id_pedido SET estado = 'Listo', total = '$total' WHERE id = '$idPedido'";
                                $resultado = mysqli_query($conexion,$sql);
                                if (!$resultado)
                                {
                                    echo 'Error al terminar';
                                }
                                else
                                {
                                    header("Location: /AppForcinitti/menu.php?id=$id_usuario");
                                } 
                            }
                        ?>
                    <hr>
                        <span>Total: $<?php echo $total;?> </span>
                </div>
                <div>
                    <div class="cliente">
                        <span>ID del pedido: <?php echo $idPedido?> </span> <br>
                        <span>Cliente: <?php echo $cliente?></span>
                    </div>
                    <div class="datos">
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
            </div>
            <table>
                <tr>
                    <th>Cant.</th>
                    <th>Descripcion</th>
                    <th>Controles</th>
                </tr>
                <?php
                    $sql="SELECT * FROM lista WHERE id_pedido = $idPedido";
                    $resultado = mysqli_query($conecta, $sql);      
                    
                    while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                    {     
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
                <?php
                        }
                ?>
                        <td>
                            <a href="eliminar-producto-de-lista.php?id=<?php echo $fila['id'] ?>"> 
                                <button class="fas fa-trash-alt boton-controles efecto-botones"></button> 
                            </a>
                        </td> 
                    </tr>
                <?php     
                    }  
                    mysqli_close($conecta);
                ?>
            </table>
            <div class="botones">
                <form class="form-botones" action="lista.php" method="POST">
                    <input class="efecto-botones" type="submit" name="boton-terminar" value="Terminar">   
                </form>
                
                <a href="pedidos.php">
                    <input class="efecto-botones" type="submit" value="Agregar">                
                </a>
                <form class="form-botones" action="lista.php" method="POST">
                    <input class="efecto-botones" type="submit" name="pedido-cancelado" value="Cancelar"> 
                </form>               
            </div>
        </main>        
    </div>
</body>
</html>