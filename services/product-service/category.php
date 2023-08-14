<?php 
    function get_all_categories(){
        global $pdo;
        $sql = "SELECT * FROM categories";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;    
    }
    function get_category_by_id($id){
        global $pdo;
        $sql = "SELECT * FROM categories WHERE id=:cid";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['cid' => $id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;    
    }
    function get_category_name_by_id($id){
        global $pdo;
        $sql = "SELECT * FROM categories WHERE id=:cid";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['cid' => $id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ucfirst($res[0]['name']);    
    }
    function get_cat_names(){
        $all_c = get_all_categories();
        $names = array();
        foreach ($all_c as $key => $value) {
            $names[] = ucfirst($value['name']);
        }
        return $names;
    }