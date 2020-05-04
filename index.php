<?php

    session_start();

    require 'database.php';

    if(!empty($_POST['nombre']) && !empty($_POST['password']))
    {
        $records = $conn->prepare('SELECT id, nombre, password FROM usuarios WHERE nombre=:nombre');
        $records->bindParam(':nombre', $_POST['nombre']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if (!empty($results) > 0 && password_verify($_POST['password'], $results['password']))
        {
            $_SESSION['user_id'] = $results['id'];
            header('Location: /AppForcinitti/menu.php');
        }
        else
        {        
            $message = 'Los datos ingresados no coinciden';
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--FUENTES-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/styles/login.css">
    <title>AppPrueba</title>
</head>
<body>
    <div class="contenido">
        <div class="titulo">
            <h2>Registrarse</h2>        
        </div>
        <form action="index.php" method="POST" class="formulario">
            <div class="leable_usuario">
                <h2>Usuario</h2>                
            </div>
            <div class="textbox_usuario">
                <input type="text" name="nombre">                
            </div>
            <div class="leable_contraseña">
                <h2>Contraseña</h2>                
            </div>
            <div class="textbox_contraseña">
                <input type="password" name="password">                
            </div>         
            <?php if(!empty($message)):?>
                <p> <?= $message ?></p>
            <?php endif; ?>       
            <div class="boton">
                <input type="submit" value="Iniciar sesión">                   
            </div>   
        </form>
    </div>    
</body>
</html>