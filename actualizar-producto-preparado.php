<?php

    require 'database.php';    
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
    $boton_editar = '';
    $idPedido = '';
    $cantidad = '';
    $descuento = '';
    $condicionIva = '';
    $boton_volver = '';
    $id = '';
    $idmedida = '';
    $total = '';
    $tipo = '';
    $gestionar = '';

    if(isset($_GET['vendedor']))
    {
        $url=explode("/", $_GET['vendedor']);
        $vendedor = $url[0];
        $tipo = $url[1];
        $idActualizar = $url[2];
        if($url[2] == 'gestionar')
        {
           $gestionar = 'gestionar/'; 
        }

        if($tipo == 'producto')
        {
            if($url[4] == 'gestionar')
            {
                $gestionar = 'gestionar/';
            }

            if(!empty($url[3]))
            {
                $idActualizar = $url[3];

                $sql = "SELECT * FROM lista_preparar WHERE id = '$idActualizar'";
                $resultado = mysqli_query($conecta, $sql);
                while($filas = mysqli_fetch_array($resultado))
                {
                    $idPedido = $filas['id_pedido'];
                }
                
                $id = $url[2];

                $sql2 = "SELECT * FROM productos WHERE id = $id";
                $resultado2 = mysqli_query($conecta, $sql2);
                if(mysqli_num_rows($resultado2) == 1)
                {
                    $filas = mysqli_fetch_array($resultado2);
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
            else
            {
                $id = $url[2];
                $sql2 = "SELECT * FROM productos WHERE id = $id";
                $resultado = mysqli_query($conecta, $sql2);
                if(mysqli_num_rows($resultado) == 1)     
                {
                    $filas = mysqli_fetch_array($resultado);
                    $id_producto = $filas['id'];
                    $nombre = $filas['descripcion'];
                    $precio = $filas['precioMinorista'];
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
        }
        else
        {
            $idActualizar = $url[1];

            $sql = "SELECT * FROM lista_preparar WHERE id = '$idActualizar'";
            $resultado = mysqli_query($conecta, $sql);
            while($filas = mysqli_fetch_array($resultado))
            {
                $idPedido = $filas['id_pedido'];
                $id_producto = $filas['id_producto'];
                $cantidad = $filas['cantidad'];
                $descuento = $filas['descuento'];
                $iva = $filas['condicionIva'];
                $nombre = $filas['descripcion'];
                $precio = $filas['precio'];

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
    }

    if(isset($_POST['cantidad']) && isset($_POST['descuento']) && isset($_POST['condicionIva']) &&  isset($_POST['precio']))
    {
        $cantidad = $_POST['cantidad'];     
        $descuento = $_POST['descuento'];       
        $condicionIva = $_POST['condicionIva'];
        $precio = $_POST['precio'];     
    } 

    if(isset($_POST['editar-producto']))
    {
        $boton_editar = $_POST['editar-producto'];
    }

    if($boton_editar)
    {
        if(!empty($nombre))
        {
            if($cantidad != '0')
            {
                $sql = "UPDATE lista_preparar SET id_producto = '$id_producto', cantidad = '$cantidad', descuento = '$descuento', condicionIva = '$condicionIva', descripcion = '$nombre', precio = '$precio', medida = '$idmedida' WHERE id = '$idActualizar'";
                $resultado = mysqli_query($conexion,$sql);  
                if(!$resultado)
                {
                    $_SESSION['message-error'] = 'Error al editar'; 
                }
                else
                {
                    $_SESSION['message-correcto'] = 'El producto de edito correctamente';
                }
            }
            else
            {
                $_SESSION['message-error'] = 'La cantidad no puede ser cero'; 
            }
        }
        else
        {
            $_SESSION['message-error'] = 'Seleccione un producto';
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
    <link rel="stylesheet" href="<?php echo SERVERURL;?>assets/styles/pedidos.css">
    <link rel="stylesheet" href="<?php echo SERVERURL;?>assets/styles/message.css">
    
    <!-- ICONOS -->
    <script src="https://kit.fontawesome.com/1b601aa92b.js" crossorigin="anonymous"></script>
    
    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet"> 

    <!-- ANIMACIONES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">

    <title>Edita Producto</title>
</head>
<body>
    <div class="pedidos">
        <main class="contenido-actualizar">
            <header class="titulo">
                <h2>Editar Producto</h2>
            </header>
            <!-- PRODUCTOS -->
            <form class="productos animate__animated animate__fadeIn" method="POST" action="<?php echo SERVERURL;?>productos/<?php echo $vendedor;?>/2/<?php echo $idActualizar;?>/<?php echo $gestionar;?>">
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
                        <input class="textbox-cantidad efecto" type="text" name="cantidad" required="" <?php if($medida == 'un')
                                                                                                            {
                                                                                                        ?>
                                                                                                                pattern="[0-9]+"
                                                                                                        <?php  
                                                                                                            }
                                                                                                            elseif($medida == 'kg')
                                                                                                            {
                                                                                                        ?>
                                                                                                                pattern="[0-9]+(\.[0-9][0-9]?)?"
                                                                                                        <?php      
                                                                                                            }
                                                                                                        ?> value="<?php echo $cantidad;?>">
                        <input class="textbox-iva efecto" type="text" name="cantidad" value="<?php echo $medida;?>"disabled>
                        <input class="textbox-precio efecto" type="text" name="precio" required="" pattern="[0-9]+.[0-9]+" value="<?php echo $precio;?>">
                        <input class="textbox-descuento efecto" type="text" name="descuento" value="<?php echo $descuento; ?>">
                        <input class="textbox-iva efecto" type="text" value="<?php echo $iva.'%';?>">                 
                    </div>   
                </div>
                <!-- CONDICION IVA -->
                <div class="condicion-iva animate__animated animate__fadeIn animate__delay-1s animacion3">
                    <div class="leable-iva">
                        <span>Condicion IVA</span>                
                    </div>
                    <input class="efecto" type="text" name="condicionIva" value="<?php echo $iva;?>">            
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
                    <form class="boton boton-agregar" action="<?php echo SERVERURL;?>actualizar-producto-preparado.php" method="POST">
                        <input class="efecto-botones animate__animated animate__fadeIn animate__delay-1s animacion4" name="editar-producto" type="submit" value="Editar">                    
                    </form>
                    <a class="boton-2 animate__animated animate__fadeIn animate__delay-1s animacion5" href="<?php echo SERVERURL;?>preparar-pedidos-panel/<?php echo $vendedor;?>/<?php echo $idPedido;?>/<?php echo $gestionar;?>">
                        <input class="efecto-botones" type="button" name="boton-volver" value="Volver">
                    </a>
                </div>
            </form>
        </main>        
    </div>
</body>
</html>