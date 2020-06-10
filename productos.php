<?php
    require ('database.php');

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        echo "Error al conectar la base de datos";
        exit();
    }
    mysqli_select_db($conecta, $database) or die ('Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

    $preparado = '';    
    $buscar = $_POST['search']; 
    $destino = 'pedidos.php'; 
    $preparado = '';
    $id = '';

    if(isset($_GET['id_update']))
    {
        $id = $_GET['id_update']; 
    }

    if(isset($_GET['preparado']))
    {
        $preparado = $_GET['preparado'];

        if($preparado == '1')
        {
            $destino = 'agregar-producto-preparado.php';
        }
        else if($preparado == '2')
        {
            $destino = 'actualizar-producto-preparado.php';
        }
        else
        {
            $destino = 'pedidos.php';
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
    <link rel="stylesheet" href="assets/styles/lista.css">

    <!-- ICONOS -->
    <script src="https://kit.fontawesome.com/1b601aa92b.js" crossorigin="anonymous"></script>

    <title>Producto</title>
</head>
<body>
    <div class="contenido-productos">
        <main class="contenido">
            <header class="titulo">
                <h2>Productos</h2>
            </header>
            <span>Productos</span>
            <form method="POST" action="productos.php?preparado=<?php echo $preparado;?>&id_update=<?php echo $id;?>">
                <div class="productos">
                    <input class="text efecto" type="search" name="search" value="<?php echo $buscar;?>">
                    <button class="boton-buscar fas fa-search efecto-botones" type="submit"></button>                
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
                                        <a href="<?php echo $destino;?>?id=<?php echo $filas['id'];?>&id_update=<?php echo $id;?>"> 
                                            <button class="fas fa-cart-plus boton-controles efecto-botones" type="button"></button>
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
                                        <a href="<?php echo $destino;?>?id=<?php echo $filas['id'];?>&id_update=<?php echo $id;?>"> 
                                            <button class="fas fa-cart-plus boton-controles efecto-botones" type="button"></button>
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
                    <input class="efecto-botones" type="submit" value="Agregar">
                    <input class="efecto-botones" type="submit" value="Mas Info.">
                    <a href="<?php echo $destino; ?>">
                        <input class="efecto-botones" type="button" value="Salir">                        
                    </a>
                </div>
            </form>
        </main>        
    </div>
</body>
</html>