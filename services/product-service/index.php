<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/electro/db/db.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/electro/services/product-service/category.php';
    
    use Pagerfanta\Adapter\ArrayAdapter;
    use Pagerfanta\Pagerfanta;

    
    function get_all_prod(){
        global $pdo;
        $sql = "SELECT * FROM products";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function get_all_prod_json(){
        global $pdo;
        $sql = "SELECT * FROM products";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($res);
        return $json;
    }
    
    function get_all_prod_paginated($itemsPerPage){
        global $pdo;
        $sql = "SELECT * FROM products";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $adapter = new ArrayAdapter($data);
        $paginator = new Pagerfanta($adapter);
        $paginator->setMaxPerPage($itemsPerPage); // Установите количество элементов на странице.

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
    function get_filter_prod($categories, $minPrice = 0, $maxPrice = 999999){
        $res = [];
        $cat_prods = [];
        if ($categories == "all") {
            $cat_prods = get_all_prod();
        }else {
            foreach ($categories as $key => $value) {
                $temp = get_all_prod_by_category($value);
                $cat_prods = array_merge($cat_prods, $temp);
            }
        }
        
        foreach ($cat_prods as $key => $item) {
            if ($item['price'] >= $minPrice && $item['price'] <= $maxPrice) {
                $item['category_name'] = get_category_name_by_id($item['category_id']);
                $res[] = $item;
            }
        }
        $adapter = new ArrayAdapter($res);
        $paginator = new Pagerfanta($adapter);
        $paginator->setMaxPerPage(5);
        $paginator->setCurrentPage($_GET['page'] ?? 1); 
        return $paginator;

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

    