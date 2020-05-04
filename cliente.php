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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">   
    <link rel="stylesheet" href="assets/styles/lista.css">
    <title>Clientes</title>
</head>
<body>
    <div class="contenido">
        <div class="titulo">
            <h2>Clientes</h2>
        </div>
        <form method="POST" action="cliente.php">
            <div class=productos>
                <input class="text" type="search" name="search" value="<?php echo $buscar;?>">
                <input class="boton-buscar" type="submit"  value="Buscar">                
            </div>
        </form>
        <table>
            <tr>        
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Controles</th>
            </tr>
            <?php
                if($buscar == '')
                {
                    $sql="SELECT * FROM clientes";
                    $resultado = mysqli_query($conecta, $sql);

                    while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                    {
            ?>
                        <tr>
                            <td> 
                                <?php echo $filas['codigo'];?> 
                            </td>
                            <td> 
                                <?php echo $filas['cliente'];?> 
                            </td>
                            <td>
                                <a href="pedidos.php?id=<?php echo $filas['id'];?>"> 
                                    <input type="button" value="Agregar">
                                </a>
                            </td>
                        </tr>
            <?php
                    }
                    mysqli_close($conecta);  
                }
                else
                {
                    $query = "SELECT * FROM clientes WHERE cliente LIKE '%".$buscar."%' LIMIT 400";
                    $resultado = mysqli_query($conecta, $query);

                    while ($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                    {
            ?>
                         <tr>
                            <td> 
                                <?php echo $filas['codigo'];?> 
                            </td>
                            <td> 
                                <?php echo $filas['cliente'];?> 
                            </td>
                            <td>
                                <a href="pedidos.php?id=<?php echo $filas['id'];?>"> 
                                    <input type="button" value="Agregar">
                                </a>
                            </td>
                        </tr>
                <?php
                    }
                    mysqli_close($conecta);        
                }
                ?>
        </table>
        <div class="botones">
            <input type="submit" value="Agregar">
            <input type="submit" value="Eliminar">
            <a href="menu.php">
                <input type="button" value="Salir">                
            </a>
        </div>
    </div>
</body>
</html>