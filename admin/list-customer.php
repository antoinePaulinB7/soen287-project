<!DOCTYPE html>
<!--p11-->
<html long="en">

<head>
  <Title>Order Page</Title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="../styles/base.css">
  <link rel="stylesheet" href="../styles/list-user.css">
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
      <a href="../admin/edit-customer.php">Edit Customer</a>
      <a href="../admin/edit-order.html">Edit Order</a>
      <a href="../admin/list-customer.php">List Customer</a>
      <a href="../admin/list-order.html">List Order</a>
      <a href="../admin/list-product.php">List Product</a>
    </div>
  </nav>

  <main class="container">
    <form class="list-user-form" action="/user">
      <h1>Users</h1>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <th>Name</th>
            <th>Address</th>
            <th>Actions</th>
          </thead>
          <?php
          $userInfo = json_decode(file_get_contents("../soen287-project/userlist.JSON", "userlist.JSON"),true);
          $i = 0;
          //echo $userInfo[$i]["firstname"];
          while(isset($userInfo[$i]))
          {
              echo "<tr>";
              echo "<td>". $userInfo[strval($i)]["firstname"] ."</td>";
              echo "<td>". $userInfo[strval($i)]["streetaddress"] ."</td>";
              echo "<td>". "<a class=\"button\" href=\"../admin/edit-customer.php?action=edit&id=".strval($i)."\">Edit User</a>" ."</td>";
              echo "<td>". "<a class=\"button\" href=\"../admin/list-customer.php?action=delete&id=".strval($i)."\">Delete User</a>" ."</td>"; 
              echo "</tr>";
              $i++;
          }
          ?>
        </table>
      </div>
      <div class="list-user-footer">
        <a class="button" href="../admin/edit-customer.php?action=add">Add user</a>
      </div>
    </form>
  </main>
  <?php
    if(isset($_GET['action'])){
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        unset($userInfo[$id]); 
        $userInfo = array_values($userInfo);
        file_put_contents("../soen287-project/userlist.JSON", json_encode($userInfo));
      }
    }
  ?>
  <footer>
    <div class="footer">      
      <div class="contact">
        <h2>Contact Us:</h2>
        <p>Telephone: 123-456-7890</p>
        <p>Email: TheBestestWebstore@gmail.com</p>
        <p>Twitter: @TheBestest</p>
        <p>Facebook: @TheBestestCa</p>
        <p>Page by Antoine</p>
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