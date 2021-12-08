<!DOCTYPE html>
<!--P10(Edit a user profile page)-->
<html lang="en">

<head>
    <title>Edit User Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <script src="scripts/index.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../styles/base.css">
    <link rel="stylesheet" href="../styles/edit-customer.css">
    <meta name="author" content="TheBestest Edit Profile">
    <meta name="description" content="Edit your user profile.">
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
      <a href="../admin/edit-order.php">Edit Order</a>
      <a href="../admin/list-customer.php">List Customer</a>
      <a href="../admin/list-order.html">List Order</a>
      <a href="../admin/list-product.php">List Product</a>
    </div>
  </nav>
  <?php
    if(isset($_GET['action'])){
      $action = $_GET['action']; 
    }
    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
    }
    $json = json_decode(file_get_contents("../userlist.JSON", "userlist.JSON"),true);
  ?>
    <main>
        <div class="container">
            <div class="user-avatar">
                <img src="../images/icons8-user-50.png">
            </div>
            <form method="POST" action="">
                <div class="user-information">
                    <h3 class="user-name">TheBestest Customer</h3>
                    <h5 class="user-email">TheBestestcustomeremail@something.com</h5>
                    <br />
                    <br />
                    <br />
                </div>
                <div class="personal-details">
                    <h3 class="personal-details-title">Personal Details</h3>
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" class="form-control-up" name="firstname" <?php if(isset($id)){echo 'value = "'.$json[$id]["firstname"].'"';} ?> id="firstName" placeholder="Enter your First Name">
                        <label for="midleName">Middle Name:</label>
                        <input type="text" class="form-control" name="middlename" <?php if(isset($id)){echo 'value = "'.$json[$id]["middlename"].'"';} ?> id="firstName" placeholder="Enter your Middle Name">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" class="form-control-up" name="lastname" <?php if(isset($id)){echo 'value = "'.$json[$id]["lastname"].'"';} ?> id="lastName" placeholder="Enter your Last Name">
                        <label for="emailAddress">Email Address:</label>
                        <input type="text" class="form-control" name="emailaddress" <?php if(isset($id)){echo 'value = "'.$json[$id]["emailaddress"].'"';} ?> id="lastName" placeholder="Enter your Email Address">
                    </div>
                </div>
                <div class="address-details">
                    <h3 class="address-details-title">Address</h3>
                    <div class="form-group">
                        <label for="country">Password:</label>
                        <input type="text" class="form-control-spec" name="password" <?php if(isset($id)){echo 'value = "'.$json[$id]["password"].'"';} ?> id="lastName" placeholder="Enter your Password">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" name="city" <?php if(isset($id)){echo 'value = "'.$json[$id]["city"].'"';} ?> id="lastName" placeholder="Enter your City Name">
                    </div>
                    <div class="form-group">
                        <label for="streetAddress">Street Address:</label>
                        <input type="text" class="form-control-special" name="streetaddress" <?php if(isset($id)){echo 'value = "'.$json[$id]["streetaddress"].'"';} ?> id="lastName" placeholder="Enter your Street Address">
                        <label for="postalCode">Postal Code:</label>
                        <input type="text" class="form-control" name="postalcode" <?php if(isset($id)){echo 'value = "'.$json[$id]["postalcode"].'"';} ?> id="lastName" placeholder="Enter your Postal Code">
                    </div>
                </div>
                <div class="submit-button">                                                               
                    <input type="submit" name="submit">
                </div>
            </form>                                                                                         
        </div>                                                
    </main>
    <?php
      if($action == "add"){
        if(isset($_POST['submit'])){
          $json[strval(count($json))] = array(
            "firstname" => $_POST['firstname'], 
            "middlename" => $_POST['middlename'], 
            "lastname" => $_POST['lastname'], 
            "emailaddress" => $_POST['emailaddress'], 
            "password" => $_POST['password'], 
            "city" => $_POST['city'],
            "streetaddress" => $_POST['streetaddress'],
            "postalcode" => $_POST['postalcode']);
          file_put_contents("../userlist.JSON", json_encode($json, JSON_PRETTY_PRINT));
        }
      }
      else if($action == "edit"){
        if(isset($_POST['submit'])){
          $json[$id] = array(
            "firstname" => $_POST['firstname'], 
            "middlename" => $_POST['middlename'], 
            "lastname" => $_POST['lastname'], 
            "emailaddress" => $_POST['emailaddress'], 
            "password" => $_POST['password'], 
            "city" => $_POST['city'],
            "streetaddress" => $_POST['streetaddress'],
            "postalcode" => $_POST['postalcode']);
          file_put_contents("../userlist.JSON", json_encode($json, JSON_PRETTY_PRINT));
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
        <p>Page by Omar</p>
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