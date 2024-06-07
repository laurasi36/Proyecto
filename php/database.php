<?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'playeros';

    try {
        $conn = new PDO("mysql:host=$server;port=3307;dbname=$database;",$username,$password);
    } catch (PDOException $e) {
        die('Connected failed: '.$e->getMessage());        
    }
?>