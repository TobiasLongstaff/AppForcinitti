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

    $buscar = '';    
    $cliente = '';
    $id_cliente = '';
    $id_pedido = '';
    $verificacion_cliente = '0';
    
    if(isset($_POST['search']))
    {
        $buscar = $_POST["search"];  
    }

    if(isset($_POST['id_cliente']) && isset($_POST['cliente']) && isset($_POST['id_pedido']))
    {        
        $id_cliente = $_POST['id_cliente'];
        $cliente = $_POST['cliente'];
        $id_pedido = $_POST['id_pedido'];          
    }

    //EXTRAER DATOS 

    $sql="SELECT * FROM id_pedido";
    $resultado = mysqli_query($conecta, $sql);
    
    while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
    {        
        $id_pedido = $filas['id'];
    }  

    //AGREGAR DATOS

    if(!empty($cliente) && !empty($id_cliente) && !empty($id_pedido))
    {
        $sql2 = "INSERT INTO lista_clientes (id_cliente, id_pedido, cliente) VALUES ('$id_cliente', '$id_pedido', '$cliente')";
        $resultado = mysqli_query($conexion,$sql2);
        if(!$resultado)
        {
            $verificacion_cliente = '0';
        }
        else
        {
            $verificacion_cliente = '1';
        }
    }
    mysqli_close($conexion); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FUENTE -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">   

    <!-- CSS -->
    <link rel="stylesheet" href="assets/styles/lista.css">

    <!-- ICONOS -->
    <script src="https://kit.fontawesome.com/1b601aa92b.js" crossorigin="anonymous"></script>

    <title>Clientes</title>
</head>
<body>
    <main class="contenido">
        <header class="titulo">
            <h2>Clientes</h2>
        </header>
        <form method="POST" action="cliente.php">
            <div class=productos>
                <input class="text" type="search" name="search" value="<?php $buscar?>">
                <button class="fas fa-search boton-buscar" type="submit"></button>                
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
                        $id_cliente = $filas['id'];
                        $cliente = $filas['cliente'];
            ?>
                        <tr>
                            <td> 
                                <?php echo $filas['codigo'];?> 
                            </td>
                            <td> 
                                <?php echo $cliente?> 
                            </td>
                            <td>
                                <form method="POST" action="cliente.php">
                                    <div class="ocultar">
                                        <input type="text" name="cliente" value="<?php echo $cliente?>">
                                        <input type="text" name="id_cliente" value="<?php echo $id_cliente?>">
                                        <input type="text" name="id_pedido" value="<?php echo $id_pedido?>">                                        
                                    </div>
                                    <input type="submit" value="Agregar" name="agregar-producto">                                
                                </form>
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
                        $id_cliente = $filas['id'];
                        $cliente = $filas['cliente'];
            ?>
                         <tr>
                            <td> 
                                <?php echo $filas['codigo'];?> 
                            </td>
                            <td> 
                                <?php echo $cliente;?> 
                            </td>
                            <td>
                                <form method="POST" action="cliente.php">
                                    <div class="ocultar">
                                        <input type="text" name="cliente" value="<?php echo $cliente?>">
                                        <input type="text" name="id_cliente" value="<?php echo $id_cliente?>">
                                        <input type="text" name="id_pedido" value="<?php echo $id_pedido?>">                                        
                                    </div>
                                    <input type="submit" value="Agregar" name="agregar-producto">
                                </form>
                            </td>
                        </tr>
                <?php
                    }
                    mysqli_close($conecta);        
                }
                ?>
        </table>
        <div class="botones">
            <a href="pedidos.php?id_cliente=<?php echo $verificacion_cliente;?>">
                <input type="button" value="Salir">                
            </a>
        </div>
    </main>
</body>
</html>