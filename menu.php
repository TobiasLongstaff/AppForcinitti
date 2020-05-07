
<?php

    session_start();

    require 'database.php';

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
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/styles/menu.css">
    <title>Menu</title>
</head>
<body>
    <?php if(!empty($user)):?>
        <header>
            <p>Bienvenido: <?= $user['nombre'] ?></p>
            <a href="cerrarsesion.php">
               <input type="button" value="Cerrar sesion">
            </a>
        </header> 
    <?php endif; ?>
    <div class="contenido">
        <div class="titulo">            
            <h2>Menu</h2>            
            <div class="linea"></div>          
        </div>            
        <div class="botones">
            <form action="pedidos.php?crear_pedido=1" method="POST">
                <input type="submit" value="Pedidos">   
            </form>
             
            <a href="lista.php">
                <input type="button" value="Gestionar Pedidos">                
            </a>
            <a href="agregar-productos.php">
                <input type="button" value="Agregar Producto">                
            </a>
            <a href="cliente.php">
                <input type="button" value="Clientes">                
            </a>
            <a href="productos.php">
                <input type="button" value="Productos">                  
            </a>
            <div class="linea"></div> 
        </div>
    </div>
</body>
</html>