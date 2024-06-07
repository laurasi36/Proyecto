
<?php

    session_start();

    require 'database.php';

    //Comprobamos que si es el primer inicio de sesion
    if(!$_SESSION["primerInicio"]){
        //Comprobamos si esta vacio el email y la contraseña, si no es asi sacamos los datos de la BD
        if(!empty($_POST['email']) && !empty($_POST['contrasena'])){
            //Preparamos la consulta para seleccionar los datos
            $sql = $conn->prepare('SELECT id, nombre, email, contrasena FROM usuarios WHERE email=:email');
            $sql->bindParam(':email', $_POST['email']);
            $sql->execute();
            $resultado = $sql->fetch(PDO::FETCH_ASSOC);

            $mensage = '';

            //Miramos si se encontro un usuario con esos datos
            if($resultado != null){
                //Comprobamos que la contraseña coincida con la guardada en la BD
                if(password_verify($_POST['contrasena'], $resultado['contrasena'])){
                    $_SESSION['user_id'] = $resultado['id'];
                    header('Location: index.php');
                }else{
                    $mensage = 'La contraseña no coincide';
                }
            }else {
                $mensage = 'El correo no existe';
            }
        }else{
            $mensage = "Rellene los campos";
        }
    }else{
        $_SESSION["primerInicio"] = false; //Marcamos que ya no es el primer inicio de sesion
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

    <h1>Iniciar sesion</h1>
    <p><a href="registro.php">¿No tienes cuenta?</a></p>

    <?php if(!empty($mensage)) : ?>
        <p><?= $mensage ?></p>
    <?php endif; ?>

    <form action="login.php" method="post">
        <input class="correo" type="text" name="email" placeholder="Ingresa aquí tu correo"><br>
        <input class="contraseña" type="password" name="contrasena" placeholder="Ingresa aquí tu contraseña">
        <input class="btnIniciar" type="submit" value="Iniciar">
        <input class="btnBorrar" type="reset" value="Borrar">
    </form>
 </body>
</html>