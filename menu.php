
<?php

    session_start();

    require 'database.php';

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        $_SESSION['message-error'] = 'Error al conectar la base de datos';
        exit();
    }
    mysqli_select_db($conecta, $database) or die ($_SESSION['message-error'] = 'Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

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
    else
    {
        if(isset($_GET['id']))
        {    
            $id = $_GET['id'];    
            $sql = "SELECT nombre, id FROM usuarios WHERE id = $id";
            $resultado = mysqli_query($conecta, $sql);
            if(mysqli_num_rows($resultado) == 1)     
            {
                $filas = mysqli_fetch_array($resultado);
                $user['nombre'] = $filas['nombre'];
                $_SESSION['user_id'] = $id;
            }
        }
    }

    if(!empty($_GET['id']))
    {
      
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
    <main class="contenido">    
    <?php if(!empty($user)):?>
        <header>
            <p>Bienvenido: <?= $user['nombre'] ?></p>
            <a href="cerrarsesion.php">
               <input type="button" value="Cerrar sesion">
            </a>
        </header> 
    <?php endif; ?>
        <div class="titulo">            
            <h2>Menu</h2>            
            <div class="linea"></div>          
        </div>            
        <selection class="botones">
            <form action="pedidos.php?crear_pedido=1" method="POST">
                <input class="efecto-botones" type="submit" value="Pedidos">   
            </form>
             
            <a href="lista.php">
                <input class="efecto-botones" type="button" value="Gestionar Pedidos">                
            </a>
            <a href="agregar-productos.php">
                <input class="efecto-botones" type="button" value="Agregar Producto">                
            </a>
            <a href="cliente.php">
                <input class="efecto-botones" type="button" value="Clientes">                
            </a>
            <a href="productos.php">
                <input class="efecto-botones" type="button" value="Productos">                  
            </a>
            <div class="linea"></div> 
        </selection>
    </main>
    <script type="text/javascript" src="js/desabilitar_elementos.js"></script>
</body>
</html>