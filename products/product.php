<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
  <title>Red Cluster Tomatoes</title>
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
        <a href="../aisles/aisle-1.html">Aisles</a>
        <a href="../signup.html">Sign Up</a>
        <a href="../login.html">Log In</a>
        <a href="../cart.html">Cart</a>
        </div>
    </nav>

    <?php
        
        $allProductsJson = file_get_contents("../all-products.json");
        $products = json_decode($allProductsJson, true);
        var_dump($products["2"]);
        
        $name = "Cluster Tomatoes";
        $img = "../images/products/tomatoes.jpg";
        $priceAvg = "$5.11 avg. ea.";
        $avgWeight = "(775g avg.)";
        $pricePerKG = "$6.59 /kg";
        $description = "Our cluster tomatoes are grown on our farms and are pesticide free "
                . "and are certainly organic. They are also kept under natural sunlight "
                . "so that we can harvest a higher quality peoduct. They are also grown "
                . "seperately from all other vegetables to maintain their quality.";
    ?>

    <main>
        <div class="top"></div>
        <div style="flex-direction: column; display: flex">
            <div class="topnavi">
                <li>
                <span><a href="../index.html">Home</a></span>
                </li>
                <li>
                <span><a href="../aisles/aisle-1.html">Aisles</a></span>
                </li>
                <li>
                <span><a href="../aisles/aisle-1.html">Fruits & Vegetables</a></span>
                </li>
                <li>
                <span><a class="active" href="#redtomatoes">Red Cluster Tomatoes</a></span>
                </li>
            </div>
            <div class="container">

            <div class="left">
                <?php echo "<img width='300px' height='auto' src='$img' alt='$name' />"; ?>
            </div>
            <div class="right">
                <?php 
                    echo "<p1>$name</p1><br/><br/>"; 
                    echo "<p2 id='unit'>$priceAvg </p2>";
                    echo "<p3>$avgWeight</p3> <br />";
                    echo "<p4>$pricePerKG</p4> <br /> <br />";
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
                        echo "$description";
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