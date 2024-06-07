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
    <title>Devolucion</title>
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
        #devolucion{
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
            <h4>POLITICA DE DEVOLUCION</h4>

            <p>En Foot Gala, tu satisfacción es nuestra prioridad. Si no estás completamente satisfecho con tu compra, estamos aquí para ayudarte.</p>
            <h6>Condiciones de Devolucion</h6>
            <ol>
                <li><b>Periodo de Devolución: </b>Tienes 30 días naturales a partir de la fecha de recepción del producto para solicitar una devolución.</li>
                <li><b>Estado del Producto:</b> El producto debe estar sin usar, en su estado original, y con todas las etiquetas intactas. Los artículos que muestren signos de uso no serán aceptados.</li>
                <li><b>Empaque Original:</b> El producto debe devolverse en su empaque original. Esto incluye la caja de los zapatos y cualquier embalaje adicional que se haya utilizado.</li>
            </ol>
            <h6>Proceso de Devolucion</h6>
            <ol>
                <li><b>Solicitud de Devolución:</b> Para iniciar una devolución, por favor, contacta a nuestro equipo de atención al cliente a través del correo electrónico <b><i>footgala@gmail.com</i></b> o llamando al <b><i>985555555</i></b>.</li>
                <li><b>Autorización de Devolución:</b> Una vez que recibamos tu solicitud, te enviaremos una autorización de devolución junto con instrucciones detalladas sobre cómo proceder.</li>
                <li><b>Envío del Producto:</b> Empaqueta el producto de manera segura y envíalo a la dirección que te proporcionaremos. Recomendamos usar un servicio de mensajería con seguimiento para garantizar que el paquete llegue correctamente.</li>
            </ol>
            <h6>Costos de Devolucion</h6>
            <ol>
                <li><b>Cargos de Envío:</b> Los costos de envío para la devolución serán cubiertos por el cliente, a menos que el producto esté defectuoso o se haya enviado incorrectamente. En estos casos, cubriremos los gastos de devolución.</li>
                <li><b>Reembolsos:</b> Una vez que recibamos e inspeccionemos el producto devuelto, te notificaremos sobre el estado de tu reembolso. Si se aprueba, procesaremos el reembolso a tu método original de pago dentro de 5-8 días hábiles. Los costos de envío originales no son reembolsables.</li>
            </ol>
        </section>

    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p> &copy; 2024 Foot Gala - Todos los derechos reservados</p>
    </footer>

    <script src="../js/index.js"></script>

</body>
</html>

