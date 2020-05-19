<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/styles/lista.css">

    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">

    <!-- ICONOS -->
    <script src="https://kit.fontawesome.com/1b601aa92b.js" crossorigin="anonymous"></script>

    <title>Gestionar pedidos</title>
</head>
<body>
    <main class="contenido">
        <header class="titulo">
            <h2>Gestion de pedidos</h2>
        </header>
        <span>Pedidos</span>
        <div class="pedido ">
            <input class="text" type="search">               
            <button type="submit" class="fas fa-search boton-buscar"></button>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Controles</th>
            </tr>
            <tr>
                <td>1</td>
                <td>consum</td>
                <td>
                    <button type="submit" class="far fa-eye"></button>
                    <button type="submit" class="fas fa-print"></button>
                </td>
            </tr>
        </table>
        <div class="botones">
            <a href="">
                <input type="button" value="Salir">
            </a>
        </div>
    </main>
</body>
</html>