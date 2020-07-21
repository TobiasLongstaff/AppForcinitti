<?php
    require ('database.php');
    require 'config.php';  

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
    $destino = 'pedidos'; 
    $preparado = '';
    $id = '';
    $vendedor = '';
    $tipo = '';

    if(isset($_GET['vendedor']))
    {
        $url=explode("/", $_GET['vendedor']);
        $vendedor = $url[0];
        if(!empty($url[3]))
        {
            $tipo = 'gestionar/';
        }

        if(!empty($url[2]))
        {
            $id = $url[2];
        }

        if(!empty($url[1]))
        {
            $preparado = $url[1];
            if($preparado == '1')
            {
                $destino = 'agregar-producto-preparado';
            }
            else if($preparado == '2')
            {
                $destino = 'actualizar-pedido-preparado';
            }
            else
            {
                $destino = 'pedidos';
            }
        }
    }
    mysqli_close($conexion); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- LOGO -->
    <link rel="icon" href="<?php echo SERVERURL;?>assets/img/logo.ico">

    <!-- FUENTES -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet"> 
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo SERVERURL;?>assets/styles/lista.css">

    <!-- ICONOS -->
    <script src="https://kit.fontawesome.com/1b601aa92b.js" crossorigin="anonymous"></script>

    <!-- ANIMACIONES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
   
    <title>Producto</title>
</head>
<body>
    <div class="contenido-productos">
        <main class="contenido">
            <header class="titulo">
                <h2>Productos</h2>
            </header>
            
            <form method="POST" action="<?php echo SERVERURL;?>productos/<?php echo $vendedor;?>/<?php echo $preparado;?>/<?php echo $id;?>/<?php echo $tipo;?>">
                <span class="animate__animated animate__fadeIn">Productos</span>                
                <div class="productos animate__animated animate__fadeIn">
                    <input class="text efecto" type="search" name="search" value="<?php echo $buscar;?>">
                    <button class="boton-buscar fas fa-search efecto-botones" type="submit"></button>                
                </div>
                <div class="tabla-lista animate__animated animate__fadeIn animate__delay-1s animacion2">
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
                                        <td class="td-descripcion"> 
                                            <?php echo $filas['descripcion'];?> 
                                        </td>
                                        <td>
                                            <!--id pedido y id update-->
                                            <a href="<?php echo SERVERURL; echo $destino;?>/<?php echo $vendedor;?>/producto/<?php echo $filas['id'];?>/<?php echo $id;?>/<?php echo $tipo;?>"> 
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
                                        <td class="td-descripcion"> 
                                            <?php echo $filas['descripcion'];?> 
                                        </td>
                                        <td>
                                            <!--id pedido y id update-->
                                            <a href="<?php echo SERVERURL; echo $destino;?>/<?php echo $vendedor;?>/producto/<?php echo $filas['id'];?>/<?php echo $id;?>/<?php echo $tipo;?>"> 
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
                </div>

                <div class="botones">
                    <input class="efecto-botones animate__animated animate__fadeIn animate__delay-1s animacion3" type="submit" value="Agregar" disabled>
                    <input class="efecto-botones animate__animated animate__fadeIn animate__delay-1s animacion4" type="submit" value="Mas Info." disabled>
                    <a href="<?php echo SERVERURL; echo $destino; ?>/<?php echo $vendedor;?>/<?php echo $id?>/<?php echo $tipo;?>">
                        <input class="efecto-botones animate__animated animate__fadeIn animate__delay-1s animacion5" type="button" value="Salir">                        
                    </a>
                </div>
            </form>
        </main>        
    </div>
</body>
</html>