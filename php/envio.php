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
    <title>Envio</title>
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
        #envio{
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
            <h4>POLITICA DE ENVIO</h4>

            <h6>Opciones y Costos de Envío</h6>
            <p>En Foot Gala, ofrecemos varias opciones de envío para asegurarnos de que tus compras lleguen de manera rápida y segura:</p>
            <ol>
                <li>Envío Estándar</li>
                    <ul>
                        <li>Costo: 4€ o gratuito para pedidos superiores a 250€.</li>
                        <li>Tiempo de Entrega: 5-7 días hábiles.</li>
                    </ul>
                <li>Envío Expreso</li>
                    <ul>
                        <li>Costo: 8€</li>
                        <li>Tiempo de Entrega: 2-3 días hábiles.</li>
                    </ul>
                <li>Envío al Día Siguiente</li>
                    <ul>
                        <li>Costo: 20€</li>
                        <li>Tiempo de Entrega: 1 día hábil (Pedidos realizados antes de las 00:00).</li>
                    </ul>
            </ol>
            
            <h6>Tiempos de Procesamiento</h6>
            <ul>
                <li>Todos los pedidos se procesan dentro de 1-2 días hábiles después de la confirmación del pago. Los pedidos no se envían ni se entregan los fines de semana o días festivos.</li>
            </ul>
            <h6>Rastreo de Pedidos</h6>
                <ul>
                    <li>Una vez que tu pedido haya sido enviado, recibirás un correo electrónico de confirmación con un número de seguimiento. Puedes usar este número para rastrear tu pedido en tiempo real a través del sitio web del transportista.</li>
                </ul>

            <h6>Problemas de Envío</h6>
                <ul>
                    <li>Retrasos en la Entrega: En casos raros, los envíos pueden retrasarse debido a circunstancias imprevistas (clima, problemas del transportista, etc.). Nos disculpamos por cualquier inconveniente y te agradecemos tu paciencia.</li>
                    <li>Dirección Incorrecta: Asegúrate de proporcionar una dirección de envío precisa y completa. No somos responsables de los pedidos enviados a direcciones incorrectas proporcionadas por el cliente.</li>
                </ul>

            <h6>Envíos Internacionales</h6>
                <ul>
                    <li>Disponibilidad: Ofrecemos envíos internacionales a una selección de países. Los costos y tiempos de entrega varían según el destino.</li>
                    <li>Aranceles y Impuestos: Los clientes internacionales son responsables de los aranceles, impuestos y tarifas aplicables a su país.</li>
                </ul>
            <h6>Devoluciones y Reembolsos</h6>
                <ul>
                    <li>Si no estás completamente satisfecho con tu compra, puedes devolverla dentro de los 30 días posteriores a la recepción para un reembolso completo. Los costos de envío no son reembolsables.</li>
                    <li>Si recibes un artículo defectuoso o dañado, por favor contáctanos inmediatamente para resolver el problema.</li>
                </ul>
            <h6>Contacto</h6>
                <p>Si tienes alguna pregunta sobre nuestra Política de Envio, puedes contactarnos en:</p>
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