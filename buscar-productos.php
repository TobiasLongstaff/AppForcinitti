<?php

    require ('database.php');

    $buscar = $_POST["search"];       

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        echo "Error al conectar la base de datos";
        exit();
    }
    mysqli_select_db($conecta, $database) or die ('Error al conectar');
    mysqli_set_charset($conecta, 'utf8');
    $query = "SELECT * FROM productos WHERE descripcion LIKE '%".$buscar."%' LIMIT 6";
    $resultado = mysqli_query($conecta, $query);

    while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
    {
        $nombre = $fila['descripcion'];
        $precioMin = $fila['precioMinorista'];
        $precioMay = $fila['precioMayorista'];
        $precioMas = $fila['precioMasivo'];
        $iva = $fila['iva'];
        $codigo = $fila['codigo'];
    }
    mysqli_close($conecta);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS -->
    <link rel="stylesheet" href="assets/styles/productos.css">
    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">
    <title>Buscar Productos</title>
</head>
<body>
    <div class="contenido">
        <div class="titulo">
            <h2>Buscar Productos</h2>
        </div>
        <form accion="buscar-productos.php" method="POST" class="productos">
            <div class="leable-productos">
                <span>Productos</span>                
            </div>
            <input type="search" name="search" value="<?php echo $buscar;?>">
            <input type="submit" value="Buscar">
        </form>
        <div class="tabla-precios">
            <div class="cabecera">
                <span>Precios</span>
            </div>
            <div class="informacion">
                <div class="leable-informacion">
                    <span>Precio Minorista: <?php if(!empty($precioMin)):?> 
                                                        <?= $precioMin?>
                                                        <?php endif; ?>$</span>                    
                </div>
                <div class="leable-informacion">
                    <span>Precio Mayorista: <?php if(!empty($precioMay)):?> 
                                                        <?= $precioMay?>
                                                        <?php endif; ?>$</span>                    
                </div>
                <div class="leable-informacion">
                    <span>Precio Venta Masivo: <?php if(!empty($precioMas)):?> 
                                                        <?= $precioMas?>
                                                        <?php endif; ?>$</span>                    
                </div>
                <div class="leable-informacion">
                    <span>Precio Min. c/IVA: <?php if(!empty($iva)):?> 
                                                        <?= $iva?>
                                                        <?php endif; ?>$</span>               
                 </div>
                 <div class="leable-informacion">
                    <span>Precio May. c/IVA: <?php if(!empty($codigo)):?> 
                                                        <?= $codigo?>
                                                        <?php endif; ?>$</span>                     
                 </div>
            </div>
        </div>
        <a href="pedidos.php">
            <input type="button" value="Salir">            
        </a>
    </div>
</body>
</html>