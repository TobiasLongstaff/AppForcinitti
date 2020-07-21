<?php

    include 'database.php';
    require 'config.php';

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
    $estado = '';
    $estado1 = '';
    $estado2 = '';
    $resultado = '';
    $cabecera = '';
    $vendedor = '';

    if(isset($_POST['search']))
    {
        $buscar = $_POST['search'];

    }

    if(isset($_GET['vendedor']))
    {
        $vendedor = $_GET['vendedor'];
    }

    if(isset($_POST['sin-preparar']) && isset($_POST['preparado']))
    {
        $sinPreparar = $_POST['sin-preparar'];
        $preparado = $_POST['preparado'];        
    }

    if(isset($_POST['imprimir']))
    {
        if(!empty($_POST['estado1']))
        {
            $estado1 = $_POST['estado1'];
            header("Location: /AppForcinitti/imprimir/$vendedor/Listo/");
        }

        if(!empty($_POST['estado2']))
        {
            $estado2 = $_POST['estado2'];
            header("Location: /AppForcinitti/imprimir/$vendedor/Preparado/");
        }

        if(!empty($_POST['estado1']) && !empty($_POST['estado2']))
        {
            header("Location: /AppForcinitti/imprimir/$vendedor/todos/");
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

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo SERVERURL;?>assets/styles/lista.css">

    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">

    <!-- ICONOS -->
    <script src="https://kit.fontawesome.com/1b601aa92b.js" crossorigin="anonymous"></script>

    <!-- ANIMACIONES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">

    <title>Gestionar pedidos</title>
</head>
<body>
    <div class="contenido-productos">
        <main class="contenido animate__animated animate__backInRight">
            <header class="titulo">
                <h2>Gestion de pedidos</h2>
            </header>
            <span>Pedidos</span>
            <form method="POST" action="<?php echo SERVERURL;?>gestionar-pedidos/<?php echo $vendedor;?>">                    
                <div class="pedido">            
                    <input class="text efecto" type="search" name="search" value="<?php $buscar?>">               
                    <button type="submit" class="fas fa-search boton-buscar efecto-botones"></button>
                </div>            
            </form>
            <form action="<?php echo SERVERURL;?>gestionar-pedidos/<?php echo $vendedor;?>" method="POST">
                <div class="checkbox">
                    <input type="checkbox" name="estado1" value="Listo">Sin preparar
                    <input type="checkbox" name="estado2" value="Preparado">Preparados
                    <button type="submit" name="ver" class="boton-secundario efecto-botones">Ver</button>
                    <button type="submit" name="imprimir" class="boton-secundario efecto-botones">Imprimir</button>                    
                </div>
            </form>
            <div class="tabla">
                <div class="tabla-lista">                
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Cabecera</th>                   
                            <th>Estado</th>
                            <th>Controles</th>
                        </tr>
                        <?php

                        if(isset($_POST['ver']))
                        {
                            if(!empty($_POST['estado1']))
                            {
                                $estado1 = $_POST['estado1'];
                            } 

                            if(!empty($_POST['estado2']))
                            {
                                $estado2 = $_POST['estado2'];
                            }

                            if ($estado1 != '')
                            {
                                $estado = $estado1;  
                                
                                $nombreCliente = '';
                                $sql= "SELECT * FROM id_pedido WHERE estado = '$estado'";
                                $resultado= mysqli_query($conecta, $sql);
                                while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                                {
                                    $idPedido =  $fila['id'];
                                    $idClienteId_pedido = $fila['id_cliente'];
                                    $estadoPedido = $fila['estado'];
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
                                        <td class="controles">
                                            <a href="<?php echo SERVERURL;?>preparar-pedidos-panel/<?php echo $vendedor;?>/<?php echo $idPedido;?>/gestionar/">
                                                <button type="submit" class="far fa-eye boton-controles efecto-botones"></button>
                                            </a>
                                            <a href="<?php echo SERVERURL;?>imprimir/<?php echo $vendedor;?>/pedido/<?php echo $idPedido;?>">
                                                <button type="submit" class="fas fa-print boton-controles efecto-botones"></button>
                                            </a>
                                        </td>                
                                    </tr>
                                    <?php
                                }
                                mysqli_close($conecta);  
                            }
                            elseif($estado2 != '')
                            {
                                $estado = $estado2;

                                $nombreCliente = '';
                                $sql= "SELECT * FROM id_pedido WHERE estado = '$estado'";
                                $resultado= mysqli_query($conecta, $sql);
                                while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                                {
                                    $idPedido =  $fila['id'];
                                    $idClienteId_pedido = $fila['id_cliente'];
                                    $estadoPedido = $fila['estado'];
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
                                        <td class="controles">
                                            <a href="<?php echo SERVERURL;?>preparar-pedidos-panel/<?php echo $vendedor;?>/<?php echo $idPedido;?>/gestionar/">
                                                <button type="submit" class="far fa-eye boton-controles efecto-botones"></button>
                                            </a>
                                            <a href="<?php echo SERVERURL;?>imprimir/<?php echo $vendedor;?>/pedido/<?php echo $idPedido;?>/">
                                                <button type="submit" class="fas fa-print boton-controles efecto-botones"></button>
                                            </a>
                                        </td>                
                                    </tr>
                                    <?php
                                }
                                mysqli_close($conecta);  
                            }
                            elseif(!empty($estado1) && !empty($estado2))
                            {
                                $nombreCliente = '';
                                $sql= "SELECT * FROM id_pedido WHERE estado != 'Cancelado'";
                                $resultado2= mysqli_query($conecta, $sql);
                                while($fila = mysqli_fetch_array($resultado2, MYSQLI_ASSOC))
                                {
                                    $idPedido =  $fila['id'];
                                    $idClienteId_pedido = $fila['id_cliente'];
                                    $estadoPedido = $fila['estado'];
                                    $cabecera = $fila['cabecera'];
                                                                                                
                                    $sql2= "SELECT * FROM clientes WHERE id = $idClienteId_pedido";
                                    $resultado3= mysqli_query($conecta, $sql2);
                                    while($filas= mysqli_fetch_array($resultado3, MYSQLI_ASSOC))
                                    {
                                        $nombreCliente = $filas['cliente']; 
                                    ?>     
                                    <tr>              
                                        <td><?php echo $idPedido;?></td>                        
                                        <td><?php echo $nombreCliente;}?></td>
                                        <td><?php echo $cabecera;?></td>
                                        <td><?php echo $estadoPedido;?></td>
                                        <td class="controles">
                                            <a href="<?php echo SERVERURL;?>preparar-pedidos-panel/<?php echo $vendedor;?>/<?php echo $idPedido;?>/gestionar/">
                                                <button type="submit" class="far fa-eye boton-controles efecto-botones"></button>
                                            </a>
                                            <a href="<?php echo SERVERURL;?>imprimir/<?php echo $vendedor;?>/pedido/<?php echo $idPedido;?>/">
                                                <button type="submit" class="fas fa-print boton-controles efecto-botones"></button>
                                            </a>
                                        </td>                
                                    </tr>
                                    <?php
                                }
                                mysqli_close($conecta);   
                            }                                  
                        }   
                        else if($buscar != '') 
                        {
                            $nombreCliente = '';
                            $sql = "SELECT * FROM id_pedido WHERE cabecera LIKE '%".$buscar."%' LIMIT 400";
                            $resultado= mysqli_query($conecta, $sql);
                            while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                            {
                                $idPedido =  $fila['id'];
                                $idClienteId_pedido = $fila['id_cliente'];
                                $estadoPedido = $fila['estado'];
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
                                    <td class="controles">
                                        <a href="<?php echo SERVERURL;?>preparar-pedidos-panel/<?php echo $vendedor;?><?php echo $idPedido;?>/gestionar/">
                                            <button type="submit" class="far fa-eye boton-controles efecto-botones"></button>
                                        </a>
                                        <a href="<?php echo SERVERURL;?>imprimir/<?php echo $vendedor;?>/pedido/<?php echo $idPedido;?>/">
                                            <button type="submit" class="fas fa-print boton-controles efecto-botones"></button>
                                        </a>
                                    </td>                
                                </tr>
                                <?php
                            }
                            mysqli_close($conecta);
                        }
                        ?>
                    </table>     
                </div>
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