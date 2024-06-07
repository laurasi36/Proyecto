<?php
    session_start();

    //Comprobamos que se le paso bien el id
    if (isset($_POST['index'])) {
        $index = $_POST['index'];
    
        //Comprobamos que el producto tiene ese index
        if (isset($_SESSION['carrito'][$index])) {
            //Miramos si la cantidad es mayor que 1, si es asi le restamos 1
            if ($_SESSION['carrito'][$index]['cantidad'] > 1) {
                $_SESSION['carrito'][$index]['cantidad']--;
            } else {
                unset($_SESSION['carrito'][$index]); //Si la cantidad es uno, eliminado el producto 
            }
        }
    }
    header('Location: ver_carrito.php'); //Nos dirige a la pagina para ver el carrito
    exit();
?>