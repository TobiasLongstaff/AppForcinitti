<?php
    require ('database.php');

    $buscar = $_POST["search"]; 
    $destino = "productos.php";      

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

    <title>Producto</title>
</head>
<body>
    <div class="contenido">
        <div class="titulo">
            <h2>Productos</h2>
        </div>
        <span>Productos</span>
        <form method="POST" action="<?php echo $destino;?>">
            <div class="productos">
                <input class="text" type="search" name="search" value="<?php echo $buscar;?>">
                <input class="boton-buscar" type="submit"  value="Buscar">                
            </div>
            <table>
                <tr>        
                    <th>Código</th>
                    <th>Descripcion</th>
                    <th>Controles</th>
                </tr>
                <?php
                    if($buscar == '')
                    {
                        $sql="SELECT * FROM productos";
                        $resultado = mysqli_query($conecta, $sql);

                        while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                        {
                ?>
                            <tr>
                                <td> 
                                    <?php echo $filas['codigo'];?> 
                                </td>
                                <td> 
                                    <?php echo $filas['descripcion'];?> 
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
                        $query = "SELECT * FROM productos WHERE descripcion LIKE '%".$buscar."%' LIMIT 400";
                        $resultado = mysqli_query($conecta, $query);

                        while ($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                        {
                ?>
                            <tr>
                                <td> 
                                    <?php echo $filas['codigo'];?> 
                                </td>
                                <td> 
                                    <?php echo $filas['descripcion'];?> 
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
                <input type="submit" value="Mas Info.">
                <a href="pedidos.php">
                    <input type="button" value="Salir">                        
                </a>
            </div>
        </form>
    </div>
</body>
</html>