<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/electro/db/db.php';

// Define pagination parameters
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page from the URL

// Calculate the offset for the database query
$offset = ($currentPage - 1) * $itemsPerPage;

// Fetch data from your data source (e.g., a database)
// For example, using PDO:
global $pdo;

$query = "SELECT * FROM products LIMIT $itemsPerPage OFFSET $offset";
$result = $pdo->query($query);

// Display the data
echo '<div class="container"><div class="row">';
while ($row = $result->fetch()) {
    echo '<div class="col-md-3"><div class="product">';
    echo '<h4>' . $row['name'] . '</h2>'; // Assuming you have a 'product_name' column
    echo '<p>' . $row['descr'] . '</p>'; // Assuming you have a 'description' column
    echo '<p>Price: $' . $row['price'] . '</p>'; // Assuming you have a 'price' column
    // You can add more product details here

    echo '</div>';
    echo '</div>';
}

echo '</div>';
echo '</div>';

$query = "SELECT * FROM products";
$stmt = $pdo->prepare($query);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($res);
// Generate pagination links
$totalItems = count($res); // Replace with the actual total number of items
$totalPages = ceil($totalItems / $itemsPerPage);
var_dump($result->fetch());
// echo $totalItems . "SADADS" . '<br>';
// echo $totalPages;

echo '<ul class="pagination">';
if ($currentPage > 1) {
    echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage - 1) . '">Previous</a></li>';
}
for ($i = 1; $i <= $totalPages; $i++) {
    echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '"' . ($i == $currentPage ? ' class="current"' : '') . '>' . $i . '</a></li>';
}
if ($currentPage < $totalPages) {
    echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage + 1) . '">Next</a></li>';
}
echo '</ul>';
?>