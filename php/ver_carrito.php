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

    $descuento = 0.35;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/ver_carro.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

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
        <section>
            <?php
                $total = 0;
                //Comprobamos que se cogio bien el usuario
                if(isset($_SESSION['user_id'])){
                    echo "<section class='table-container'>";
                    //Comprobamos que le hayamos pasado el carrito y que no este vacio
                    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                        echo "<table>";
                        //Recorremos el carrito para sacar los datos
                        foreach ($_SESSION['carrito'] as $index => $producto) {
                            $precio_original = $producto["precio"];
                            $precio_descuento = $precio_original * (1 - $descuento);
                            $cantidad = isset($producto['cantidad']) ? $producto['cantidad'] : 1;
                            echo "<tr>";
                            echo "<td><img src='data:image/png;base64," . htmlspecialchars($producto['image']) . "' alt='Imagen del Producto' style='max-width: 150px;'></td>";
                            echo "<td><p>" . htmlspecialchars($producto['nombre']) . "</p></td>";
                            echo "<td><p>" . htmlspecialchars($producto['talla']) . "EUR </p></td>";
                            echo "<td><p id='txtdescuento'>" . number_format($precio_descuento, 2) . "€ </p></td>";
                            echo "<td><p id='txtoriginal'>" . htmlspecialchars($precio_original) . "€</p></td>";

                            echo "<td><form method='post' action='actualizar_producto.php'>";
                            echo "<section class='contenedorCantidad'>";
                            echo "<input type='hidden' name='index' value='" . $index . "'>";
                            echo "<button type='submit' name='decrementa' class='btn btn-red btnSimbolo txtMenos'>-</button>";
                            echo "<input class='inputNumber' type='number' name='cantidad' value='" . htmlspecialchars($cantidad) . "' min='1'>";
                            echo "<button type='submit' name='incrementa' class='btn btn-green btnSimbolo txtMas'>+</button>";
                            echo "</section></form></td>";

                            echo "<td><form method='post' action='eliminar_producto.php'>";
                            echo "<input type='hidden' name='index' value='" . $index . "'>";
                            echo "<button type='submit' class='btn btn-danger'>Borrar</button>";
                            echo "</form></td>";
                            echo "</tr>";

                            $total += $precio_descuento * $cantidad;

                        }
                    

                        echo "<tr><td colspan='7' class='campoTotal'><span class='txtTotal'>Total: ".$total. " € </span></td></tr>";
                        echo "<tr><td colspan='7' class='txtAplicar'><p>Descuento Aplicado: 35%</p></td></tr>";
                        echo "<tr><td colspan='7'><button id='comprar' class='btnComprar'>Comprar</button></td></tr>"; //Mostrar el boton solo si hay producto
                        echo "</table><br>";

                    } else {
                        echo "<p>El carrito está vacío.</p>";
                    }
                }else {
                    echo "<p>Inicia sesion para realizar su compra y ver su carrito</p>";
                }
                echo "</section>";

            ?>
        </section>
    
        <section id="popup" class="popup">
            <section class="popup-content">
                <span class="close">&times;</span>
                <p id="userData"></p>
            </section>
        </section>
    </main>
    
    <footer class="bg-dark text-white">
        <p> &copy; 2024 Design Your Sneakers - Todos los derechos reservados</p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            //Seleccionamos los datos que necesitamos
            var btnComprar = document.getElementById("comprar");
            var popup = document.getElementById("popup");
            var btnCerrar = document.querySelector(".close");
            var userData = document.getElementById("userData");

            //Comprobamos que el boton de compra exista
            if(btnComprar){
                //Agregamos el addEventListenet al boton
                btnComprar.addEventListener("click", function() {
                    //Cogemos el email de la sesion
                    var email = "<?php echo htmlspecialchars($_SESSION['email'] ?? 'Cliente'); ?>";

                    userData.innerHTML = `<h4>Compra realizada con exito</h4> 
                        Le hemos enviado un mensaje de confirmacion de compra <br> Revise su email: ${email}`;
                    popup.style.display = "block"; //Mostramos el pop Up
                });

                //Agregamos el addEventListenet al boton para cerrar el popup
                btnCerrar.addEventListener("click", function(){                    
                    popup.style.display = "none";
                    window.location.href = "limpiar_carrito.php" //Al darle al boton de cerrar ir a limpiar.php y ahi nos redirige hasta el index.php
                });

                //Agregamso el addEventListenet para hacer clic fuera del popup
                window.addEventListener("click", function(event){
                    if(event.target == popup){
                        popup.style.display = "none";
                        window.location.href = "limpiar_carrito.php" //Al darle al boton de cerrar ir a limpiar.php y ahi nos redirige hasta el index.php
                    }
                });
            }
        });
    </script>

    <script src="../js/index.js"></script>
</body>
</html>