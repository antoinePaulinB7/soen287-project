<!DOCTYPE html>
<html>

<?php
        if(isset($_GET['action'])){
            $action = $_GET['action']; 
        }
        if(isset($_GET['index']))
        {
            $i = $_GET['index'];
        } 
        else
        {
            $i = 0;
        }
        
        $aisles = json_decode(file_get_contents("../all-products.json"), true)["aisles"];
        $products = json_decode(file_get_contents("../all-products.json"), true)["products"];

        if(isset($products[$i])){
            foreach($aisles as &$value){
                if($products[$i]["aisle"] == $value["name"]){
                    $aisle = $value["id"];
                    break;
                }
            }

            unset($value);
        } else {
            header('HTTP/1.1 404 Not Found', true, 404);
            $_GET['e'] = 404;
            echo '<p>This product does not exist.<p>';
            exit();
        }
    ?>

<head>
  <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php if(isset($i)){ echo $products[$i]["name"];} else { echo "Product";} ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="../styles/base.css" />
  <link rel="stylesheet" href="../styles/product.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <script src="../scripts/cart.js"></script>
  <script src="../scripts/detailedDescription.js"></script>
  <script src="../scripts/product.js"></script>
</head>

<body style="margin: auto">
    <nav>
        <div class="banner">
        <div class="banner__content">
            <div class="banner__text">
            <strong>Start Shopping Now!</strong>
            </div>
            <button class="banner__close" type="button">
            <span class="material-icons"> close </span>
            </button>
        </div>
        </div>
        <div class="header">
        <img src="../images/logo.png" alt="logo" />
        </div>
        <div class="navbar">
        <a href="../index.html">Home</a>
        <a href="../aisles/aisle.php">Aisles</a>
        <a href="../signup.html">Sign Up</a>
        <a href="../login.html">Log In</a>
        <a href="../cart.html">Cart</a>
        </div>
    </nav>
    <main>
        <div class="top"></div>
        <div style="flex-direction: column; display: flex">
            <div class="topnavi">
                <li>
                <span><a href="../index.html">Home</a></span>
                </li>
                <?php
                    if(isset($products[$i]["aisle"])){
                        echo '<li><span>';
                        echo '<a href=';
                        if(isset($aisle)) echo '"../aisles/aisle.php?aisle='.$aisle.'">';
                        else echo '#>';
                        echo $products[$i]["aisle"].'</a>';
                        echo '</span></li>';
                    }
                ?>
                <li>
                <span><a class="active" href="#redtomatoes"><?php if(isset($i)){ echo $products[$i]["name"];} ?></a></span>
                </li>
            </div>
            <div class="container">

            <div class="left">
                <?php if(isset($i)){echo "<img width='300px' height='auto' src='".$products[$i]['image']."' alt='".$products[$i]['name']."' />";} ?>
            </div>
            <div class="right">
                <?php 
                    if(isset($products[$i]["name"])) echo "<p1>".$products[$i]['name']."</p1><br/><br/>"; 
                    if(isset($products[$i]["price_display"])) echo "<p2 id='unit'>".$products[$i]["price_display"]."</p2> ";
                    if(isset($products[$i]["extra_info1"])) echo "<p3>".$products[$i]["extra_info1"]."</p3>";
                    if(isset($products[$i]["extra_info2"])) echo "<br /><p4>".$products[$i]["extra_info2"]."</p4>";
                    echo "<br /> <br />";
                ?>
                
                <div class="quantity-wrapper">
                    <button type="button" name="plus" onclick="addbutton()">+</button>
                    <input type="number" min="1" value="1" size="2" name="Quantity" id="quantity" readonly/>  
                    <button type="button" name="minus" onclick="minusbutton()">-</button>
                </div>
                <button class="btn-primary add" onclick="cart.addProduct(3)">Add to Cart</button>
                <br /><br />
                <button onClick="window.location.reload();">Refresh</button>

                <br /><br />

                <label id="priceDisplay"> </label>

                <div class="productInfo">
                    <div class="description">
                    <span>More Description</span>
                    <div class="seeMore">
                        <i class="fas fa-plus-circle" onclick="showIt()"></i>
                    </div>
                    </div>
                    <?php 
                        echo "<p id='theDetailedDescription' class='descriptionText is-hidden'>"; 
                        if(isset($products[$i]['description'])) echo $products[$i]['description'];
                        else echo "No description.";
                        echo "<i class='fas fa-minus-circle' onclick='hideIt()'></i><br/></p>";
                    ?>
                    
                    <p class="descriptionText">
                    Our online grocery store tries to give you the best possible
                    experience. However, we are not responsible for the condition in
                    which you receive your order. Please contact the delivery
                    company if you have any issue with your delivery.
                    </p>
                </div>
            </div>
            <div class="topfooter">Prices may be modified without prior notice.</div>
        </div>
        </div>
    </main>
    <footer>
        <div class="footer">
            <div class="contact">
                <h2>Contact Us:</h2>
                <p>Telephone: 123-456-7890</p>
                <p>Email: TheBestestWebstore@gmail.com</p>
                <p>Twitter: @TheBestest</p>
                <p>Facebook: @TheBestestCa</p>
                <p>Page by Kahina</p>
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