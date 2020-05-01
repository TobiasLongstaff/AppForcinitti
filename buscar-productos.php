<?php

    require 'database.php';
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
    <?php if(!empty($message)):?>
    <p><?=$message?></p>
    <?php endif; ?>
    <div class="contenido">
        <div class="titulo">
            <h2>Buscar Productos</h2>
        </div>
        <div class="productos">
            <div class="leable-productos">
                <span>Productos</span>                
            </div>
            <input type="text">
            <button>Buscar</button>
        </div>
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