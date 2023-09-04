<?php  
    require_once $_SERVER['DOCUMENT_ROOT'] . '/electro/services/user-service/users.php';

session_start();
        
        $email = $_POST['email'];
        $user = get_user_by_email($email);
        if ($user) {
          $user_id = intval($user[0]['id']);
        }else {
          throw new Exception("Error Processing Request", 1);
        }
        $bname = $_POST['first-name'];
        $blastname = $_POST['last-name'];
        $total = $_SESSION['cart.sum'];
        $status = "created";
        $payment_status = "not paid";
        $baddress = $_POST['address'] . " | " . $_POST['city'] . " | " . $_POST['country']
                    . " | " . $_POST['zip-code'];
        $tel = $_POST['tel'];
        global $pdo;
        $sql = "INSERT INTO orders (user_id, email, tel, bil_name, bil_last_name, sh_name, sh_last_name, total_amount, stat, payment_status, shipping_address, billing_address)
                VALUES (:user_id, :email, :tel, :bil_name, :bil_last_name, :sh_name, :sh_last_name, :total_amount, :stat, :payment_status, :shipping_address, :billing_address)";
         $stmt = $pdo->prepare($sql);
        if (isset($_POST['another_ship'])) {
          $sname = $_POST['s-first-name'];
          $slastname = $_POST['s-last-name'];
          $saddress = $_POST['s-address'] . " | " . $_POST['s-city'] . " | " . $_POST['s-country']
                    . " | " . $_POST['s-zip-code'];
          $stmt->bindParam(':user_id', $user_id);
          $stmt->bindParam(':email', $email);
          $stmt->bindParam(':tel', $tel);
          $stmt->bindParam(':bil_name', $bname);
          $stmt->bindParam(':bil_last_name', $blastname);
          $stmt->bindParam(':sh_name', $sname);
          $stmt->bindParam(':sh_last_name', $slastname);
          $stmt->bindParam(':total_amount', $total);
          $stmt->bindParam(':stat', $status);
          $stmt->bindParam(':payment_status', $payment_status);
          $stmt->bindParam(':shipping_address', $saddress);
          $stmt->bindParam(':billing_address', $baddress);
        }else{
          $stmt->bindParam(':user_id', $user_id);
          $stmt->bindParam(':email', $email);
          $stmt->bindParam(':tel', $tel);
          $stmt->bindParam(':bil_name', $bname);
          $stmt->bindParam(':bil_last_name', $blastname);
          $stmt->bindParam(':sh_name', $bname);
          $stmt->bindParam(':sh_last_name', $blastname);
          $stmt->bindParam(':total_amount', $total);
          $stmt->bindParam(':stat', $status);
          $stmt->bindParam(':payment_status', $payment_status);
          $stmt->bindParam(':shipping_address', $baddress);
          $stmt->bindParam(':billing_address', $baddress);
        }
        $stmt->execute();
        unset($_SESSION['cart']);
        unset($_SESSION['cart.sum']);
        unset($_SESSION['cart.qty']);
        header("Location: ../../index.php");
