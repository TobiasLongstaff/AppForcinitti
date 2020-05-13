<?php

    include 'database.php';

    $idPedido = '';
    $idPedidoCliente = '';
    $cliente = '';

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        echo "Error al conectar la base de datos";
        exit();
    }
    mysqli_select_db($conecta, $database) or die ('Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

    //EXTRAER DATOS

    $sql="SELECT * FROM id_pedido";
    $resultado = mysqli_query($conecta, $sql);

    while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
    {        
        $idPedido = $filas['id'];
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

    $productos = '';
    $nombre = '';
    $cantidad = '';    
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
    
    <title>Lista</title>
</head>
<body>
    <main class="contenido">
        <header class="titulo">
            <h2>Lista</h2>
        </header>
        <div class="cliente">
            <span>ID del pedido: <?php echo $idPedido?> </span> <br>
            <span>Cliente: <?php echo $cliente?></span>
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
                        <?php echo $nombre; ?>
                    </td>
            <?php
                    }
            ?>
                    <td>
                        <input type="submit" value="Eliminar">
                    </td> 
                </tr>
            <?php     
                }  
            ?>
        </table>
        <div class="botones">
            <input type="submit" value="Agregar">
            <input type="submit" value="Eliminar">
            <a href="pedidos.php">
                <input type="button" value="Salir">                
            </a>
        </div>
    </main>
</body>
</html>