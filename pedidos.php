<?php

    require ('database.php');   

    $nombre = "";
    $precio = "";
    $iva = "";

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        echo "Error al conectar la base de datos";
        exit();
    }
    mysqli_select_db($conecta, $database) or die ('Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

    // if (!empty($id))
    if(isset($_GET['id']))
    {    
        $id = $_GET['id'];
        $sql = "SELECT * FROM productos WHERE id = $id";
        $resultado = mysqli_query($conecta, $sql);
        if(mysqli_num_rows($resultado) == 1)     
        {
            $filas = mysqli_fetch_array($resultado);
            $nombre = $filas['descripcion'];
            $precio = $filas['precioMinorista'];
            $iva = $filas['iva'];
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

    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">    
    <title>Pedidos</title>
</head>
<body>
    <div class="contenido" method="POST" action="">
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
        <div class="informacion">
            <div class="leables">
                <span>Cantidad</span>
                <span>Precio Unitario</span>
                <span>Descuento</span>
                <span>IVA</span>                
            </div>
            <div class="contenedor-textbox">
                <input class="textbox-cantidad" type="text">
                <input class="textbox-precio" type="text" value="<?php echo $precio;?>$">
                <input class="textbox-descuento" type="text">
                <input class="textbox-iva" type="text" value="<?php echo $iva;?>%">                 
            </div>   
        </div>
        <!-- CONDICION IVA -->
        <div class="condicion-iva">
            <div class="leable-iva">
                <span>Condicion IVA</span>                
            </div>
            <input type="text" name="">            
        </div>
        <!-- ENTREGA -->
        <div class="entrega">
            <div class="leables-entrega">
                <span>Domicilio</span>        
                <span class="leable-2">Fecha de Entrega</span>                
            </div>
            <div class="textbox-entrega">
                <input type="text" name="">
                <input type="text" name="">                      
            </div>
        </div>
        <!-- BOTONES -->
        <div class="botones">
            <a class="boton" href="lista.php">
                <button class="">Agregar Producto</button>
            </a>
            <a class="boton-2" href="lista.php">
                <input type="button" value="Ver Lista">
            </a>            
        </div>
    </div>
</body>
</html>