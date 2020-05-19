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

    //CREAR PEDIDOS

    $id_producto = '';
    $nombre = '';
    $precio = '';
    $iva = '';
    $id_cliente = '';
    $id_pedido = '';
    $cantidad = '';
    $descuento = '';
    $condicionIva = '';
    $domicilio = '';
    $fechaEntrega = '';
    $id_pedido_cliente = '';
    $nombre_usuario = '';
    $boton_cancelar = '';
    $boton_agregar = '';
  
    //EXTRAER DATOS

    if (isset($_SESSION['user_id']))
    {
        $id_usuario = $_SESSION['user_id'];        
        $records = $conn->prepare('SELECT id, nombre, password FROM usuarios WHERE id =:id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if(count($results) > 0)
        {
            $user = $results;
        }

        $vendedor = $user['nombre'];
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

    $sql="SELECT * FROM lista_clientes";
    $resultado = mysqli_query($conecta, $sql);

    while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
    {        
        $id_cliente = $filas['id_cliente'];
        $id_pedido_cliente = $filas['id_pedido'];
    } 
    
    $sql="SELECT * FROM id_pedido";
    $resultado = mysqli_query($conecta, $sql);

    while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
    {        
        $id_pedido = $filas['id'];
        $nombre_usuario_pedido = $filas['vendedor'];
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

    //AGREGAR DATOS

    if(isset($_POST['cantidad']) && isset($_POST['descuento']) && isset($_POST['condicionIva']) && isset($_POST['domicilio']) && isset($_POST['fechaEntrega']))
    {
        $cantidad = $_POST['cantidad'];     
        $descuento = $_POST['descuento'];       
        $condicionIva = $_POST['condicionIva'];
        $domicilio = $_POST['domicilio'];
        $fechaEntrega = $_POST['fechaEntrega'];       
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
                $sql = "INSERT INTO lista (id_producto, id_pedido , cantidad, descuento, condicionIva) VALUES ('$id_producto', '$id_pedido', '$cantidad', '$descuento', '$condicionIva')";
                $resultado = mysqli_query($conexion,$sql);
    
                $sql2 = "UPDATE id_pedido SET entrega = '$domicilio', id_cliente = '$id_cliente', fecha_entrega = '$fechaEntrega' WHERE id = '$id_pedido'";
                $resultado2 = mysqli_query($conexion,$sql2);
                if(!$resultado && !$resultado2)
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
                $_SESSION['message-error'] = 'Coloque la cantidad';
            }            
        }
        else
        {
            $_SESSION['message-error'] = 'Seleccione un producto';
        }        
    }
    
    if(isset($_GET['crear_pedido']) && !empty($vendedor))
    {

        $sql = "INSERT INTO id_pedido (vendedor) VALUES ('$vendedor')";
        $resultado = mysqli_query($conexion,$sql);   
    }

    if(isset($_POST['pedido-cancelado']))
    {
        $boton_cancelar = $_POST['pedido-cancelado'];        
    }
 
    if($boton_cancelar)
    {
        $sql = "UPDATE id_pedido SET estado = 'Cancelado' WHERE id = '$id_pedido'";
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
    mysqli_close($conexion); 
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

    <title>Pedidos</title>
</head>
<body>
    <main class="contenido">
        <header class="titulo">
            <h2>Pedidos</h2>
        </header>
        <a class="boton clientes" href="cliente.php">
            <input type="button" value="Clientes">
        </a>
        <!-- PRODUCTOS -->
        <form class="productos" method="POST" action="productos.php">
            <div class="label-productos">
                <span>Productos</span>                
            </div>
            <input class="textbox-productos" type="search" name="search" value="<?php echo $nombre;?>">
            <button type="submit" class="fas fa-search boton"></button>             
        </form>
        <!-- INFORMACION -->
        <form method="POST">
            <div class="informacion">
                <div class="leables">
                    <span>Cantidad</span>
                    <span>Precio Unitario</span>
                    <span>Descuento</span>
                    <span>IVA</span>                
                </div>
                <div class="contenedor-textbox">
                    <input class="textbox-cantidad" type="text" name="cantidad">
                    <input class="textbox-precio" type="text" value="<?php echo $precio;?>$">
                    <input class="textbox-descuento" type="text" name="descuento">
                    <input class="textbox-iva" type="text" value="<?php echo $iva;?>%">                 
                </div>   
            </div>
            <!-- CONDICION IVA -->
            <div class="condicion-iva">
                <div class="leable-iva">
                    <span>Condicion IVA</span>                
                </div>
                <input type="text" name="condicionIva">            
            </div>
            <!-- ENTREGA -->
            <div class="entrega">
                <div class="leables-entrega">
                    <span>Domicilio</span>        
                    <span class="leable-2">Fecha de Entrega</span>                
                </div>
                <div class="textbox-entrega">
                    <input type="text" name="domicilio">
                    <input type="datetime" name="fechaEntrega">
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
                <form action="pedidos.php" method="POST">
                    <input class="boton-agregar" name="agregar-producto" type="submit" value="Agregar">                    
                </form>                
                <a class="boton-2" href="lista.php">
                    <input type="button" value="Ver Lista">
                </a>
                <form class="boton-eliminar" action="pedidos.php?" method="POST">
                    <input type="submit" name="pedido-cancelado" value="Salir">                       
                </form>
            </div>
        </form>
    </main>
</body>
</html>