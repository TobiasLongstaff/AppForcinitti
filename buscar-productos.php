<?php

    require ('database.php');

    $buscar = '';
    if(isset($_POST['search']))
    {
        $buscar = $_POST['search'];        
    }
    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        echo "error flaco";
        exit();
    }
    mysqli_select_db($conecta, $database) or die ('el otro error');
    mysqli_set_charset($conecta, 'utf8');
    $query = "SELECT * FROM productos WHERE descripcion LIKE '%".$buscar."%' LIMIT 6";
    $resultado = mysqli_query($conecta, $query);

    if ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
    {
        echo $fila['descripcion'];
        echo "<br>";
        echo $fila['precioMinorista'];
        echo "<br>";
        echo $fila['precioMayorista'];
        echo "<br>";
        echo $fila['precioMasivo'];
        echo "<br>";
        echo $fila['iva'];
        echo "<br>";
        echo $fila['codigo'];
        echo "<br>";
    }
    mysqli_close($conecta);

?>
<!DOCTYPE html>
<html lang="en">
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
        <form accion="" method="POST" class="productos">
            <div class="leable-productos">
                <span>Productos</span>                
            </div>
            <input type="text" name="descripcion">
            <button>Buscar</button>
        </form>
        <div class="tabla-precios">
            <div class="cabecera">
                <span>Precios</span>
            </div>
            <div class="informacion">
                <div class="leable-informacion">
                    <span>Precio Minorista:</span>                    
                </div>
                <div class="leable-informacion">
                    <span>Precio Mayorista:</span>                    
                </div>
                <div class="leable-informacion">
                    <span>Precio Venta Masivo:</span>                    
                </div>
                <div class="leable-informacion">
                    <span>Precio Min. c/IVA:</span>               
                 </div>
                 <div class="leable-informacion">
                    <span>Precio May. c/IVA:</span>                     
                 </div>
            </div>
        </div>
        <a href="pedidos.php">
            <input type="button" value="Salir">            
        </a>
    </div>
</body>
</html>