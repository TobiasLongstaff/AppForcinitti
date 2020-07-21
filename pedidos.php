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

    $id_producto = '';
    $nombre = '';
    $precio = '';
    $iva = '';
    $id_cliente = '';
    $id_pedido = '';
    $cantidad = '';
    $medida = '';
    $descuento = '';
    $condicionIva = '';
    $domicilio = '';
    $fechaEntrega = '';
    $boton_agregar = '';
    $cabecera = '';
    $vendedor = '';
    $idmedida = '';
    //EXTRAER DATOS
    

    if(isset($_GET['vendedor']))
    {
        $url=explode("/", $_GET['vendedor']);
        $vendedor = $url[0];
        if($url[1] == 'crear')
        {
            $sql = "INSERT INTO id_pedido (vendedor) VALUES ('$vendedor')";
            $resultado = mysqli_query($conexion,$sql);              
        }
        elseif($url[1] == 'producto')
        {
            $id = $url[2];
            if(!empty($id))
            {
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
        }


        $sql="SELECT * FROM id_pedido WHERE vendedor = '$vendedor'";
        $resultado = mysqli_query($conecta, $sql);
        while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
        {        
            $id_pedido = $filas['id'];
            $domicilio = $filas['entrega'];
            $fechaEntrega = $filas['fecha_entrega'];
            $id_cliente = $filas['id_cliente'];
            $cabecera = $filas['cabecera'];
        }
    }

    //AGREGAR DATOS

    if(isset($_POST['cabecera']))
    {
        $cabecera = $_POST['cabecera'];

        $sql = "UPDATE id_pedido SET cabecera = '$cabecera' WHERE id = '$id_pedido'";
        $resultado = mysqli_query($conexion,$sql);
        if(!$resultado)
        {
            $_SESSION['message-error'] = 'No se a podido guardar el producto';
        }
        else
        {
            $_SESSION['message-correcto'] = 'Producto Guardado';
        } 

    }

    if(isset($_POST['cantidad']) && isset($_POST['descuento']) && isset($_POST['condicionIva']) && isset($_POST['domicilio']) && isset($_POST['fechaEntrega']) && isset($_POST['precio']))
    {
        $cantidad = $_POST['cantidad'];     
        $descuento = $_POST['descuento'];       
        $condicionIva = $_POST['condicionIva'];
        $domicilio = $_POST['domicilio'];
        $fechaEntrega = $_POST['fechaEntrega'];  
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
            $sql = "INSERT INTO lista (id_producto, id_pedido, cantidad, descuento, condicionIva, descripcion, precio, medida) VALUES ('$id_producto', '$id_pedido', '$cantidad', '$descuento', '$condicionIva', '$nombre', '$precio', '$idmedida')";
            $resultado = mysqli_query($conexion,$sql);

            $sql2 = "INSERT INTO lista_preparar (id_producto, id_pedido, cantidad, descuento, condicionIva, descripcion, precio, medida) VALUES ('$id_producto', '$id_pedido', '$cantidad', '$descuento', '$condicionIva', '$nombre', '$precio', '$idmedida')";
            $resultado2 = mysqli_query($conexion,$sql2);
    
            $sql3 = "UPDATE id_pedido SET entrega = '$domicilio', id_cliente = '$id_cliente', fecha_entrega = '$fechaEntrega' WHERE id = '$id_pedido'";
            $resultado3 = mysqli_query($conexion,$sql3);
            if(!$resultado && !$resultado3)
            {
                $_SESSION['message-error'] = 'No se a podido guardar el producto';
            }
            else
            {
                $_SESSION['message-correcto'] = 'Producto Guardado';
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
    <title>Pedidos</title>
</head>
<body>
    <div class="pedidos">
        <main class="contenido animate__animated animate__backInRight">
            <header class="titulo">
                <h2>Pedidos</h2>
            </header>
            <a class="boton clientes" href="<?php echo SERVERURL;?>clientes/<?php echo $vendedor;?>">
                <input class="efecto-botones" type="button" value="Clientes">
            </a>
            <!-- CABECERA -->
            <form class="cabecera" method="POST" action="<?php echo SERVERURL;?>pedidos/<?php echo $vendedor;?>/">
                <div class="label-productos">
                    <span>Nombre de cabecera</span>                
                </div>
                <input class="textbox-cabecera efecto" type="search" name="cabecera" required="" value="<?php echo $cabecera;?>">
                <button type="submit" class="fas fa-user-plus boton efecto-botones"></button>             
            </form>
            <!-- PRODUCTOS -->
            <form class="productos" method="POST" action="<?php echo SERVERURL;?>productos/<?php echo $vendedor;?>/">
                <div class="label-productos">
                    <span>Productos</span>                
                </div>
                <input class="textbox-productos efecto" type="search" name="search" value="<?php echo $nombre;?>">
                <button type="submit" class="fas fa-search boton efecto-botones"></button>             
            </form>
            <!-- INFORMACION -->
            <form action="<?php echo SERVERURL;?>pedidos/<?php echo $vendedor;?>/producto/<?php echo $id_producto;?>" method="POST">
                <div class="informacion">
                    <div class="leables">
                        <span class="leable-cantidad">Cantidad</span>
                        <span class="leable-medida">Me.</span>
                        <span class="leable-precio">Precio Unitario</span>
                        <span class="leable-descuento">Dto.</span>
                        <span class="leable-iva">IVA</span>                
                    </div>
                    <div class="contenedor-textbox">
                        <input class="textbox-cantidad efecto" type="text" name="cantidad" required="" pattern="[1-9]+" value="<?php echo $cantidad;?>">
                        <input class="textbox-iva efecto" type="text" name="cantidad" value="<?php echo $medida;?>"disabled>
                        <input class="textbox-precio efecto" type="text" name="precio" required="" pattern="[0-9]+.[0-9]+" value="<?php echo $precio;?>">
                        <input class="textbox-descuento efecto" type="text" name="descuento">
                        <input class="textbox-iva efecto" type="text" value="<?php echo $iva.'%';?>">                 
                    </div>   
                </div>
                <!-- CONDICION IVA -->
                <div class="condicion-iva">
                    <div class="leable-iva">
                        <span>Condicion IVA</span>                
                    </div>
                    <input class="efecto" type="text" name="condicionIva">            
                </div>
                <!-- ENTREGA -->
                <div class="entrega">
                    <div class="leables-entrega">
                        <span class="leable-domicilio" >Domicilio</span>        
                        <span class="leable-fecha">Fecha de Entrega</span>                
                    </div>
                    <div class="textbox-entrega">
                        <input class="efecto" type="text" name="domicilio" value="<?php echo $domicilio;?>">
                        <input class="efecto" type="datetime" name="fechaEntrega" value="<?php echo $fechaEntrega;?>">
                    </div>
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
                    <form class="boton boton-agregar" action="<?php echo SERVERURL;?>pedidos/<?php echo $vendedor;?>/" method="POST">
                        <input class="efecto-botones" name="agregar-producto" type="submit" value="Agregar">                    
                    </form>
                    <a class="boton-2" href="<?php echo SERVERURL;?>lista/<?php echo $vendedor;?>/">
                        <input class="efecto-botones" type="button" value="Ver Lista">
                    </a>
                    <a href="<?php echo SERVERURL;?>cancelar-pedido.php?id=<?php echo $id_pedido;?>&vendedor=<?php echo $vendedor;?>" class="btn-cancelar boton-eliminar">
                        <input class="efecto-botones" type="button" value="Salir">
                    </a> 
                </div>
            </form>
        </main>        
    </div>
    <script src="<?php echo SERVERURL;?>assets/plugins/jquery-3.5.1.min.js"></script>
	<script src="<?php echo SERVERURL;?>assets/plugins/sweetalert2.all.min.js"></script>
	<script src="<?php echo SERVERURL;?>assets/scripts/app.js"></script>
</body>
</html>