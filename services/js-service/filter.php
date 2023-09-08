<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/electro/services/product-service/index.php'; 

// Проверяем, что запрос был выполнен методом POST

    // Получаем данные из AJAX-запроса
    $selectedCategories = $_GET["categories"];
    $minPrice = $_GET["minPrice"];
    $maxPrice = $_GET["maxPrice"];
     
    $total = get_filter_prod($selectedCategories,$minPrice,$maxPrice);   

    header("Content-Type: application/json");
    echo json_encode($total);

?>
