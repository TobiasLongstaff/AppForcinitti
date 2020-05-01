<?php

    include 'database.php';

    $message = '';
    $descripcion = '';
    $precioMinorista = '';
    $precioMayorista = '';
    $precioMasivo = '';
    $codigo = '';
    $iva = '';
    if(isset($_POST['descripcion']))
    {
        $descripcion = $_POST['descripcion'];
    }
    if(isset($_POST['precioMinorista']))
    {
        $precioMinorista = $_POST['precioMinorista'];
    }
    if(isset($_POST['precioMayorista']))
    {
        $precioMayorista = $_POST['precioMayorista'];        
    }
    if(isset($_POST['precioMasivo']))
    {
        $precioMasivo = $_POST['precioMasivo'];
    }
    if(isset($_POST['codigo']))
    {
        $codigo = $_POST['codigo'];
    }
    if(isset($_POST['iva']))
    {
        $iva = $_POST['iva'];
    }
    $sql = "INSERT INTO productos (descripcion, precioMinorista, precioMayorista, precioMasivo, iva, codigo) VALUES ('$descripcion', '$precioMinorista', '$precioMayorista', '$precioMasivo', $iva, '$codigo')";
    $resultado = mysqli_query($conexion,$sql);
    if (!$resultado)
    {
        $message = 'No se a podido guardar el producto';
    }
    else
    {
        $message = 'Producto Guardado';
    }
    mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/agregar-productos.css">
    <title>Agregar Productos</title>
</head>
<body>
    <div class="contenido">
        <div class="titulo">
            <h2>Agregar Productos</h2>        
        </div>
        <form action="agregar-productos.php" method="POST">
            <div class="producto">
                <span>Producto</span> <br>
                <input type="text" name="descripcion">                
            </div>
            <div class="codigo">
                <span>Codigo</span> <br>
                <input type="text" name="codigo">                
            </div>
            <div class="precio-minorista">
                <span>Precio Minorista</span> <br>
                <input type="text" name="precioMinorista">                
            </div>
            <div class="precio-mayorista">
                <span>Precio Mayorista</span> <br>
                <input type="text" name="precioMayorista">                
            </div>
            <div class="precio-venta">
                <span>Precio Venta Masivo</span> <br>
                <input type="text" name="precioMasivo">                
            </div>
            <div class="iva">
                <span>IVA</span> <br>
                <input type="text" name="iva">                
            </div>
            <?php if(!empty($message)):?>
            <p><?= $message ?></p>
            <?php endif; ?>
            <input type="submit" value="Agregar" name="agregar-producto">
            <a href="menu.php">
                <input type="button" value="Volver">
            </a>
        </form>        
    </div>

</body>
</html>