<?php  
    function createOrder($ses){
        global $pdo;
        $sql = "INSERT INTO orders (user_id, total_amount, status, payment_status, shipping_address, billing_address)
                VALUES (:uid, :total, :status, :payment_status, :shipping_address, :billing_address)";
       $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':cname', $username);
      $stmt->execute();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }