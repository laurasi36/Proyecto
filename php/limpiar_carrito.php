<?php
    session_start();

    require 'database.php';
    
    //Limpiar el carrito
    unset($_SESSION['carrito']);

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        
        // Incrementar el número de compras realizadas por el usuario
        $stmt = $conn->prepare('UPDATE usuarios SET compras = compras + 1 WHERE id = :id');
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();
    }

    //Volver a la pagina de inicio
    header("Location: index.php");
    exit();
?>