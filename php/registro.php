<?php 
    session_start();
    require 'database.php';

    $mensage = "";
    //Miramos que sea el primer inicio 
    if(!$_SESSION["primerInicio"]){
        //Comprobamos que se haya completado todos los campos
        if(!empty($_POST["nombre"]) && !empty($_POST["email"]) && !empty($_POST["contrasena"]) && !empty($_POST["confirm_pass"])){
            if(checkParams()){ //Miramos si los parametros son validos
                if(checkExist()){ //Miramos si el correo ya existe
                    if($_POST["contrasena"] != $_POST["confirm_pass"]){
                        $mensage = "<p>Las contraseñas no coinciden</p>";
                    }else{
                        agregarCuenta(); //Una vez pasada todas las validaciones llama a esta funcion
                    }
                }
            }
        }else{
            $mensage = "<p>No ha introducido todos los datos<p>";
        }
    }else{
        $_SESSION["primerInicio"] = false;
    }

    //Funcion para comprobar si el correo ya esta registrado
    function checkExist(){
        global $conn;
        global $mensage;
        $sql = "SELECT email FROM usuarios WHERE email=\"".$_POST["email"]."\"";
        $resultado = $conn->query($sql);
        if($resultado->rowCount() !=0){
            $mensage = "<p>El correo ya ha sido registrado en esta página</p>";
            return false;
        }
        return true;
    }

    //Fucion para verificar que la contraseña y el email cumple con el patron establecido
    function checkParams(){
        global $mensage;
        $valido = true;
        $cadena = $_POST["contrasena"];
        $patron = "/^(?=\w*[a-z])(?=\w*[0-9])(?=\w*[A-Z])\S{8,12}$/";
        if(!preg_match($patron,$cadena)){
            $mensage = "<p>La contraseña no cumple los requisitos, debe incluir al menos: 
                <br>- 1 Mayuscula
                <br>- 1 Minuscula
                <br>- 1 Numero
                <br>- Entre 8 y 12 digitos</p>";
            $valido = false;
        }
        $cadena = $_POST["email"];
        $patron = "/^[a-z][a-z0-9_]*@[a-z][a-z0-9_]*\.[a-z]{2,3}$/";
        if(!preg_match($patron,$cadena)){
            if($mensage != ""){
                $mensage .= "<br><br><p>El correo no es valido</p>";

            }else{
                $mensage = "<br><br><p>El correo no es valido</p>";
            }
            $valido = false;
        }
        return $valido;
    }

    //Funcion para agregar la cuenta a la BD
    function agregarCuenta(){
        global $conn;
        global $mensage;
        $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (:nombre, :email, :contrasena)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre',$_POST['nombre']);
        $stmt->bindParam(':email',$_POST['email']);
        $password = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
        $stmt->bindParam(':contrasena',$password);

        if($stmt->execute()){
            $mensage = '<p>El usuario ha sido registrado con éxito</p>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

    <?php if(!empty($mensage)): ?>
        <p><?= $mensage ?></p>
    <?php endif; ?>

    <h1>Registrate</h1>
    <p><a href="login.php">Ya tienes una cuenta?</a></p>
    <form action="registro.php" method="post">
        <input class="nombre" type="text" name="nombre" placeholder="Ingresa aquí tu nombre">
        <input class="correo" type="text" name="email" placeholder="Ingresa aquí tu correo">
        <input class="contraseña" type="password" name="contrasena" placeholder="Ingresa aquí tu contraseña">
        <input class="reptcontraseña" type="password" name="confirm_pass" placeholder="Repite la contraseña">
        <input class="btnRegistrar" type="submit" value="Registrarse">
        <input class="btnBorrar" type="reset" value="Borrar">
    </form>
</body>
</html>