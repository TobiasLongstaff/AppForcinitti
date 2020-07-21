
<?php

    session_start();

    require 'database.php';
    require 'config.php';

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        $_SESSION['message-error'] = 'Error al conectar la base de datos';
        exit();
    }
    mysqli_select_db($conecta, $database) or die ($_SESSION['message-error'] = 'Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

    $nivel = '';
    $idUsuario = '';
    $vendedor = '';

    if(isset($_GET['vendedor']))
    {    
        $vendedor = $_GET['vendedor'];    
        $sql = "SELECT * FROM usuarios WHERE nombre = '$vendedor'";
        $resultado = mysqli_query($conecta, $sql);
        if(mysqli_num_rows($resultado) == 1)     
        {
            $filas = mysqli_fetch_array($resultado);
            $nivel = $filas['nivel'];
            $idUsuario = $filas['id'];
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
    <link rel="stylesheet" href="<?php echo SERVERURL;?>assets/styles/menu.css">
    <title>Menu</title>
</head>
<body>
    <main class="contenido">    
    <?php if(!empty($vendedor)):?>
        <header>
            <p>Bienvenido: <?php echo $vendedor; ?></p>
            <a href="<?php echo SERVERURL;?>cerrarsesion.php">
               <input type="button" value="Cerrar sesion">
            </a>
        </header> 
    <?php endif; ?>
        <div class="titulo">            
            <h2>Menu</h2>            
            <div class="linea"></div>          
        </div>            
        <selection class="botones">
            <form action="<?php echo SERVERURL;?>pedidos/<?php echo $vendedor;?>/crear/" method="POST">
                <input class="efecto-botones" type="submit" value="Pedidos" <?php if($nivel != '4' && $nivel != '1'){?> 
                                                                                    disabled
                                                                            <?php } ?>>   
            </form>
             
            <a href="<?php echo SERVERURL;?>gestionar-pedidos/<?php echo $vendedor;?>">
                <input class="efecto-botones" type="button" value="Gestionar Pedidos" <?php if($nivel != '2' && $nivel != '1'){?> 
                                                                                        disabled
                                                                                      <?php } ?>>                
            </a>            
            <a href="<?php echo SERVERURL;?>preparar-pedidos/<?php echo $vendedor?>">
                <input class="efecto-botones" type="button" value="Preparar Pedidos"  <?php if($nivel != '3' && $nivel != '1'){?> 
                                                                                        disabled
                                                                                      <?php } ?>>                
            </a>
            <a href="<?php echo SERVERURL;?>agregar-productos.php">
                <input class="efecto-botones" type="button" value="Agregar Producto"  <?php if($nivel != '1'){?> 
                                                                                        disabled
                                                                                      <?php } ?>>                
            </a>

            <a href="<?php echo SERVERURL;?>cliente.php">
                <input class="efecto-botones" type="button" value="Clientes" <?php if($nivel != '1'){?> 
                                                                                disabled
                                                                             <?php } ?>>                
            </a>
            <a href="<?php echo SERVERURL;?>productos.php">
                <input class="efecto-botones" type="button" value="Productos" <?php if($nivel != '1'){?> 
                                                                                disabled
                                                                              <?php } ?>>                  
            </a>
            <div class="linea"></div> 
        </selection>
    </main>
    <script src="assets/plugins/jquery-3.5.1.min.js"></script>
	<script src="assets/plugins/sweetalert2.all.min.js"></script>
	<script src="assets/scripts/app.js"></script>
</body>
</html>