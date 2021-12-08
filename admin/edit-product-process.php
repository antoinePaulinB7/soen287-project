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
        

        $file = $_POST['image'];

        if($_POST['image'] == "" && isset($products[$i]))
            $product["image"] = $products[$i]['img'];
        else{
            $target_dir = "../images/products/";
            $target_file = $target_dir . basename($_FILES[$file]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES[$file]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            if($uploadOk && move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)){
                $product["img"] = htmlspecialchars(basename($_FILES[$file]["name"])) ; 
            }
            else if(isset($products[$i])) $product["image"] = $products[$i]['image'];
            else $product["image"] = "";
        }
        
        echo $product["image"];

        $products[$i] = $product;
        file_put_contents("../all-products.json", json_encode($products, JSON_PRETTY_PRINT));

        //header("Location:edit-product.php?action=edit&index=".$i);
        //exit();
    }  

    //header("Location:list-product.php");
    //exit();
?>