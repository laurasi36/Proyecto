<?php
    session_start();

    require 'database.php';

    $user = null;
    //Comprobamos si el usuario a iniciado la sesion
    if(isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT id, nombre, email, compras FROM usuarios WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
    
        if ($results) {
            $user = $results;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quienes Somos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/ubicacion.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        #donde{
            text-decoration: underline;
            text-decoration-thickness: 4px; /*Le pone un groso a la linea*/
        }
    </style>

</head>
<body>

    <nav class="navbar navbar-expand-sm varbar-primary bg-primary fixed-top">
        <a class="navbar-brand" href="index.php"><img src="../img/logo.png" id="img-logo" alt="Inicio"/></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navegacion">
            <span class="navbar-toggler-icon"></span>
        </button>
        <section class="collapse navbar-collapse justify-content-center" id="navegacion">
            <nav class="navbar-nav">
                <a class="nav-link text-white" href="adulto.php" id="adulto">Adulto</a>
                <a class="nav-link text-white" href="ninio.php" id="ninio">Niño</a>
                <a class="nav-link text-white" href="quienSomos.php" id="somos">Quienes somos</a>
                <a class="nav-link text-white" href="ubicacion.php" id="donde">Donde estamos</a>
                <section class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="devolucion.php" id="privacidad" data-bs-toggle="dropdown" aria-expanded="false">Política de Privacidad</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="devolucion.php">Politica de Devolucion</a></li>
                        <li><a class="dropdown-item" href="envio.php">Politica de Envio</a></li>
                        <li><a class="dropdown-item" href="privacidad.php">Politica de Privacidad</a></li>
                        <li><a class="dropdown-item" href="cookies.php">Politica de Cookies</a></li>
                    </ul>
                </section>
            </nav>
        </section>

        <?php if (!empty($user)): ?>
            <a href="ver_carrito.php" class="logo_carro">
                <img src="../img/carro-logo.png" id="imgcarro">
            </a>
        <?php endif; ?>

        <a href="#menu" class="user_menu">
            <img src="../img/inicioSesion.png" id="user_icon" onclick="abrir()">
        </a>
        <a href="#" class="user_menu user_menu2" id="close_icon">
            <img src="../img/close_icon.png"  onclick="cerrar()">
        </a>
        <ul class="dropdown2" id="menu">
            <?php if (!empty($user)): ?>
                <li class="dropdown_text">Bienvenido, <?= htmlspecialchars($user['nombre']) ?></li>
                <li class="dropdown_link">Nº de Compras realizadas: <?= $user['compras']?> </li>
                <li class="dropdown_link"><a href="logout.php">Cerrar Sesion</a></li>
            <?php else: ?>
                <li class="dropdown_link"><a href="login.php">Iniciar Sesion</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <br><br><br><br><br><br><br>
    <main>
        <section class="container clearfix">
            <section class="container1">
                <!--Mapa de Google Maps-->
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2439.2047238413197!2d-5.850097381182353!3d43.36198029433384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2ses!4v1716919571708!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </section>

            <section class="container2">
                <h1>Contacto</h1>
                <img src="../img/email.png" id="imgContacto"><span>footgala@gmail.com</span><br>
                <img src="../img/telefono.png" id="imgContacto"><span>985 555 555</span><br>
                <img src="../img/ubicacion.png" id="imgContacto"><span>C/ Uria 5D, Oviedo, Asturias</span>
            </section>

        </section>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p> &copy; 2024 Foot Gala - Todos los derechos reservados</p>
    </footer>

    <script src="../js/index.js"></script>

</body>
</html>