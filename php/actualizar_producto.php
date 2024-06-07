
<?php
    session_start();
    
    //Miramos si ha recibido bien el id
    if (isset($_POST['index'])) {
        $index = $_POST['index'];
    
        //Miramos si el produto existe con ese id
        if (isset($_SESSION['carrito'][$index])) {
            if (isset($_POST['incrementa'])) {
                $_SESSION['carrito'][$index]['cantidad'] += 1; //Sumamos un valor a la cantidad
            }
            if (isset($_POST['decrementa'])) {
                $_SESSION['carrito'][$index]['cantidad'] = max(1, $_SESSION['carrito'][$index]['cantidad'] - 1);//Restamos un valor a la cantidad
            }
        }
    }
    
    header('Location: ver_carrito.php');
    exit;
?>