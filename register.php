<?php
session_start();
if (isset($_SESSION['userID'])) {
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en-ZA">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pearson Bookstore | Register</title>
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="./css/components.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <script src="js/validation.js"></script>

</head>

<body>
  <div class="wrapper">
    <nav class="navbar" id="topnav">
      <a href="index.php">Pearson Bookstore</a>
      <div class="nav-right">
        <a href="index.php">Home</a>
        <a href="shop.php">Shop</a>
        <a href="about.php">About</a>
        <a href="support.php">Support</a>
        <?php if (!isset($_SESSION['userID'])) : ?>
          <a href="login.php">Login</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['userID'])) : ?>
          <a href="javascript:void(0);" onclick="cartDropdown()">
            <span id="cart-text" class="hidden-sm">View Cart </span> <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge"><?php echo $count; ?></span>
          </a>
          <a href="viewprofile.php" title="View Profile" id="user-profile"><span class="hidden-sm">Profile </span><i class="fa fa-user" aria-hidden="true"></i></a>
          <a href="includes/logout.inc.php" title="Logout"><span class="hidden-sm">Logout </span><i class="fa fa-sign-out" aria-hidden="true"></i></a>
        <?php endif; ?>
      </div>
      <a href="JavaScript:void(0)" class="icon" onclick="collapse()">
        <i class="fa fa-bars"></i>
      </a>
    </nav>
    <!-- Shopping cart start -->
    <div class="shopping-cart hide" id="modal-cart">
      <div class="shopping-cart-header">
        Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge">3</span>
        <span class="shopping-cart-total">Total: <span class="money-text">R 100</span></span>
      </div>
      <ul class="shopping-cart-items">
        <li class="clearfix">
          <img src="assets/Pearson Bookstore Black.png" alt="item1" />
          <span class="item-name" title="Introduction to Programming">Introduction to Programming</span>
          <span class="item-price">R100</span>
          <span class="item-quantity">Quantity: 1</span>
        </li>
      </ul>
      <a href="viewcart.php" class="btn btn-sm btn-blue btn-100">Checkout</a>
    </div>
    <!-- Shopping cart end -->
    <div class="container">
      <div class="header-message">
        <h1>Register</h1>
      </div>
      <div id="error-msg" class="<?php echo (isset($_GET['error']) ? 'error-msg' : '') ?>">
        <?php if (isset($_GET['error'])) : ?>
          <?php if ($_GET['error'] == "emailreg") : ?>
            <?php echo 'Email is already registered. Try logging in: <a href="login.php" class="bold underlined">Go to Login</a>' ?>
          <?php endif; ?>
        <?php endif; ?>
      </div>
      <form action="includes/register.inc.php" method="POST" id="register-form" onsubmit="validateInputs();" class="row">
        <h4 class="col-lg-12">Login Information</h4>
        <div class="form-group col-md-12">
          <label for="regEmail">Email: </label>
          <input type="email" placeholder="Email" name="email" id="email" class="form-control" value="<?php echo (isset($_GET['email'])) ? $_GET['email'] : '' ?>" />
        </div>
        <div class="form-group col-md-6">
          <label for="regPassword">Password: </label>
          <input type="password" placeholder="Password" name="password" id="password" class="form-control" />
        </div>
        <div class="form-group col-md-6">
          <label for="regCPassword">Confirm Password: </label>
          <input type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password" class="form-control" />
        </div>
        <h4 class="col-lg-12">Personal Information</h4>
        <div class="form-group col-md-6">
          <label for="regFirst">First Name: </label>
          <input type="text" placeholder="Firstname" name="firstName" id="firstname" class="form-control" value="<?php echo (isset($_GET['name'])) ? $_GET['name'] : '' ?>" />
        </div>
        <div class="form-group col-md-6">
          <label for="regSurname">Last Name: </label>
          <input type="text" placeholder="Lastname" name="lastname" id="lastname" class="form-control" value="<?php echo (isset($_GET['lastname'])) ? $_GET['lastname'] : '' ?>" />
        </div>
        <div class="form-group col-md-6">
          <label for="regNumber">Phone Number: </label>
          <input type="number" placeholder="Phone Number" name="phoneNumber" id="phoneNumber" class="form-control" value="<?php echo (isset($_GET['number'])) ? $_GET['number'] : '' ?>" />
        </div>
        <div class="form-group col-md-6">
          <label for="regDOB">Date Of Birth: </label>
          <input type="date" placeholder="Date Of Birth" name="dateOfBirth" id="dateOfBirth" class="form-control" value="<?php echo (isset($_GET['dob'])) ? $_GET['dob'] : '' ?>" />
        </div>
        <div class="col-lg-12">
          <button type="submit" class="btn btn-green btn-100" name="register-submit" id="register-submit">Register</button>
        </div>
      </form>
    </div>
    <div class="push"></div>
  </div>
</body>
<?php include "footer.php" ?>
<script src="js/scripts.js"></script>

</html>