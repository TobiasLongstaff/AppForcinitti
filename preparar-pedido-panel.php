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
    $id_usuario = '';
    $boton_preparado = '';

    if(isset($_GET['id_update']))
    {
        $idPedido = $_GET['id_update'];
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
?>
<!DOCTYPE html>
<html lang="en">
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

    <title>Panel de Preparado</title>
</head>
<body>
    <div class="contenido-productos">
        <main class="contenido">
            <header class="titulo">
                <h2>Panel de Preparado</h2>
            </header>
            <div class="informacion">
                <div class="cliente preparar-panel">
                    <span>ID del pedido: <?php echo $idPedido;?></span><br>
                    <span>Cliente: <?php echo $cliente;?> </span>
                </div>
                <div class="datos preparar-panel">
                    <span>CANTIDAD TOTAL DE PRODUCTOS</span>
                    <hr>
                    <?php
                        $sql= "SELECT SUM(cantidad) AS total_cantidad FROM lista_preparar WHERE id_pedido = $idPedido";
                        $resultado= mysqli_query($conecta, $sql);
                        while($fila= mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                        {
                            $cantidadDeProductos= $fila['total_cantidad'];
                        }
                    ?>
                    <span>Cantidad: <?php echo $cantidadDeProductos;?></span>
                </div>                   
            </div>
            <table>
                <tr>
                    <th>Cantidad</th>
                    <th>Descripcion</th>
                    <th>Controles</th>
                </tr>
                <tr>
                <?php
                    $sql="SELECT * FROM lista_preparar WHERE id_pedido = '$idPedido'";
                    $resultado = mysqli_query($conecta, $sql);
                    while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                    {
                        $id = $filas['id'];
                        $cantidadListaPreparar = $filas['cantidad'];
                        $descripcionListaPreparar = $filas['descripcion'];
                    ?>
                        <td><?php echo $cantidadListaPreparar?></td>
                        <td><?php echo $descripcionListaPreparar?></td>
                        <td class="controles">
                            <a href="actualizar-producto-preparado.php?id_update=<?php echo $id;?>">
                                <button type="submit" class="fas fa-edit boton-controles efecto-botones"></button>
                            </a>
                            <a class="btn-eliminar" href="eliminar-producto-preparado.php?id=<?php echo $id;?>">
                                <button class="fas fa-trash-alt boton-controles efecto-botones"></button> 
                            </a>
                        </td>
                        </tr> 
                <?php               
                    }
                ?>   
            </table>
            <div class="botones">
                <a class="form-botones btn-finalizar" href="preparar-pedido-preparado.php?id_update=<?php echo $idPedido;?>">
                    <input class="efecto-botones " type="submit" value="Preparado">   
                </a>
                <a href="agregar-producto-preparado.php?id_pedido=<?php echo $idPedido;?>">
                    <input class="efecto-botones" type="submit" value="Agregar">                
                </a>
                <a href="preparar-pedidos.php">
                    <input class="efecto-botones" type="submit" name="pedido-cancelado" value="Salir"> 
                </a>  
            </div>
        </main>
    </div>
    <script src="assets/plugins/jquery-3.5.1.min.js"></script>
	<script src="assets/plugins/sweetalert2.all.min.js"></script>
	<script src="assets/scripts/app.js"></script>
</body>
</html>