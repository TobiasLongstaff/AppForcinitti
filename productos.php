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
        <table>
            <tr>        
                <th></th>
                <th>Código</th>
                <th>Descripcion</th>
            </tr>
            <?php include "database.php";
            $conecta = mysqli_connect($server, $nombre, $password, $database);
            if (mysqli_connect_errno())
            {
                echo "Error al conectar la base de datos";
                exit();
            }
            mysqli_select_db($conecta, $database) or die ('Error al conectar');
            mysqli_set_charset($conecta, 'utf8');
            $sql="SELECT * FROM productos";
            $resultado = mysqli_query($conecta, $sql);
            while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
            {
                echo "<tr onclick='seleccionar(this,1)' >";
                echo "<td><input type='checkbox' name='check[]' value='1' id='chk1'>";
                echo "<td>"; echo $filas['codigo']; echo "</td>";
                echo "<td>"; echo $filas['descripcion']; echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <div class="botones">
            <a href="agregar-productos.php">
                <input type="submit" value="Agregar">                
            </a>
            <input type="submit" value="Eliminar">
            <a href="menu.php">
                <input type="button" value="Salir">                
            </a>
        </div>
    </div>
    <script>
        function seleccionar(tr,value)
        {
            $(function()
            {
                if($("chk"+value).attr("checked") == "checked")
                {
                    $("#chk"+value).removeAttr("checked");
                    $(tr).css("background-color","#ffffff");
                }
                else
                {
                    $("#chk"+value).attr("checked","true");
                    $("#chk"+value).prop("checked","true");
                    $(tr).css("background-color","#BEDAE8");
                }
            })
        }
    </script>
</body>
</html>