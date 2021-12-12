<!DOCTYPE html>
<html lang="en-CA">

<?php

    $aisles = json_decode(file_get_contents("../aisles.json"), true);

    if(isset($_GET['aisle']))
    {
        foreach($aisles as &$value){
            if($value["id"] == $_GET['aisle']){
                $aisle = $value;
                break;
            }
        }
        
        unset($value);
    } 
    else
    {
        $aisle = $aisles[0];
    }

    $products = json_decode(file_get_contents("../all-products.json"), true);
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <script src="../scripts/cart.js"></script>
  <link rel="stylesheet" href="../styles/base.css">
  <link rel="stylesheet" href="../styles/aisle.css">

  <title><?php if(isset($aisle["name"])){ echo $aisle["name"];} else { echo "Aisle";} ?></title>
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
      <a href="../index.php">Home</a>
      <a href="../aisles/aisle.php">Aisles</a>
      <a href="../signup.html">Sign Up</a>
      <a href="../login.html">Log In</a>
      <a href="../cart.html">Cart</a>
    </div>
  </nav>
  <main>
    <div class="jumbotron text-center text-secondary bg-light" style="padding:5px; margin-top:20px;">
      <h2><?php if(isset($aisle["name"])){ echo $aisle["name"];} else { echo "Aisle";} ?></h2>
    </div>

    <div class="container" style="margin-top:30px; margin-bottom:30px;">
      <div class="row">
        <div class="col sidebar d-none d-sm-block">
          <h3>Aisles</h3>
          <?php 
            foreach($aisles as &$value){
                echo '<a href="aisle.php?aisle='.$value["id"].'">'.$value["name"].'</a><br>';
            }
            unset($value);
          ?>
          <hr>
        </div>

        <div class="col text-center">
          <div class="row">
            <?php 
                if(isset($aisle)){
                    $i = 0;
                    while(isset($products[$i])){
                        if(isset($products[$i]["aisle"]) && $products[$i]["aisle"] == $aisle["name"]){
                            echo '<div class="card">';
                                if(isset($products[$i]["image"])){
                                  echo '<a href="../products/product.php?index='.$i.'">';
                                    echo '<img class="card-img-top mx-auto d-block" src="'.$products[$i]["image"].'" ';
                                    if(isset($products[$i]["name"])) echo 'alt="'.$products[$i]["name"].'" ';
                                    echo '>';
                                  echo '</a>';
                                }
                                echo '<div class="card-body">';
                                      if(isset($products[$i]["name"])){
                                        echo '<a href="../products/product.php?index='.$i.'" style="text-decoration: none;">';
                                        echo '<h5 class="card-title">'.$products[$i]["name"].'</h5></a>';
                                      }
                                      if(isset($products[$i]["small_description"])) echo '<p class="card-text text-muted">'.$products[$i]["small_description"].'</p>';
                                echo '</div>';
                                echo '<div class="card-footer">';
                                    if(isset($products[$i]["small_description"])) echo '<p>'.$products[$i]["price_display"].'</p>';
                                    echo '<p><small class="text-muted">';
                                    if(isset($products[$i]["extra_info1"])) echo $products[$i]["extra_info1"].'<br>';
                                    if(isset($products[$i]["extra_info2"])) echo $products[$i]["extra_info2"];
                                    echo '</small></p>';
                                    echo '<button type="submit" class="btn btn-sm btn-primary" role="button" onclick="cart.addProduct('.$i.')">Add to cart</button>';
                                echo '</div>';
                            echo '</div>';
                        }
                        $i++;
                    }
                }
            ?>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"></script>
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