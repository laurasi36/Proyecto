<?php
    session_start();

    require 'database.php';

    //Comprobamos que se han pasado bien todos los datos
    if(isset($_POST['image']) && isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['id']) && isset($_POST['talla'])) {
        $image = $_POST['image'];
        $nombre = htmlspecialchars($_POST['nombre']);
        $precio = htmlspecialchars($_POST['precio']);
        $id = htmlspecialchars($_POST['id']);
        $talla = htmlspecialchars($_POST['talla']);

        //Rellenamos el array con los datos recibidos
        $_SESSION['carrito'][] = [
            'image' => $image,
            'nombre' => $nombre,
            'precio' => $precio,
            'talla' => $talla
        ];

        header('Location: ver_carrito.php?status=success');//Nos redirige a la pagina para ver el carrito
    } 
?> 