<?php

    require ('database.php');   

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        echo "Error al conectar la base de datos";
        exit();
    }
    mysqli_select_db($conecta, $database) or die ('Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

    //EXTRAER DATOS

    $id_producto = '';
    $nombre = "";
    $precio = "";
    $iva = "";

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

    $id_cliente = '';

    $sql="SELECT * FROM lista_clientes";
    $resultado = mysqli_query($conecta, $sql);

    if($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
    {        
        $id_cliente = $filas['id_cliente'];
    }    

    //AGREGAR DATOS


    $cantidad = '';
    $descuento = '';
    $condicionIva = '';
    $domicilio = '';
    $fechaEntrega = '';

    if(isset($_POST['cantidad']) && isset($_POST['descuento']) && isset($_POST['condicionIva']) && isset($_POST['domicilio']) && isset($_POST['fechaEntrega']))
    {
        $cantidad = $_POST['cantidad'];     
        $descuento = $_POST['descuento'];       
        $condicionIva = $_POST['condicionIva'];
        $domicilio = $_POST['domicilio'];
        $fechaEntrega = $_POST['fechaEntrega'];       
    }

    if(!empty($id_producto) && !empty($_POST['cantidad']))
    {
        $sql3 = "INSERT INTO lista_pedidos (id_procuto, id_cliente, cantidad, descuento, condicionIva, domicilio, fechaEntrega) VALUES ('$id_producto', '$id_cliente' ,'$cantidad', '$descuento', '$condicionIva', '$domicilio', '$fechaEntrega')";
        $resultado2 = mysqli_query($conexion,$sql3);
        if(!$resultado2)
        {
            $message = 'No se a podido guardar el producto';
        }
        else
        {
            $message = 'Producto Guardado';
        }
        mysqli_close($conexion);        
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/styles/pedidos.css">

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
            <button type="submit">Buscar</button>           
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
            <!-- BOTONES -->
            <div class="botones">
                <button type="submit">Agregar Producto</button>
                <a class="boton-2" href="lista.php">
                    <input type="button" value="Ver Lista">
                </a>            
            </div>
        </form>
    </div>
</body>
</html>