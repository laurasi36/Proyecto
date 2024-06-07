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
    <title>Informacion Adulto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/info.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script> /*Al seleccionar el color del playero que queremos se nos cambia por la imagen principal (grande)*/ 
        
        function cambiarySelectImagen(element, base64Image) {
            document.getElementById('imagenPrincipal').src = 'data:image/png;base64,' + base64Image;
            document.getElementById('image').value = base64Image;
        }

        function selectSize(size) {
            document.getElementById('talla').value = size;

            //Si escogemos otro boton quitar la seleccion del anterior y marcar el nuevo
            var buttons = document.querySelectorAll('.contenedorTalla .boton');
            buttons.forEach(function(button) {
                button.classList.remove('selected');
            });

            var btnSelect = document.querySelector('.contenedorTalla .boton[value="' + size + '"]');
            btnSelect.classList.add('selected');
        }

    
    </script>
    <style>
        .selected{
            background-color: rgb(206, 203, 203);
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
<br><br><br><br><br>
    <main>
        <section class="container " id="colores">
            <?php
                $id_playero = $_GET["id"];

                //Cogemos los datos de las distintas tablas con el id que cogemos al pasar de pantalla
                $sql = "SELECT * FROM info WHERE id = :id_playero";
                $sql2 = "SELECT * FROM colores WHERE codigo = :id_playero";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id_playero', $id_playero, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $stmt2 = $conn->prepare($sql2);
                $stmt2->bindParam(':id_playero', $id_playero, PDO::PARAM_INT);
                $stmt2->execute();
                $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                

            if(!empty($result)){
                $playero = $result[0];
                $imageBase64 = base64_encode($playero["image"]);
                echo "<section>";
                    echo "<section class='container1'>";
                    echo "<img id='imagenPrincipal' class='imagen' src='data:image/png;base64,".$imageBase64."' onclick='cambiarySelectImagen(this, \"".$imageBase64."\")'><br>";
                    echo "</section>";
                    echo "<section class='container2'>";
                    echo "<span class = 'textoNombre'>".$playero["nombre"]."</span><br>";
                    echo "<span class ='textoPrecio'>".$playero["precio"]."€</span>";
                    echo "</section>";
                    echo "<section class='container2'>";
                    echo "<p>".$playero["descripcion"]."</p>";
                    echo "</section>";
                

                echo "<section class='container2'>";
                //Recorremos la segunda consulta para sacar la imagen del playero de color
                foreach($result2 as $row2){
                    $imageBase64Color = base64_encode($row2["image"]);
                    echo "<img class='imagenColor' id='imagenSecundaria' src='data:image/png;base64,".$imageBase64Color."' onclick='cambiarySelectImagen(this, \"".$imageBase64Color."\")'>";
                }
                
                echo "</section>";

                echo "<section class='contenedorTalla'>";
                //Creamos con un for una cantidad de botones para escoger la talla
                for($i=36; $i<=45; $i++){
                    echo "<button class='boton' value='$i' onclick='selectSize($i)'>EUR $i</button>";
                }
                echo "</section>";
                
                echo "<section class='contenedorBoton'>";
                echo "<form id='imageForm' action='carrito.php' method='POST'>";
                //Dependiendo de que imagen este en la principal, muestra la imagen principal o la de color
                if($imageBase64){
                    echo "<input type='hidden' name='image' id='image' value='" . $imageBase64 . "'>";
                    echo "<input type='hidden' name='nombre' value='".$playero["nombre"]."'>";
                    echo "<input type='hidden' name='precio' value='".$playero["precio"]."'>";
                    echo "<input type='hidden' name='id' value='".$id_playero."'>";
                    echo "<input type='hidden' name='talla' id='talla' value=''>";
                }else{
                    echo "<input type='hidden' name='image' id='image' value='" . $imageBase64Color . "'>";
                    echo "<input type='hidden' name='nombre' value='".$playero["nombre"]."'>";
                    echo "<input type='hidden' name='precio' value='".$playero["precio"]."'>";
                    echo "<input type='hidden' name='id' value='".$id_playero."'>";
                    echo "<input type='hidden' name='talla' id='talla' value=''>";
                }
            
                if(empty($user)){
                    echo "<button id='btnDisabled' class='btnAnadir' type='submit' onclick='añadirCarro()' disabled>Añadir al carrito</button>";
                }else{
                    echo "<button class='btnAnadir' type='submit' onclick='añadirCarro()'>Añadir al carrito</button>";
                }
                echo "</form>";
                echo "</section>";

            
            }else{
                echo "<p>No se encontro el producto</p>";
            }
            ?>
        </section>
    </main>

    <footer class="bg-dark text-white">
        <p> &copy; 2024 Foot Gala - Todos los derechos reservados</p>
    </footer>

    <script src="../js/index.js"></script>
    
    
</body>
</html>