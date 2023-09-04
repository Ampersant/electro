<?php
// Проверяем, что запрос был выполнен методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из AJAX-запроса
    $selectedCategories = $_POST["categories"];
    $minPrice = $_POST["minPrice"];
    $maxPrice = $_POST["maxPrice"];

    // Далее вы можете использовать полученные данные для фильтрации продуктов и получения результатов
    // Например, выполните SQL-запрос к базе данных с учетом выбранных категорий и ценового диапазона

    // Здесь должен быть код для фильтрации и получения результатов

    // Верните результаты в формате JSON
    $filteredProducts = [
        ["name" => "Product 1", "price" => 100],
        ["name" => "Product 2", "price" => 150],
        // Добавьте здесь другие продукты, которые соответствуют фильтрам
    ];

    header("Content-Type: application/json");
    echo json_encode($filteredProducts);
} else {
    // Если запрос не был выполнен методом POST, вы можете вернуть сообщение об ошибке или выполнить другие действия
    echo "Invalid request method";
}
?>
