<?php 
    $dsn = "mysql:host=localhost;dbname=shopcv";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO($dsn, $username, $password);
        // Установка опций, например, режима обработки ошибок
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
