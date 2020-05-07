<?php

    include 'database.php';

    session_start();

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

        $sql = "INSERT INTO id_pedido (usuario) VALUES ('$usuario')";
        $resultado = mysqli_query($conexion,$sql);
        if (!$resultado)
        {
            $message = 'No se a podido guardar el producto';
        }
        else
        {
            $message = 'Producto Guardado';
        }   
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
    <form method="POST">
        <input type="submit" value="Nuevo pedido">    
    </form>
</body>
</html>