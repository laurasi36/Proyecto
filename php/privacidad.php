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
    <title>Privacidad</title>
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
        #privacidad2{
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
            <h4>POLITICA DE PRIVACIDAD</h4>

            <h6>Introducción</h6>

            <p>En Foot Gala nos comprometemos a proteger y respetar tu privacidad. 
                Esta política de privacidad explica cómo recopilamos, utilizamos y protegemos tus datos personales cuando visitas nuestro sitio web 
                <b><i>www.footgala.com</b></i>.</p>
            
            <h6>Información que Recopilamos</h6>
            <p>Podemos recopilar y procesar los siguientes datos sobre ti:</p>
            <ol>
                <li><b>Información de Contacto:</b> Nombre, dirección de correo electrónico, dirección postal, número de teléfono.</li>
                <li><b>Información de Compra:</b> Detalles de productos comprados, fecha y hora de las compras.</li>
                <li><b>Información de Pago:</b> Datos de la tarjeta de crédito/débito u otros métodos de pago.</li>
                <li><b>Información Técnica:</b> Dirección IP, tipo y versión de navegador, configuración de zona horaria, tipos y versiones de complementos del navegador, sistema operativo y plataforma.</li>
                <li><b>Información de Uso:</b> Información sobre cómo utilizas nuestro Sitio, productos vistos y buscados, tiempos de respuesta de las páginas, errores de descarga, duración de las visitas a ciertas páginas y métodos utilizados para navegar fuera de la página.</li>
            </ol>
            
            <h6>Cómo Utilizamos Tu Información</h6>

            <p>Utilizamos tu información para:</p>
            <ol>
                <li><b>Procesar Pedidos:</b> Gestionar y entregar tus pedidos, procesar pagos y comunicarnos contigo sobre tu compra.</li>
                <li><b>Atención al Cliente:</b> Responder a tus consultas, solicitudes y proporcionar soporte.</li>
                <li><b>Mejorar Nuestro Sitio:</b> Analizar cómo se utiliza nuestro Sitio para mejorar nuestros productos y servicios.</li>
                <li><b>Marketing:</b> Enviarte información sobre productos, ofertas especiales y noticias que puedan interesarte, siempre que hayas dado tu consentimiento para recibir dichas comunicaciones.</li>
            </ol>

            <h6>Compartir Tu Información</h6>

            <p>No vendemos, comercializamos ni alquilamos tus datos personales a terceros. Podemos compartir tu información con terceros de confianza que nos ayudan a operar nuestro Sitio, llevar a cabo nuestro negocio o brindarte servicios, siempre que estas partes acuerden mantener esta información confidencial. Por ejemplo:</p>
            <ol>
                <li><b>Proveedores de Servicios:</b> Empresas que proporcionan servicios de TI y administración de sistemas.</li>
                <li><b>Procesadores de Pago:</b> Para procesar pagos realizados en nuestro Sitio.</li>
                <li><b>Proveedores de Envío:</b> Para entregar tus pedidos.</li>
            </ol>

            <h6>Protección de Tu Información</h6>
            <p>Implementamos una variedad de medidas de seguridad para mantener la seguridad de tus datos personales. Utilizamos cifrado, firewalls y medidas de control de acceso para proteger tu información.</p>
            
            <h6>Tus Derechos</h6>
            <p>Tienes derecho a:</p>
            <ol>
                <li><b>Acceder:</b> Solicitar una copia de los datos personales que tenemos sobre ti.</li>
                <li><b>Rectificar:</b> Corregir cualquier dato incorrecto o incompleto.</li>
                <li><b>Borrar:</b> Solicitar que eliminemos tus datos personales en ciertas circunstancias.</li>
                <li><b>Restringir:</b> Solicitar que limitemos el procesamiento de tus datos en ciertas circunstancias.</li>
                <li><b>Portabilidad:</b> Solicitar la transferencia de tus datos a otra organización en un formato estructurado, de uso común y lectura mecánica.</li>
            </ol>
            <p>Para ejercer cualquiera de estos derechos, por favor contáctanos a través de la información proporcionada al final de esta política.</p>

            <h6>Retención de Datos</h6>
            <p>Solo retendremos tus datos personales durante el tiempo necesario para cumplir con los fines para los cuales los recopilamos, incluyendo los fines de satisfacer cualquier requisito legal, contable o de informes.</p>
            
            <h6>Cambios en Nuestra Política de Privacidad</h6>
            <p>Podemos actualizar esta política de privacidad de vez en cuando. Cualquier cambio que realicemos será publicado en esta página. Te recomendamos revisar esta política periódicamente para estar informado sobre cómo protegemos tu información.</p>
            
            <h6>Contacto</h6>
                <p>Si tienes alguna pregunta sobre esta política de privacidad o deseas ejercer tus derechos, por favor contáctanos en:</p>
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