<?php

error_reporting(-1);
session_start();
    include_once $_SERVER['DOCUMENT_ROOT'] . '/electro/services/product-service/index.php';

if (isset($_GET['cart'])) {
    switch ($_GET['cart']) {
        case 'add':
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $res = get_prod_by_id($id);

            if (!$res) {
                echo json_encode(['code' => 'error', 'answer' => 'Error product']);
            } else {
                $qty = add_to_cart($res[0]);
                ob_start();
                require $_SERVER['DOCUMENT_ROOT'] . '/electro/cartdropdown.php';
                $cart = ob_get_clean();
                echo json_encode(['code' => 'ok', 'answer' => $cart, 'cartQty' => $qty]);
            }
            break;

        case 'show':
            require $_SERVER['DOCUMENT_ROOT'] . '/electro/cartdropdown.php';
            break;

        case 'clear':
            if (!empty($_SESSION['cart'])) {
                unset($_SESSION['cart']);
                unset($_SESSION['cart.sum']);
                unset($_SESSION['cart.qty']);
            }
            require $_SERVER['DOCUMENT_ROOT'] . '/electro/cartdropdown.php';
            break;
        case 'order':
                if (!empty($_SESSION['cart'])) {
                
                $UoW->createOrder($_SESSION['cart']);
                unset($_SESSION['cart']);
                unset($_SESSION['cart.sum']);
                unset($_SESSION['cart.qty']);
            }
            require $_SERVER['DOCUMENT_ROOT'] . '/electro/cartdropdown.php';
            break;

    }
}