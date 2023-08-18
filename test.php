<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/electro/services/product-service/index.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/electro/services/product-service/category.php'; 
        $all = get_cat_names();
    ?>
</head>
<body>
    <?php var_dump($all); ?> 
    <button href="google.com">HREF TEST</button>
</body>
</html>