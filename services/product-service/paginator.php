<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/electro/db/db.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/electro/services/product-service/index.php'; 


// Define pagination parameters
$itemsPerPage = 20;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page from the URL

// Calculate the offset for the database query
$offset = ($currentPage - 1) * $itemsPerPage;

// Fetch data from your data source (e.g., a database)
// For example, using PDO:
global $pdo;

$query = "SELECT * FROM products LIMIT $itemsPerPage OFFSET $offset";
$result = $pdo->query($query);

// Display the data

while ($row = $result->fetch()) {
    echo ' <div class="col-md-4 col-xs-6">
            <div class="product">'; // start of the products
    echo '
            <div class="product-img">
                <img src="./img/product01.png" alt="">
            <div class="product-label">
            <span class="sale"></span>
            <span class="new">NEW</span>
        </div>
    </div>'; // img section 
    echo '<div class="product-body">
    <p class="product-category">'.get_category_name_by_id($row['category_id']).'</p>
    <h3 class="product-name"><a href="#">'.$row['name'].'</a></h3>
    <h4 class="product-price">$'.$row['price'].'<del class="product-old-price">$${product.oldPrice}</del></h4>
    
    <div class="product-btns">
        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
    </div>
</div>
<div class="add-to-cart">
    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
</div>
</div>
</div>'; 
}

$query = "SELECT * FROM products";
$stmt = $pdo->prepare($query);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($res);
// Generate pagination links
$totalItems = count($res); // Replace with the actual total number of items
$totalPages = ceil($totalItems / $itemsPerPage);
// echo $totalItems . "SADADS" . '<br>';
// echo $totalPages;

echo '<div class="store-filter clearfix">
<span class="store-qty">Showing 20-100 products</span>
<ul id="oldnav" class="store-pagination">';
if ($currentPage > 1) {
    echo '<li><a href="?page=' . ($currentPage - 1) . '"><i class="fa fa-angle-left"></i></a></li>';
}
for ($i = 1; $i <= $totalPages; $i++) {
    echo '<li><a href="?page=' . $i . '"' . ($i == $currentPage ? ' class="current"' : '') . '>' . $i . '</a></li>';
}
if ($currentPage < $totalPages) {
    echo '<li><a href="?page=' . ($currentPage + 1) . '"><i class="fa fa-angle-right"></i></a></li>';
}
echo '</ul></div>';
?>