<!DOCTYPE html>
<html>
  <head>
    <title>Product List</title>
    <link rel="stylesheet" href="../styles/base.css" />
    <link rel="stylesheet" href="../styles/list-product.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
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
        <a href="../admin/edit-order.html">Edit Order</a>
        <a href="../admin/list-customer.php">List Customer</a>
        <a href="../admin/list-order.html">List Order</a>
        <a href="../admin/list-product.php">List Product</a>
      </div>
    </nav>

    <main>
      <div class="container">
        <h3 class="title">Product List</h3>
        <form>
          <div style="flex-direction: column; display: flex; margin:auto; width: 80%;">
            <div class="table-responsive">
              <table
                class="table"
                BORDER="1"
                cellpadding="4"
                cellspacing="3"
              >
                <thead>
                <tr style="text-align: center">
                    <th></th>
                    <th>Product</th>
                    <th>Inventory</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
                </thead>
                  <tbody>

                  <?php 
                    $products = json_decode(file_get_contents("../all-products.json"), true);
                    $i = 0;
                    while(isset($products[$i]))
                    {
                      echo "<tr ALIGN='CENTER'>";
                      echo "<td class='product'>";
                      echo "<img src='". $products[strval($i)]["image"] ."' alt='". $products[strval($i)]["name"] ."'/></td>";
                      echo "<td>". $products[strval($i)]["name"] ."</td>";
                      echo "<td>". $products[strval($i)]["inventory"] ."</td>";
                      echo "<td>". $products[strval($i)]["aisle"] ."</td>";
                      echo "<td>". $products[strval($i)]["price"] ."$ /kg</td>";
                      echo "<td>";
                      echo "<a class='btnactions' href='edit-product.php?action=edit&index=".strval($i)."' id='edit'> Edit</a>";
                      echo "<a class='btnactions' href='delete-product.php?index=".strval($i)."' id='delete'>Delete</a>";
                      echo "</td>";
                      echo "</tr>";
                      $i++;
                    }
                  ?>
                  </tbody>
              </table>
            </div>
            <div class="addbtn" style="padding-top: 20px; padding-bottom: 20px;">
                <a class="btnadd" href="edit-product.php?action=add">Add Product</a>
            </div>
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
