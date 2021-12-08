<?php
$orderHistory = (array) json_decode(file_get_contents("../scripts/order.json"),true);
$amountOfProducts = sizeof($orderHistory["order"]);

if (isset($_POST["Save"])) {
  $productArray = array();
  for ($index = 0; $index < $amountOfProducts; $index++) {
    $name = "productName" . $index;
    $productName = $_POST[$name];
    $aisle = "productAisle" . $index;
    $productAisle = $_POST[$aisle];
    $quantity = "productQuantity" . $index;
    $productQuantity = $_POST[$quantity];
    $price = "productPrice" . $index;
    $productPrice = $_POST[$price];

    $product=array("name"=>$productName,"quantity"=>$productQuantity,"price"=>$productPrice,"aisle"=>$productAisle);
   
    array_push($productArray,$product);
  }
  
  $orderHistory["order"]= $productArray;
  file_put_contents("../scripts/order.json",json_encode($orderHistory),true);
  header("Location:index.html");
}

if(isset($_POST["DeleteOrder"])){
  $orderHistory["order"]= array();
  file_put_contents("../scripts/order.json",json_encode($orderHistory),true);
  header("Location:index.html");
}

?>




<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Profile</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="../styles/base.css">
  <link rel="stylesheet" href="../styles/edit-order.css">

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
      <a href="../admin/edit-customer.html">Edit Customer</a>
      <a href="../admin/edit-order.html">Edit Order</a>
      <a href="../admin/edit-product.html">Edit Product</a>
      <a href="../admin/list-customer.html">List Customer</a>
      <a href="../admin/list-order.html">List Order</a>
      <a href="../admin/list-product.html">List Product</a>
    </div>
  </nav>
  <main>
    <div class="container">
      <h1 id="OrderList"> Order Profile </h1>
      <form action="" method="POST">
        <table class="ProfileTable">
          <tr class="ProfileHeader">
            <th colspan="5">Cédric Michaud</th>
          </tr>

          <tr class="ProfileSubHeader">
            <td>Name of the Product</td>
            <td>Quantity</td>
            <td>Aisle Name</td>
            <td>Unit Price</td>
            <td>Price</td>
          </tr>
          <?php $productId=0; ?>
          <?php foreach ($orderHistory["order"] as $order) : ?>
            <?php if ($order["aisle"] == "fruits and vegetables") : ?>

              <tr class="ProfileRest">
                <td>
                  <input name=<?php echo '"productName' . $productId . '""'; ?> id="productSearch" type="text" value=<?php echo $order["name"]; ?> readonly>
                </td>
                <td><input name=<?php echo '"productQuantity' . $productId . '""'; ?> type="number" min="1" value=<?php echo $order["quantity"]; ?>></td>
                <td><input name=<?php echo '"productAisle' . $productId . '""'; ?> type="text" value="fruits and vegetables"></td>
                <td><input type="text" name=<?php echo '"productPrice' . $productId . '""'; ?> value=<?php echo $order["price"]; ?>></td>
                <td>
                  <div class="totalPrice"></div>
                </td>
              </tr>
            <?php endif; ?>

            <?php if ($order["aisle"] == "meat and poultry") : ?>

              <tr class="ProfileRest">
                <td>
                  <input name=<?php echo '"productName' . $productId . '""'; ?> id="productSearch" type="text" value=<?php echo $order["name"]; ?> readonly>
                </td>
                <td><input name=<?php echo '"productQuantity' . $productId . '""'; ?> type="number" min="1" value=<?php echo $order["quantity"]; ?>></td>
                <td><input name=<?php echo '"productAisle' . $productId . '""'; ?> type="text" value="meat and poultry"></td>
                <td><input type="text" name=<?php echo '"productPrice' . $productId . '""'; ?> value=<?php echo $order["price"]; ?>></td>
                <td>
                  <div class="totalPrice"></div>
                </td>
              </tr>
            <?php endif; ?>

            <?php if ($order["aisle"] == "dairy and eggs") : ?>

              <tr class="ProfileRest">
                <td>
                  <input name=<?php echo '"productName' . $productId . '""'; ?> id="productSearch" type="text" value=<?php echo $order["name"]; ?> readonly>
                </td>
                <td><input name=<?php echo '"productQuantity' . $productId . '""'; ?> type="number" min="1" value=<?php echo $order["quantity"]; ?>></td>
                <td><input name=<?php echo '"productAisle' . $productId . '""'; ?> type="text" value="dairy and eggs"></td>
                <td><input type="text" name=<?php echo '"productPrice' . $productId . '""'; ?> value=<?php echo $order["price"]; ?>></td>
                <td>
                  <div class="totalPrice"></div>
                </td>
              </tr>
            <?php endif; ?>
            <?php $productId++; ?>
          <?php endforeach; ?>



          <tr>
            <th class="ProfileHeader" colspan="4">Total</th>
            <td style="background-color: white;">29.00$</td>
          </tr>


        </table>
        <div class="buttonClass">
          <button type="submit" class="button" name="Save">Save</button>
          <button type="submit" class="button" name="DeleteOrder">Delete Order</button>
          <button type="submit" class="button" name="AddOrder">Add Order</button>
        </div>
      </form>


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
        <p>Page by Cedric</p>
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