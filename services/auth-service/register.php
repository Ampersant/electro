<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/electro/db/db.php';

    if (isset($_POST)) {
       $email = $_POST['email'];
       $username = $_POST['username']; 
       $pass = $_POST['password'];
       $hash = password_hash($pass, PASSWORD_BCRYPT);
       global $pdo; 
       $sql = "INSERT INTO users (username, email, password_hash) VALUES (:cname, :cemail, :cpass)";
       $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':cname', $username);
      $stmt->bindParam(':cemail', $email);
      $stmt->bindParam('cpass', $hash);
      $stmt->execute();
    }