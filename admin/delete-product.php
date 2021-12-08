<?php
    if(isset($_GET['index'])){
        
        $i = $_GET['index'];
        $products = json_decode(file_get_contents("../all-products.json"), true);
        unset($products[$i]);
        file_put_contents("../all-products.json", json_encode($products, JSON_PRETTY_PRINT));
    }  

    header("Location:list-product.php");
    exit();
?>