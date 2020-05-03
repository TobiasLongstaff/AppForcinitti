<?php

    $tabla = 'partials/clientes-principales.php'

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/clientes.css">
    <title>Informacion del cliente</title>
</head>
<body>
    <div class="contenido">
        <div class="titulo">
            <h2>Informacion del cliente</h2>
        </div>            
        <span>Clientes</span>
        <form class="clientes" action="">
            <input class="text" type="search">
            <input class="boton-clientes" type="submit" value="Buscar">
        </form>
        <div class="tabla">
            <input type="submit" value="Principales" action="<?php //$tabla='partials/clientes-principales.html'?>">
            <input type="submit" value="Adicionales" action="<?php //$tabla='partials/clientes-adicionales.html'?>">
            <input type="submit" value="Estadisticas" action="<?php //$tabla='partials/clientes-estadisticas.html'?>">
        </div>
        <?php include $tabla?>
        <div class="botones">
            <button type="submit">Cant. <br> Compras</button>
            <input type="submit" value="Telefonos">
            <input type="submit" value="Salir">
        </div>
    </div>
</body>
</html>