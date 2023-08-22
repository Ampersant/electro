<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/electro/db/db.php';
    
    
    function get_all_prod(){
        global $pdo;
        $sql = "SELECT * FROM products";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function get_all_prod_by_category($category_id){
        global $pdo;
        $sql = "SELECT * FROM products WHERE category_id=:cid ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['cid' => $category_id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function get_all_prod_new_by_category($category_id){
        global $pdo;
        $sql = "SELECT * FROM products WHERE category_id=:cid AND new=1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['cid' => $category_id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function get_all_prod_new(){
        global $pdo;
        $sql = "SELECT * FROM products WHERE new=1 ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function get_prod_by_id($id){
        global $pdo;
        $sql = "SELECT * FROM products WHERE id=:id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function count_discount_percent($id){
        $obj = get_prod_by_id($id);
        if ($obj[0]['discount_price']) {
            $pc = (($obj[0]['price'] - $obj[0]['discount_price'])/$obj[0]['price']) * 100 ;
            $str = $pc . '%';
            return $str;
        }
        
    }
    function add_to_cart($product)
        {
            if (isset($_SESSION['cart'][$product['id']])) {
                $_SESSION['cart'][$product['id']]['qty'] += 1;
            } else {
                $_SESSION['cart'][$product['id']] = [
                    'name' => $product['name'],
                    'desc' => $product['descr'],
                    'price' => $product['price'],
                    'img_url' => $product['img_url'],
                    'qty' => 1
                ];
            }
        
            $_SESSION['cart.qty'] = !empty($_SESSION['cart.qty']) ? ++$_SESSION['cart.qty'] : 1;
            $_SESSION['cart.sum'] = !empty($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $product['price'] : $product['price'];

            return $_SESSION['cart.qty'];
        }

    