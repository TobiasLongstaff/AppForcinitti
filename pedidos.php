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
  
    //EXTRAER DATOS

    if (isset($_SESSION['user_id']))
    {
        $records = $conn->prepare('SELECT id, nombre, password FROM usuarios WHERE id =:id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if(count($results) > 0)
        {
            $user = $results;
        }

        $usuario = $user['nombre'];
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

    if(!empty($id_producto))
    {
        if(!empty($_POST['cantidad']))
        {
            $sql3 = "INSERT INTO lista (id_producto, id_pedido , id_cliente, cantidad, descuento, condicionIva, domicilio, fechaEntrega) VALUES ('$id_producto', '$id_pedido','$id_cliente' ,'$cantidad', '$descuento', '$condicionIva', '$domicilio', '$fechaEntrega')";
            $resultado2 = mysqli_query($conexion,$sql3);
            if(!$resultado2)
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

    if(isset($_GET['crear_pedido']))
    {

        $sql = "INSERT INTO id_pedido (usuario) VALUES ('$usuario')";
        $resultado = mysqli_query($conexion,$sql);
        if (!$resultado)
        {
            $_SESSION['message-error'] = 'No se a podido guardar el producto';
        }
        else
        {
            $_SESSION['message-correcto'] = 'Producto Guardado';
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
    <div class="contenido">
        <div class="titulo">
            <h2>Pedidos</h2>
        </div>
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
                    <input type="text" name="fechaEntrega">                      
                </div>
            </div>
            <!--ALERTAS-->
            <?php if(isset($_SESSION['message-error'])){?>
                <div class='mensaje-error'>
                   <span><?= $_SESSION['message-error']?></span>
                </div>
            <?php session_unset(); } ?>
            <?php if(isset($_SESSION['message-correcto'])){?>
                <div class='mensaje-correcto'>
                   <span><?= $_SESSION['message-correcto']?></span>
                </div>
            <?php session_unset(); } ?>              
            <!-- BOTONES -->
            <div class="botones">                
                <button class="boton" type="submit">Agregar Producto</button>
                <a class="boton-2" href="lista.php">
                    <input type="button" value="Ver Lista">
                </a>
                <a class="boton-eliminar" href="menu.php">
                    <button>Cancelar Pedido</button>
                </a>                       
            </div>
        </form>
    </div>
    <!--ALERTA-->
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="js/sweetAlert.js"></script> -->
</body>
</html>