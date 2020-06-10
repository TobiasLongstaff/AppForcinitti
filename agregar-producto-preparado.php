<?php

    require ('database.php');    
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


    if(isset($_GET['id_pedido']))
    {
        $idPedido = $_GET['id_pedido'];
        $sql = "INSERT INTO lista_preparar (id_pedido) VALUES ('$idPedido')";
        $resultado = mysqli_query($conexion,$sql);
    }

    $sql="SELECT * FROM lista_preparar WHERE descripcion = ''";
    $resultado = mysqli_query($conecta, $sql);
    if($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
    {        
        $idPedido = $filas['id_pedido'];
    }

    if(isset($_GET['id']))
    {    
        $id = $_GET['id'];
        $sql2 = "SELECT * FROM productos WHERE id = $id";
        $resultado = mysqli_query($conecta, $sql2);
        if(mysqli_num_rows($resultado) == 1)     
        {
            $filas = mysqli_fetch_array($resultado);
            $id_producto = $filas['id'];
            $nombre = $filas['descripcion'];
            $precio = $filas['precioMinorista'];
            $iva = $filas['iva'];
        }
    }

    if(isset($_POST['cantidad']) && isset($_POST['descuento']) && isset($_POST['condicionIva']) &&  isset($_POST['precio']))
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
            if(!empty($_POST['cantidad']))
            {
                $sql = "UPDATE lista_preparar SET id_producto = '$id_producto', cantidad = '$cantidad', descuento = '$descuento', condicionIva = '$condicionIva', descripcion = '$nombre', precio = '$precio' WHERE id_producto = ''";
                $resultado = mysqli_query($conexion,$sql);
                header("Location: preparar-pedido-panel.php?id_update=$idPedido");
            }
            else
            {
                $_SESSION['message-error'] = 'Coloque la cantidad';
            }            
        }
        else
        {
            $_SESSION['message-error'] = 'Seleccione un producto';
        }        
    }

    if(isset($_POST['boton-volver']))
    {
        $boton_volver = $_POST['boton-volver'];
    }

    if($boton_volver)
    {
        $sql = "DELETE FROM lista_preparar WHERE descripcion = ''";
        $resultado = mysqli_query($conecta, $sql);  
        if(!$resultado)
        {
            die('error al eliminar');
        }
        else
        {
            header("Location: preparar-pedido-panel.php?id_update=$idPedido");
        }
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/styles/pedidos.css">
    <link rel="stylesheet" href="assets/styles/message.css">
    
    <!-- ICONOS -->
    <script src="https://kit.fontawesome.com/1b601aa92b.js" crossorigin="anonymous"></script>
    
    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet"> 

    <title>Agregar Producto</title>
</head>
<body>
    <div class="pedidos">
        <main class="contenido">
            <header class="titulo">
                <h2>Agregar Producto</h2>
            </header>
            <!-- PRODUCTOS -->
            <form class="productos" method="POST" action="productos.php?preparado=<?php echo '1';?>">
                <div class="label-productos">
                    <span>Productos</span>                
                </div>
                <input class="textbox-productos efecto" type="search" name="search" value="<?php echo $nombre;?>">
                <button type="submit" class="fas fa-search boton efecto-botones"></button>             
            </form>
            <!-- INFORMACION -->
            <form method="POST">
                <div class="informacion">
                    <div class="leables">
                        <span class="leable-cantidad">Cantidad</span>
                        <span class="leable-precio">Precio Unitario</span>
                        <span class="leable-descuento">Descuento</span>
                        <span class="leable-iva">IVA</span>                
                    </div>
                    <div class="contenedor-textbox">
                        <input class="textbox-cantidad efecto" type="text" name="cantidad">
                        <input class="textbox-precio efecto" type="text" name="precio" value="<?php echo $precio;?>$">
                        <input class="textbox-descuento efecto" type="text" name="descuento">
                        <input class="textbox-iva efecto" type="text" value="<?php echo $iva;?>%">                 
                    </div>   
                </div>
                <!-- CONDICION IVA -->
                <div class="condicion-iva">
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
                <div class="botones">
                    <form class="boton boton-agregar" action="pedidos.php" method="POST">
                        <input class="efecto-botones" name="agregar-producto" type="submit" value="Agregar">                    
                    </form>
                    <form class="boton-2" action="agregar-producto-preparado.php?id_pedido=<?php echo $idPedido; ?>" method="POST">
                        <input class="efecto-botones" type="submit" name="boton-volver" value="Volver">
                    </form>
                </div>
            </form>
        </main>        
    </div>
</body>
</html>