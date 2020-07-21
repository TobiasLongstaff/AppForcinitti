<?php

    require ('database.php');
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

    $nombre = '';
    $precio = '';
    $iva = '';
    $boton_agregar = '';
    $idPedido = '';
    $cantidad = '';
    $descuento = '';
    $condicionIva = '';
    $boton_volver = '';
    $vendedor = '';
    $idmedida = '';
    $medida = '';
    $tipo = '';


    if(isset($_GET['vendedor']))
    {
        $url=explode("/", $_GET['vendedor']);
        $vendedor = $url[0];
        $idPedido = $url[1];

        if($url[2] == 'gestionar')
        {
            $tipo = 'gestionar/';
        }

        if($idPedido == 'producto')
        {
            if($url[4] == 'gestionar')
            {
                $tipo = 'gestionar/';
            }

            $id = $url[2];
            if(!empty($url[3]))
            {
                $idPedido = $url[3];
            }
            $sql2 = "SELECT * FROM productos WHERE id = $id";
            $resultado = mysqli_query($conecta, $sql2);
            if(mysqli_num_rows($resultado) == 1)     
            {
                $filas = mysqli_fetch_array($resultado);
                $id_producto = $filas['id'];
                $nombre = $filas['descripcion'];
                $precio = $filas['preciominorista'];
                $iva = $filas['iva'];
                $idmedida = $filas['idmedida'];

                if($idmedida == 3 or $idmedida == 1)
                {
                    $medida = 'un';
                }
                else
                {
                    $medida = 'kg';
                }
            }
        }
        elseif($idPedido == 'agregar')
        {
            if($url[3] == 'gestionar')
            {
                $tipo = 'gestionar/';
            }
            $idPedido = $url[2];
            $sql = "INSERT INTO lista_preparar (id_pedido) VALUES ('$idPedido')";
            $resultado = mysqli_query($conexion,$sql);            
        }
        else
        {
            $idPedido = $url[1];
            $sql="SELECT * FROM lista_preparar WHERE descripcion = ''";
            $resultado = mysqli_query($conecta, $sql);
            if($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
            {        
                $idPedido = $filas['id_pedido'];
            }
        }
    }

    if(isset($_POST['cantidad']) && isset($_POST['descuento']) && isset($_POST['condicionIva']) && isset($_POST['precio']))
    {
        $cantidad = $_POST['cantidad'];     
        $descuento = $_POST['descuento'];       
        $condicionIva = $_POST['condicionIva'];
        $precio = $_POST['precio'];     
    }

    if(isset($_POST['agregar-producto']))
    {
        $boton_agregar = $_POST['agregar-producto'];
    }
    
    if($boton_agregar)
    {
        if(!empty($id_producto))
        {
            $sql = "UPDATE lista_preparar SET id_producto = '$id_producto', cantidad = '$cantidad', descuento = '$descuento', condicionIva = '$condicionIva', descripcion = '$nombre', precio = '$precio', medida = '$idmedida' WHERE id_producto = ''";
            $resultado = mysqli_query($conexion,$sql);
            if($resultado)
            {
                $_SESSION['message-correcto'] = 'Producto Agregardo';
            }
        }
        else
        {
            $_SESSION['message-error'] = 'Colocar Producto';
        }
    }

    if(isset($_POST['boton-volver']))
    {
        $boton_volver = $_POST['boton-volver'];
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
    <link rel="stylesheet" href="<?php echo SERVERURL;?>assets/styles/pedidos.css">
    <link rel="stylesheet" href="<?php echo SERVERURL;?>assets/styles/message.css">
    
    <!-- ICONOS -->
    <script src="https://kit.fontawesome.com/1b601aa92b.js" crossorigin="anonymous"></script>
    
    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet"> 

    <!-- ANIMACIONES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">

    <title>Agregar Producto</title>
</head>
<body>
    <div class="pedidos">
        <main class="contenido-actualizar">
            <header class="titulo">
                <h2>Agregar Producto</h2>
            </header>
            <!-- PRODUCTOS -->
            <form class="productos animate__animated animate__fadeIn" method="POST" action="<?php echo SERVERURL;?>productos/<?php echo $vendedor;?>/1/<?php echo $idPedido;?>/<?php echo $tipo;?>">
                <div class="label-productos">
                    <span>Productos</span>                
                </div>
                <input class="textbox-productos efecto" type="search" name="search" value="<?php echo $nombre;?>">
                <button type="submit" class="fas fa-search boton efecto-botones"></button>             
            </form>
            <!-- INFORMACION -->
            <form method="POST">
                <div class="informacion animate__animated animate__fadeIn animate__delay-1s animacion2">
                    <div class="leables">
                        <span class="leable-cantidad">Cantidad</span>
                        <span class="leable-medida">Me.</span>
                        <span class="leable-precio">Precio Unitario</span>
                        <span class="leable-descuento">Dto.</span>
                        <span class="leable-iva">IVA</span>                
                    </div>
                    <div class="contenedor-textbox animate__animated animate__fadeIn animate__delay-1s animacion2">
                        <input class="textbox-cantidad efecto" type="text" name="cantidad" required="" pattern="[1-9]+" value="<?php echo $cantidad;?>">
                        <input class="textbox-iva efecto" type="text" name="cantidad" value="<?php echo $medida;?>"disabled>
                        <input class="textbox-precio efecto" type="text" name="precio" required="" pattern="[0-9]+.[0-9]+" value="<?php echo $precio;?>">
                        <input class="textbox-descuento efecto" type="text" name="descuento">
                        <input class="textbox-iva efecto" type="text" value="<?php echo $iva.'%';?>">                 
                    </div>   
                </div>
                <!-- CONDICION IVA -->
                <div class="condicion-iva animate__animated animate__fadeIn animate__delay-1s animacion3">
                    <div class="leable-iva">
                        <span>Condicion IVA</span>                
                    </div>
                    <input class="efecto" type="text" name="condicionIva">            
                </div>
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
                <!-- BOTONES -->
                <div class="botones-actualizar">
                    <form class="boton boton-agregar" action="<?php echo SERVERURL;?>agregar-producto-preparado/<?php echo $vendedor;?>" method="POST">
                        <input class="efecto-botones animate__animated animate__fadeIn animate__delay-1s animacion4" name="agregar-producto" type="submit" value="Agregar">                   
                    </form>
                    <form class="boton-2" action="<?php echo SERVERURL;?>eliminar-producto-lista-preparado.php?vendedor=<?php echo $vendedor;?>&id=<?php echo $idPedido;?>&gestionar=<?php echo $tipo;?>" method="POST">
                        <input class="efecto-botones animate__animated animate__fadeIn animate__delay-1s animacion5" type="submit" name="boton-volver" value="Volver">
                    </form>
                </div>
            </form>
        </main>        
    </div>
</body>
</html>