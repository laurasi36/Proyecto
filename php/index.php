<?php
    session_start();
    $_SESSION["primerInicio"] = true;
    require 'database.php';

    //Comprobamos si hay una sesion iniciada
    if(isset($_SESSION['user_id'])){
        $records = $conn->prepare('SELECT id, nombre, email, contrasena, compras FROM usuarios WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (count($results) > 0){
            $user = $results;
            $_SESSION["email"] = $user["email"];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   

</head>
<body>
    <?php if(!empty($user)): ?>

    <nav class="navbar navbar-expand-sm varbar-primary bg-primary fixed-top">
        <a class="navbar-brand" href="index.php"><img src="../img/logo.png" id="img-logo" title="Inicio"/></a>
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

        <a href="ver_carrito.php" class="logo_carro">
            <img src="../img/carro-logo.png" id="imgcarro">
        </a>

        <a href="#menu" class="user_menu">
            <img src="../img/inicioSesion.png" id="user_icon" onclick="abrir()">
        </a>
        <a href="#" class="user_menu user_menu2" id="close_icon">
            <img src="../img/close_icon.png"  onclick="cerrar()">
        </a>
        <ul class="dropdown2" id="menu">
            <li class="dropdown_text">Bienvenido, <?= $user['nombre']?></li>
            <li class="dropdown_link">Nº de Compras realizadas: <?= $user['compras']?> </li>
            <li class="dropdown_link"><a href="logout.php">Cerrar Sesion</a></li>
        </ul>

    </nav>
<br><br><br><br><br>
    
    <main>
    <section id="carouselIndex" class="carousel slide text-center" data-bs-ride="carousel">
            <section class="carousel-indicators">
                <button type="button" data-bs-target="#carouselIndex" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Diapositiva 1"></button>
                <button type="button" data-bs-target="#carouselIndex" data-bs-slide-to="1" aria-label="Diapositiva 2"></button>
                <button type="button" data-bs-target="#carouselIndex" data-bs-slide-to="2" aria-label="Diapositiva 3"></button>
            </section>

            <section class="carousel-inner">
                <section class="carousel-item active">
                    <img src="../img/index1.jpg" class="d-block w-100" alt="slide 1" id="imgTamaño">
                </section>
                <section class="carousel-item">
                    <img src="../img/index2.jpg" class="d-block w-100" alt="slide 2" id="imgTamaño">
                </section>
                <section class="carousel-item">
                    <img src="../img/index3.jpg" class="d-block w-100" alt="slide 3" id="imgTamaño">
                </section>
            </section>
        </section>

        <section class="containerLogo">
            <section class="row">
                <section class="col-4">
                    <a href="https://www.nike.com/es"><img src="../img/logo-nike.png" class="img-fluid" id="tamLogo" title="Nike.es"></a>
                </section>
                <section class="col-4">
                    <a href="https://www.adidas.es/"><img src="../img/logo-adidas.png" class="img-fluid" id="tamLogo" title="Adidas.es"></a>
                </section>
                <section class="col-4">
                    <a href="https://www.vans.es/"><img src="../img/logo-vans.png" class="img-fluid" id="tamLogoVans" title="Vans.es"></a>
                </section>
            </section>
            <section class="row">
                <section class="col-4">
                    <a href="https://www.converse.com/es/"><img src="../img/logo-converse.png" class="img-fluid" id="tamLogo" title="Converse.com"></a>
                </section>
                <section class="col-4">
                    <a href="https://www.reebok.eu/es-es/"><img src="../img/logo-reebook.png" class="img-fluid" id="tamLogo" title="Reebok.es"></a>
                </section>
                <section class="col-4">
                    <a href="https://www.nike.com/es/jordan"><img src="../img/logo-jordan.png" class="img-fluid" id="tamLogo" title="Nike.es/Jordan"></a>
                </section>
            </section>
        </section>

        <section class="container">
            <section class="row flex-nowrap overflow-auto">

            <?php
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $idConcreto = array(1, 7, 9, 17, 25, 33);
                    $idList = implode(',', $idConcreto);
                    
                    //Sacamos todos los datos de la tabla con el id que se indica
                    $sql = "SELECT * FROM datos WHERE id IN ($idList)";
                    $result = $conn->prepare($sql);
                    $result->execute();

                    //Recorremos la tabla para sacar los datos con ese id
                    while(($row = $result->fetch(PDO::FETCH_ASSOC))){
                
                        echo '<section class="col-4">';
                        echo "<a href='informacion.php?id={$row["id"]}' class='btn-hover'>";
                        echo "<img id='imgPlayero' src='data:image/png; base64, ".base64_encode($row["image"])."'></a><br>";
                        echo "</a>";
                        echo '</section>';
                    }

                ?>
            </section>
        </section>
    </main>

    <footer class="bg-dark text-white">
        <p> &copy; 2024 Foot Gala - Todos los derechos reservados</p>
    </footer>

    <?php else: ?>

    
    <nav class="navbar navbar-expand-sm varbar-primary bg-primary fixed-top">
        <a class="navbar-brand" href="index.php"><img src="../img/logo.png" id="img-logo" title="Inicio"/></a>
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

        <a href="#menu" class="user_menu">
            <img src="../img/inicioSesion.png" id="user_icon" onclick="abrir()">
        </a>
        <a href="#" class="user_menu user_menu2" id="close_icon">
            <img src="../img/close_icon.png"  onclick="cerrar()">
        </a>
        <ul class="dropdown3" id="menu">
        <li class="dropdown_link"><a href="login.php">Iniciar Sesion</a></li>
            <li class="dropdown_link"><a href="logout.php">Cerrar Sesion</a></li>
        </ul>

    </nav>
<br><br><br><br><br>
    
    <main>
        <section id="carouselIndex" class="carousel slide text-center" data-bs-ride="carousel">
            <section class="carousel-indicators">
                <button type="button" data-bs-target="#carouselIndex" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Diapositiva 1"></button>
                <button type="button" data-bs-target="#carouselIndex" data-bs-slide-to="1" aria-label="Diapositiva 2"></button>
                <button type="button" data-bs-target="#carouselIndex" data-bs-slide-to="2" aria-label="Diapositiva 3"></button>
            </section>

            <section class="carousel-inner">
                <section class="carousel-item active">
                    <img src="../img/index1.jpg" class="d-block w-100" alt="slide 1" id="imgTamaño">
                </section>
                <section class="carousel-item">
                    <img src="../img/index2.jpg" class="d-block w-100" alt="slide 2" id="imgTamaño">
                </section>
                <section class="carousel-item">
                    <img src="../img/index3.jpg" class="d-block w-100" alt="slide 3" id="imgTamaño">
                </section>
            </section>
        </section>

        <section class="containerLogo">
            <section class="row">
                <section class="col-4">
                    <a href="https://www.nike.com/es"><img src="../img/logo-nike.png" class="img-fluid" id="tamLogo" title="Nike.es"></a>
                </section>
                <section class="col-4">
                    <a href="https://www.adidas.es/"><img src="../img/logo-adidas.png" class="img-fluid" id="tamLogo" title="Adidas.es"></a>
                </section>
                <section class="col-4">
                    <a href="https://www.vans.es/"><img src="../img/logo-vans.png" class="img-fluid" id="tamLogoVans" title="Vans.es"></a>
                </section>
            </section>
            <section class="row">
                <section class="col-4">
                    <a href="https://www.converse.com/es/"><img src="../img/logo-converse.png" class="img-fluid" id="tamLogo" title="Converse.com"></a>
                </section>
                <section class="col-4">
                    <a href="https://www.reebok.eu/es-es/"><img src="../img/logo-reebook.png" class="img-fluid" id="tamLogo" title="Reebok.es"></a>
                </section>
                <section class="col-4">
                    <a href="https://www.nike.com/es/jordan"><img src="../img/logo-jordan.png" class="img-fluid" id="tamLogo" title="Nike.es/Jordan"></a>
                </section>
            </section>
        </section>

        <section class="container">
            <section class="row flex-nowrap overflow-auto">
                
                <?php

                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //Cogemos ciertos id
                    $idConcreto = array(1, 7, 9, 17, 25, 33);
                    $idList = implode(',', $idConcreto);


                    $sql = "SELECT * FROM datos WHERE id IN ($idList)";
                    $result = $conn->prepare($sql);
                    $result->execute();

                    //Recorremos la BD sacando los id que hemos determinado al principio
                    while(($row = $result->fetch(PDO::FETCH_ASSOC))){

                        echo '<section class="col-4">';
                        echo "<a href='informacion.php?id={$row["id"]}' class='btn-hover'>";
                        echo "<img id='imgPlayero' src='data:image/png; base64, ".base64_encode($row["image"])."'></a><br>";
                        echo "</a>";
                        echo '</section>';
                    }
                ?>
            </section>
        </section>
    </main>

    <footer class="bg-dark text-white">
        <p> &copy; 2024 Foot Gala - Todos los derechos reservados</p>
    </footer>

   <?php endif; ?>

   <script src="../js/index.js"></script>
</body>
</html>