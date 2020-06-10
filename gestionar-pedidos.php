<?php

    include 'database.php';

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        $_SESSION['message-error'] = 'Error al conectar la base de datos';
        exit();
    }
    mysqli_select_db($conecta, $database) or die ($_SESSION['message-error'] = 'Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

    $buscar = '';
    $sinPreparar = '';
    $preparado = '';

    if(isset($_POST['search']))
    {
        $buscar = $_POST['search'];

    }

    if(isset($_POST['sin-preparar']) && isset($_POST['preparado']))
    {
        $sinPreparar = $_POST['sin-preparar'];
        $preparado = $_POST['preparado'];        
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/styles/lista.css">

    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">

    <!-- ICONOS -->
    <script src="https://kit.fontawesome.com/1b601aa92b.js" crossorigin="anonymous"></script>

    <title>Gestionar pedidos</title>
</head>
<body>
    <div class="contenido-productos">
        <main class="contenido">
            <header class="titulo">
                <h2>Gestion de pedidos</h2>
            </header>
            <span>Pedidos</span>
            <form method="POST" action="gestionar-pedidos.php">                    
                <div class="pedido">            
                    <input class="text efecto" type="search" name="search" value="<?php $buscar?>">               
                    <button type="submit" class="fas fa-search boton-buscar efecto-botones"></button>
                </div>            
            </form>
            <form action="gestionar-pedidos.php" method="POST">
                <span>Pedidos sin preparar</span>
                <input type="checkbox" name="sin-preparar" value="Listo" checked></br>
                <!-- <span>Pedidos preparados</span>
                <input type="checkbox" name="preparado" value="Preparado" checked> -->
                <button type="submit" class="fas fa-print boton-controles efecto-botones"></button>
                <button type="submit" class="far fa-eye boton-controles efecto-botones"></button>
            </form>

            <div class="tabla">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>                    
                        <th>Estado</th>
                        <th>Controles</th>
                    </tr>
                    <?php
                        if($buscar == '')
                        {
                            $nombreCliente = '';
                            $sql= "SELECT * FROM id_pedido WHERE estado != 'Cancelado'";
                            $resultado= mysqli_query($conecta, $sql);
                            while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                            {
                                $idPedido =  $fila['id'];
                                $idClienteId_pedido = $fila['id_cliente'];
                                $estadoPedido = $fila['estado'];
                                                                                            
                                $sql2= "SELECT * FROM clientes WHERE id = $idClienteId_pedido";
                                $resultado2= mysqli_query($conecta, $sql2);
                                while($filas= mysqli_fetch_array($resultado2, MYSQLI_ASSOC))
                                {
                                    $nombreCliente = $filas['cliente']; 
                                ?>     
                                <tr>              
                                    <td><?php echo $idPedido;?></td>                        
                                    <td><?php echo $nombreCliente;}?></td>
                                    <td><?php echo $estadoPedido;?></td>
                                    <td class="controles">
                                        <button type="submit" class="far fa-eye boton-controles efecto-botones"></button>
                                        <button type="submit" class="fas fa-print boton-controles efecto-botones"></button>
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
                                $idClienteId_pedido = $fila['id_cliente'];
                                $estadoPedido = $fila['estado'];
                                                        
                                $sql2= "SELECT * FROM clientes WHERE id = $idClienteId_pedido";
                                $resultado2= mysqli_query($conecta, $sql2);
                                while($filas= mysqli_fetch_array($resultado2, MYSQLI_ASSOC))
                                {
                                    $nombreCliente = $filas['cliente']; 
                    ?>     
                    <tr>              
                                <td><?php echo $idPedido;?></td>                        
                                <td><?php echo $nombreCliente;}?></td>
                                <td><?php echo $estadoPedido;?></td>
                                <td class="controles">
                                    <button type="submit" class="far fa-eye boton-controles efecto-botones"></button>
                                    <button type="submit" class="fas fa-print boton-controles efecto-botones"></button>
                                </td>                
                    </tr>
                    <?php
                            } 
                            mysqli_close($conecta);                       
                        }
                    ?>
                </table>            
            </div>
            <div class="botones">
                <a href="menu.php">
                    <input class="efecto-botones" type="button" value="Salir">
                </a>
            </div>
        </main>        
    </div>
</body>
</html>