<?php

    include 'database.php';

    $fecha = '';

    if(isset($_POST['fecha']))
    {
        $fecha = $_POST['fecha'];
    }
    $sql = "INSERT INTO id_pedido (fecha) VALUES ('$fecha')";
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
    <title>Menu Pedidos</title>
</head>
<body>
    <form action="pedidos.php" method="POST">
        <input type="text" name="fecha">
        <input type="submit" value="Nuevo pedido">    
    </form>
</body>
</html>