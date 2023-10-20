
<?php 
  	require_once $_SERVER['DOCUMENT_ROOT'] . '/electro/services/product-service/index.php'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <?php
        $res = get_all_prod_json();
        var_dump($res);
     ?>
</body>
</html>