<!DOCTYPE html>
<html lang="en-CA">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../styles/base.css">
    <link rel="stylesheet" href="../styles/edit-product.css">

    <title>Edit Product</title>
</head>

<body>
    <nav>
        <div class="banner">
        <div class="banner__content">
            <div class="banner__text">
            <strong>Start Shopping Now!</strong>
            </div>
            <button class="banner__close" type="button">
            <span class="material-icons">
                close
            </span>
            </button>
        </div>
        </div>
        <div class="header">
        <img src="../images/logo.png" alt="logo" />
        </div>
        <div class="navbar">
        <a href="../index.html">Home</a>
        <a href="../admin/edit-order.html">Edit Order</a>
        <a href="../admin/list-customer.php">List Customer</a>
        <a href="../admin/list-order.html">List Order</a>
        <a href="../admin/list-product.php">List Product</a>
        </div>
    </nav>
    <?php 
        $products = json_decode(file_get_contents("../all-products.json"), true);

        if(isset($_GET['action']))
        {
            if($_GET['action'] == "add") 
                $i = strval(count($products));
            else if($_GET['action'] == "edit") 
                if(isset($_GET['index'])) $i = $_GET['index'];
        }
    ?>
    <main>
        <div class="container-fluid">
            <h1>Edit Product</h1>
            
            <form method="POST" action=<?php echo '"'; if( isset($i)) echo 'edit-product-process.php?index='.$i; echo '"';?>>
                <table>
                    <tr>
                        <td style="width:120px"><label for="id">Product ID#: </label></td>
                        <td><input type="text" id="id" name="id" <?php if(isset($products[$i]["id"])){echo "value = '".$products[$i]["id"]."'";} ?>></td>
                    </tr>
                    <tr>
                        <td style="width:120px;"><label for="name">Product Name: </label></td>
                        <td><input type="text" id="name" name="name" <?php if(isset($products[$i]["name"])){echo "value = '".$products[$i]["name"]."'";} ?>></td>
                    </tr>
                    <tr>
                        <td style="width:120px"><label for="small_description">Short Description: </label></td>
                        <td><input type="text" id="small_description" name="small_description" <?php if(isset($products[$i]["small_description"])){echo "value = '".$products[$i]["small_description"]."'";}?> ></label></td>
                    </tr>
                    <tr>
                        <td style="width:120px"><label for="description">Description: </label></td>
                        <td><textarea id="description" name="description">
                            <?php 
                                if(isset($products[$i]["description"])) echo $products[$i]["description"];
                                else echo "Product description."; 
                            ?>
                        </textarea></td>
                    </tr>
                    <tr>
                        <td style="width:120px"><label for="image">Image: </label></td>
                        <td><input type="file" accept="image/png, image/jpeg, image/jpg" id="image" name="image"></td>
                    </tr>
                    <tr>
                        <td style="width:120px"><label for="aisle">Aisle: </label></td>
                        <td><select id="aisle" name="aisle" <?php if(isset($products[$i]["aisle"])){echo "value = '".$products[$i]["aisle"]."'";} ?>>
                        <?php 
                            $aisles = json_decode(file_get_contents("../aisles.json"), true);
                            foreach($aisles as &$value){
                                echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
                            }
                            
                            unset($value);
                        ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td style="width:120px"><label for="price">Price ($): </label></td>
                        <td><input type="number" id="price" name="price" <?php if(isset($products[$i]["price"])){echo "value = '".$products[$i]["price"]."'";} ?>></td>
                    </tr>
                    <tr>
                        <td style="width:120px"><label for="price_display">Display Price: </label></td>
                        <td><input type="text" id="price_display" name="price_display" <?php if(isset($products[$i]["price_display"])){echo "value = '".$products[$i]["price_display"]."'";} ?>></td>
                    </tr>
                    <tr>
                        <td style="width:120px"><label for="extra_info1">Average Weight: </label></td>
                        <td><input type="text" id="extra_info1" name="extra_info1" <?php if(isset($products[$i]["extra_info1"])){echo "value = '".$products[$i]["extra_info1"]."'";} ?>></td>
                    </tr>
                    <tr>
                        <td style="width:120px"><label for="extra_info2">Price By Weight: </label></td>
                        <td><input type="text" id="extra_info2" name="extra_info2" <?php if(isset($products[$i]["extra_info2"])){echo "value = '".$products[$i]["extra_info2"]."'";} ?>></td>
                    </tr>
                    <tr>
                        <td style="width:120px"><label for="inventory">Inventory: </label></td>
                        <td><input type="number" id="inventory" name="inventory" <?php if(isset($products[$i]["inventory"])){echo "value = '".$products[$i]["inventory"]."'";} ?>></td>
                    </tr>
                </table>
                <input type="submit" value="Submit">
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </main>
    <footer>
        <div class="footer">
          
      <div class="contact">
        <h2>Contact Us:</h2>
        <p>Telephone: 123-456-7890</p>
        <p>Email: TheBestestWebstore@gmail.com</p>
        <p>Twitter: @TheBestest</p>
        <p>Facebook: @TheBestestCa</p>
        <p>Page by Salah</p>
      </div>
      <div class="social">
        <a href="https://www.facebook.com" class="fa fa-facebook"></a>
        <a href="https://www.twitter.com" class="fa fa-twitter"></a>
        <a href="https://www.youtube.com" class="fa fa-youtube"></a>
      </div>
        </div>
    </footer>
</body>

</html>