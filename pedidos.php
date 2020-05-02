<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/styles/pedidos.css">

    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">    
    <title>Pedidos</title>
</head>
<body>
    <div class="contenido" method="POST" action="">
        <div class="titulo">
            <h2>Pedidos</h2>
        </div>
        <a class="boton clientes" href="clientes.php">
            <input type="button" value="Clientes">
        </a>
        <!-- PRODUCTOS -->
        <form class="productos" method="POST" action="buscar-productos.php">
            <div class="label-productos">
                <span>Productos</span>                
            </div>
            <input class="textbox-productos" type="search" name="search">
            <button type="submit">Buscar</button>            
        </form>
        <!-- INFORMACION -->
        <div class="informacion">
            <div class="leables">
                <span>Cantidad</span>
                <span>Precio Unitario</span>
                <span>Descuento</span>
                <span>IVA</span>                
            </div>
            <div class="contenedor-textbox">
                <input class="textbox-cantidad" type="text" name="">
                <input class="textbox-precio" type="text" name="">
                <input class="textbox-descuento" type="text" name="">
                <input class="textbox-iva" type="text" name="">                 
            </div>   
        </div>
        <!-- CONDICION IVA -->
        <div class="condicion-iva">
            <div class="leable-iva">
                <span>Condicion IVA</span>                
            </div>
            <input type="text" name="">            
        </div>
        <!-- ENTREGA -->
        <div class="entrega">
            <div class="leables-entrega">
                <span>Domicilio</span>        
                <span class="leable-2">Fecha de Entrega</span>                
            </div>
            <div class="textbox-entrega">
                <input type="text" name="">
                <input type="text" name="">                      
            </div>
        </div>
        <!-- BOTONES -->
        <div class="botones">
            <a class="boton" href="lista.php">
                <button class="">Agregar Producto</button>
            </a>
            <a class="boton-2" href="lista.php">
                <input type="button" value="Ver Lista">
            </a>            
        </div>
    </div>
</body>
</html>