<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/electro/db/db.php';

    function get_all_users(){
        global $pdo;
        $sql = "SELECT * FROM users";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function get_user_by_id($u_id){
        global $pdo;
        $sql = "SELECT * FROM users WHERE id=:cid ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['cid' => $u_id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function get_user_by_email($email){
        global $pdo;
        $sql = "SELECT * FROM users WHERE email=:cemail ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['cemail' => $email]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }