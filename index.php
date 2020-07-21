<?php

    session_start();

    require 'database.php';
    require 'config.php';

    $usuario = '';
    if(!empty($_POST['nombre']) && !empty($_POST['password']))
    {
        $usuario = $_POST['nombre'];
        $records = $conn->prepare('SELECT id, nombre, password FROM usuarios WHERE nombre=:nombre');
        $records->bindParam(':nombre', $_POST['nombre']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        if (!empty($results) > 0 && password_verify($_POST['password'], $results['password']))
        {
            // $_SESSION['user_id'] = $results['id'];
            // $id = $_SESSION['user_id'];
            if(!empty($usuario))
            {
                header("Location: menu/$usuario");
            }
        }
        else
        {        
            $_SESSION['message'] = 'Los datos ingresados no coinciden';
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

    <!--FUENTES-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo SERVERURL;?>assets/styles/login.css">
    <link rel="stylesheet" href="<?php echo SERVERURL;?>assets/styles/message.css">

    <!-- ANIMACIONES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">

    <title>AppPrueba</title>
</head>
<body>
    <main class="contenido">
        <div class="login">
            <form action="index.php" method="POST" class="formulario">            
                <header class="titulo">
                    <h2 class="animate__animated animate__backInRight">Registrarse</h2>        
                </header>
                <div class="leable_usuario">
                    <span>Usuario</span>                
                </div>
                <div class="textbox_usuario">
                    <input type="text" name="nombre" class="efecto">                
                </div>
                <div class="leable_contraseña">
                    <span>Contraseña</span>                
                </div>
                <div class="textbox_contraseña">
                    <input type="password" name="password" class="efecto">                
                </div>         
                <?php if(isset($_SESSION['message'])){?>
                    <div class='mensaje-error'>
                    <span><?= $_SESSION['message']?></span>
                    </div>
                <?php session_unset(); } ?>       
                <div class="boton">
                    <input class="efecto-botones" type="submit" value="Iniciar sesión">                   
                </div>   
            </form>            
        </div>
    </main>    
</body>
</html>