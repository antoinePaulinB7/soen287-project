<?php
    if(isset($_GET['index'])){
        
        $products = json_decode(file_get_contents("../all-products.json"), true);
        $i = $_GET['index'];

        $product = array(
            "id" => $_POST['id'], 
            "name" => $_POST['name'], 
            "aisle" => $_POST['aisle'], 
            "price" => $_POST['price'], 
            "price_display" => $_POST['price_display'], 
            "extra_info1" => $_POST['extra_info1'], 
            "extra_info2" => $_POST['extra_info2'], 
            "inventory" => $_POST['inventory'], 
            "small_description" => $_POST['small_description'], 
            "description" => $_POST['description']); 
            
        if($_POST['image'] == "" && isset($products[$i]))
            $product["image"] = $products[$i]['image'];
        else{
            $product["image"] = $_POST['image']; 
        }
            

        $products[$i] = $product;
        file_put_contents("../all-products.json", json_encode($products, JSON_PRETTY_PRINT));

        header("Location:edit-product.php?action=edit&index=".$i);
        exit();
    }  

    header("Location:list-product.php");
    exit();
?>