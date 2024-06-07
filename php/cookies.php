<?php
    session_start();

    require 'database.php';

    $user = null;
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
    <title>Cookies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/devolucion.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        #privacidad{
            text-decoration: underline;
            text-decoration-thickness: 4px; /*Le pone un groso a la linea*/
        }
        #cookies{
            background-color: rgb(194, 194, 194);
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
                        <li><a class="dropdown-item" href="devolucion.php" id="devolucion">Politica de Devolucion</a></li>
                        <li><a class="dropdown-item" href="envio.php" id="envio">Politica de Envio</a></li>
                        <li><a class="dropdown-item" href="privacidad.php" id="privacidad2">Politica de Privacidad</a></li>
                        <li><a class="dropdown-item" href="cookies.php" id="cookies">Politica de Cookies</a></li>
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
        <section class="container">
            <h4>POLITICA DE COOKIES</h4>

            <h6>¿Qué son las cookies?</h6>

                <p>Las cookies son pequeños archivos de texto que se almacenan en tu dispositivo (ordenador, tablet, smartphone, etc.) cuando visitas un sitio web. 
                    Estas cookies permiten que el sitio web funcione correctamente, mejore la experiencia del usuario y recopile 
                    información sobre la actividad del sitio.</p>

            <h6>¿Cómo utilizamos las cookies?</h6>

                <p>En Foot Gala, utilizamos cookies para los siguientes propósitos:</p>

                <ol>
                    <li><b>Cookies Esenciales:</b> Estas cookies son necesarias para que nuestro sitio web funcione y no pueden desactivarse en nuestros sistemas. Incluyen, por ejemplo, cookies que te permiten acceder a áreas seguras de nuestro sitio web.</li>

                    <li><b>Cookies de Rendimiento:</b> Estas cookies nos permiten contar visitas y fuentes de tráfico para que podamos medir y mejorar el rendimiento de nuestro sitio. Nos ayudan a saber qué páginas son las más y las menos populares y a ver cómo los visitantes se mueven por el sitio.</li>

                    <li><b>Cookies Funcionales:</b> Estas cookies permiten que el sitio web brinde una funcionalidad y personalización mejoradas. Pueden ser establecidas por nosotros o por proveedores externos cuyos servicios hemos agregado a nuestras páginas.</li>

                    <li><b>Cookies de Publicidad:</b> Estas cookies pueden ser establecidas a través de nuestro sitio por nuestros socios publicitarios. Pueden ser utilizadas por esas compañías para crear un perfil de tus intereses y mostrarte anuncios relevantes en otros sitios.</li>
                </ol>

            <h6>Cookies de terceros</h6>

                <p>En algunos casos, utilizamos cookies de terceros, que son cookies establecidas por un dominio diferente al nuestro. Esto puede ocurrir, por ejemplo, cuando usamos servicios de análisis como Google Analytics o cuando mostramos contenido de redes sociales.</p>

            <h6>Gestión de cookies</h6>

                <p>Puedes gestionar tus preferencias de cookies y obtener más información sobre cómo desactivarlas en tu navegador</p>
                <p>Ten en cuenta que, si decides desactivar las cookies, algunas funcionalidades de nuestro sitio web pueden no funcionar correctamente.</p>
            
            <h6>Actualizaciones de la Política de Cookies</h6>

                <p>Podemos actualizar esta Política de Cookies en cualquier momento para reflejar cambios en nuestras prácticas de cookies. Te recomendamos revisar esta política periódicamente para estar informado sobre cómo usamos las cookies.</p>
            
            <h6>Contacto</h6>
                <p>Si tienes alguna pregunta sobre nuestra Política de Cookies, puedes contactarnos en:</p>
                <ul>
                    <li>Correo Electrónico: <b><i>footgala@gmail.com</i></b></li>
                    <li>Número de Teléfono: <b><i>985 555 555</i></b></li>
                </ul>
        </section>

    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p> &copy; 2024 Foot Gala - Todos los derechos reservados</p>
    </footer>

    <script src="../js/index.js"></script>

</body>
</html>