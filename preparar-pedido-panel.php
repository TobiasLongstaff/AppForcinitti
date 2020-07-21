<?php

    include 'database.php';
    require 'config.php';

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
    $vendedor = '';
    $tipo = '';
    $ruta = '';
    $titulo = '';

    if(isset($_GET['vendedor']))
    {
        $url=explode("/", $_GET['vendedor']);
        $vendedor = $url[0];
        $idPedido = $url[1];
        $tipo = $url[2];

        if($tipo != '')
        {
            $tipo = 'gestionar/';
            $ruta = 'gestionar-pedidos/';
            $titulo = 'Ver Pedido';
        }
        else
        {
            $ruta = 'preparar-pedidos/';
            $titulo = 'Panel de Preparado';
        }
    }

    $sql="SELECT * FROM clientes WHERE $idPedido";
    $resultado = mysqli_query($conecta, $sql);
    while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
    {        
        $cliente = $filas['nombre'];
    }
?>
<!DOCTYPE html>
<html lang="en">
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

    <title><?php echo $titulo;?></title>
</head>
<body>
    <div class="contenido-productos">
        <main class="contenido">
            <header class="titulo">
                <h2><?php echo $titulo;?></h2>
            </header>
            <div class="informacion animate__animated animate__fadeIn animate__delay-1s animacion2">
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
            <div class="tabla-lista animate__animated animate__fadeIn animate__delay-1s animacion3">
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

                            $sql2= "SELECT SUM((precio * cantidad) - descuento) AS total FROM lista_preparar WHERE id_pedido = $idPedido";
                            $resultado2= mysqli_query($conecta, $sql2);
                            while($fila= mysqli_fetch_array($resultado2, MYSQLI_ASSOC))
                            {
                                $total= $fila['total'];
                            }  
            
                            $sql3 = "UPDATE id_pedido SET total = '$total' WHERE id = '$idPedido'";
                            $resultado3 = mysqli_query($conexion,$sql3);
                        ?>
                            <td><?php echo $cantidadListaPreparar?></td>
                            <td><?php echo $descripcionListaPreparar?></td>
                            <td class="controles">
                                <a href="<?php echo SERVERURL;?>actualizar-pedido-preparado/<?php echo $vendedor;?>/<?php echo $id;?>/<?php echo $tipo;?>">
                                    <button type="submit" class="fas fa-edit boton-controles efecto-botones"></button>
                                </a>
                                <a class="btn-eliminar" href="<?php echo SERVERURL;?>eliminar-producto-preparado.php?id=<?php echo $id;?>&vendedor=<?php echo $vendedor;?>&gestionar=<?php echo $tipo;?>">
                                    <button class="fas fa-trash-alt boton-controles efecto-botones"></button> 
                                </a>
                            </td>
                            </tr> 
                    <?php               
                        }
                        mysqli_close($conexion); 
                    ?>   
                </table>            
            </div>

            <div class="botones ">
                <a class="form-botones btn-finalizar" href="<?php echo SERVERURL;?>preparar-pedido-preparado.php?id_update=<?php echo $idPedido;?>&vendedor=<?php echo $vendedor;?>">
                    <input class="efecto-botones animate__animated animate__fadeIn animate__delay-1s animacion4" type="submit" value="Preparado" 
                    <?php if($tipo != '')
                    {
                    ?>
                        disabled
                    <?php
                    }
                    ?>>   
                </a>
                <a href="<?php echo SERVERURL;?>agregar-producto-preparado/<?php echo $vendedor;?>/agregar/<?php echo $idPedido;?>/<?php echo $tipo;?>">
                    <input class="efecto-botones animate__animated animate__fadeIn animate__delay-1s animacion5" type="submit" value="Agregar">                
                </a>
                <a href="<?php echo SERVERURL; echo $ruta; echo $vendedor;?>">
                    <input class="efecto-botones animate__animated animate__fadeIn animate__delay-1s animacion6" type="submit" value="Salir"> 
                </a>  
            </div>
        </main>
    </div>
    <script src="<?php echo SERVERURL;?>assets/plugins/jquery-3.5.1.min.js"></script>
	<script src="<?php echo SERVERURL;?>assets/plugins/sweetalert2.all.min.js"></script>
	<script src="<?php echo SERVERURL;?>assets/scripts/app.js"></script>
</body>
</html>