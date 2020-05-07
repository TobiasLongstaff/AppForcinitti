<?php
    require ('database.php');

    $buscar = "";
    if(isset($_POST["search"]))
    {
        $buscar = $_POST["search"];          
    }

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        echo "Error al conectar la base de datos";
        exit();
    }
    mysqli_select_db($conecta, $database) or die ('Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

    //AGREGAR DATOS

    $cliente = '';
    $id_cliente = '';
    $id_pedido = '';

    if(isset($_POST['id_cliente']))
    {
        $id_cliente = $_POST['id_cliente'];
    }
    if(isset($_POST['cliente']))
    {
        $cliente = $_POST['cliente'];
    }
    if(isset($_POST['id_pedido']))
    {
        $id_pedido = $_POST['id_pedido'];
    }

    if(!empty($cliente) && !empty($id_cliente) && !empty($id_pedido))
    {
        $sql = "INSERT INTO lista_clientes (id_cliente, id_pedido, cliente) VALUES ('$id_cliente', '$id_pedido', '$cliente')";
        $resultado = mysqli_query($conexion,$sql);
        if (!$resultado)
        {
            $message = 'No se a podido guardar el producto';
        }
        else
        {
            $message = 'Producto Guardado';
        }
    }


    //EXTRAER DATOS 

    $sql="SELECT * FROM id_pedido";
    $resultado = mysqli_query($conecta, $sql);

    while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
    {        
        $idPedido = $filas['id'];
    }  
    mysqli_close($conexion); 
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
                <input class="boton-buscar" type="submit" value="Buscar">                
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
                                <form method="POST" action="cliente.php">
                                    <input type="text" name="cliente" value="<?php echo $filas['cliente'];?>">
                                    <input type="text" name="id_cliente" value="<?php echo $filas['codigo'];?>">
                                    <input type="text" name="id_pedido" value=" <?php echo $idPedido?>">
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
            <a href="pedidos.php">
                <input type="button" value="Salir">                
            </a>
        </div>
    </div>
</body>
</html>