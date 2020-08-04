<?php
    require ('database.php');
    require 'config.php';  
    session_start(); 

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        echo "Error al conectar la base de datos";
        exit();
    }
    mysqli_select_db($conecta, $database) or die ('Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

    $buscar = '';    
    $cliente = '';
    $id_cliente = '';
    $id_pedido = '';
    $verificacion_cliente = '0';
    $boton_agregar_cliente = '';
    $vendedor = '';
    $domicilio = '';

    if(isset($_GET['vendedor']))
    {
        // $url=explode("/", $_GET['vendedor']);
        // $vendedor = $url[0];

        $vendedor = $_GET['vendedor'];

        $sql="SELECT * FROM id_pedido WHERE vendedor = '$vendedor'";
        $resultado = mysqli_query($conecta, $sql);
        while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
        {        
            $id_pedido = $filas['id'];
        }
    }
    
    if(isset($_POST['search']))
    {
        $buscar = $_POST["search"];  
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

    <!-- FUENTE -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">   

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo SERVERURL;?>assets/styles/lista.css">
    <link rel="stylesheet" href="<?php echo SERVERURL;?>assets/styles/message.css">

    <!-- ICONOS -->
    <script src="https://kit.fontawesome.com/1b601aa92b.js" crossorigin="anonymous"></script>

    <!-- ANIMACIONES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
   
    <title>Clientes</title>
</head>
<body>
    <div class="contenido-productos">
        <main class="contenido">
            <header class="titulo">
                <h2>Clientes</h2>
            </header>
            <form method="POST" action="<?php echo SERVERURL;?>clientes/<?php echo $vendedor;?>">
                <div class="productos animate__animated animate__fadeIn">
                    <input class="text efecto" type="search" name="search" value="<?php $buscar?>">
                    <button class="fas fa-search boton-buscar efecto-botones" type="submit"></button>                
                </div>
            </form>
            <div class="tabla-lista animate__animated animate__fadeIn animate__delay-1s animacion2">
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
                                $id_cliente = $filas['id'];
                                $cliente = $filas['nombre'];
                                $domicilio = $filas['direccion'];
                    ?>
                                <tr>
                                    <td> 
                                        <?php echo $filas['codigo'];?> 
                                    </td>
                                    <td> 
                                        <?php echo $cliente?> 
                                    </td>
                                    <td>
                                        <a href="<?php echo SERVERURL;?>agregar-cliente.php?vendedor=<?php echo $vendedor;?>&id=<?php echo $id_pedido;?>&id_cliente=<?php echo $id_cliente;?>&direccion=<?php echo $domicilio;?>">
                                            <button class="boton-controles efecto-botones fas fa-user-plus" type="submit" name="boton-agregar" value="Agregar"></button>
                                        </a> 
                                    </td>
                                </tr>
                    <?php
                            }
                            mysqli_close($conecta);  
                        }
                        else
                        {
                            $query = "SELECT * FROM clientes WHERE nombre LIKE '%".$buscar."%' LIMIT 400";
                            $resultado = mysqli_query($conecta, $query);
                            while ($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
                            {
                                $id_cliente = $filas['id'];
                                $cliente = $filas['nombre'];
                                $domicilio = $filas['direccion'];
                    ?>
                                <tr>
                                    <td> 
                                        <?php echo $filas['codigo'];?> 
                                    </td>
                                    <td> 
                                        <?php echo $cliente;?> 
                                    </td>
                                    <td>
                                        <a href="<?php echo SERVERURL;?>agregar-cliente.php?vendedor=<?php echo $vendedor;?>&id=<?php echo $id_pedido;?>&id_cliente=<?php echo $id_cliente;?>&direccion=<? echo $domicilio;?>">                                            
                                            <button class="fas fa-user-plus boton-controles efecto-botones" type="submit" name="boton-agregar" value="Agregar"></button>
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

            <!--ALERTAS-->
            <?php if(!empty($_SESSION['message-correcto'])){?>
                    <div class='mensaje-correcto'>
                        <span><?= $_SESSION['message-correcto']?></span>
                    </div>
            <?php session_unset(); } ?>
            <div class="botones">
                <a href="<?php echo SERVERURL;?>pedidos/<?php echo $vendedor; ?>/<?php echo $verificacion_cliente; ?>">
                    <input class="efecto-botones animate__animated animate__fadeIn animate__delay-1s animacion4" type="button" value="Continuar">                
                </a>
            </div>
        </main>
    </div>
</body>
</html>