<?php 
    function is_on_discount($prod_id){
        global $pdo;
        $sql = "SELECT * FROM discounts WHERE id=:pid";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['pid' => $prod_id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;  
    }