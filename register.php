<?php
session_start();
if(isset($_SESSION['userID'])){
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
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap-grid.min.css">
</head>

<body>
  <div class="navbar" id="topnav">
    <a href="index.php">Pearson Bookstore</a>
    <div class="nav-right">
      <a href="index.php">Home</a>
      <a href="shop.php">Shop</a>
      <a href="about.php">About</a>
      <a href="support.php">Support</a>
    </div>
    <a href="javascript:void(0);" class="icon" onclick="collapse()">
      <i class="fa fa-bars"></i>
    </a>

  </div>
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
    <form action="includes/register.inc.php" method="POST" id="register-form" class="row">
      <h3 class="col-lg-12">Login Information</h3>
      <div class="form-group col-md-12">
        <label for="regEmail">Email: </label>
        <input type="email" placeholder="Email" name="email" class="form-control" />
      </div>
      <div class="form-group col-md-6">
        <label for="regPassword">Password: </label>
        <input type="password" placeholder="Password" name="password" class="form-control" />
      </div>
      <div class="form-group col-md-6">
        <label for="regCPassword">Confirm Password: </label>
        <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control" />
      </div>
      <h3 class="col-lg-12">Personal Information</h3>
      <div class="form-group col-md-6">
        <label for="regFirst">Firstname: </label>
        <input type="text" placeholder="Firstname" name="firstName" class="form-control" />
      </div>
      <div class="form-group col-md-6">
        <label for="regSurname">Lastname: </label>
        <input type="text" placeholder="Lastname" name="lastname" class="form-control" />
      </div>
      <div class="form-group col-md-6">
        <label for="regNumber">Phone Number: </label>
        <input type="number" placeholder="Phone Number" name="phoneNumber" class="form-control" />
      </div>
      <div class="form-group col-md-6">
        <label for="regDOB">Date Of Birth: </label>
        <input type="date" placeholder="Date Of Birth" name="dateOfBirth" class="form-control" />
      </div>
      <h3 class="col-lg-12">Shipping Information</h3>
      <div class="form-group col-md-12">
        <label for="regAddress">Address: </label>
        <textarea type="text" placeholder="Address" name="address" rows="5"></textarea>
      </div>
      <div class="form-group col-md-12">
        <label for="regProvince">Country: </label>
        <select class="form-control" name="country">
          <option value="null">Select a Country</option>
          <option value="ZA">South Africa</option>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="regProvince">Province: </label>
        <select class="form-control" name="province">
          <option value="null">Select a Province</option>
          <option value="Eastern Cape">Eastern Cape</option>
          <option value="Western Cape">Western Cape</option>
          <option value="Northern Cape">Northern Cape</option>
          <option value="North West">North West</option>
          <option value="Gauteng">Gauteng</option>
          <option value="Limpopo">Limpopo</option>
          <option value="KwaZulu-Natal">KwaZulu-Natal</option>
          <option value="Mpumalanga">Mpumalanga</option>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="regSuburb">Suburb: </label>
        <input type="text" placeholder="Suburb" name="suburb" class="form-control" />
      </div>
      <div class="form-group col-md-4">
        <label for="regZip">Zip Code: </label>
        <input type="number" placeholder="Zip Code" name="zipcode" class="form-control" />
      </div>
      <div class="col-lg-12">
        <button type="submit" class="btn btn-green btn-100" name="register-submit">Register</button>
      </div>
    </form>
  </div>
</body>
<?php include "footer.php" ?>
<script src="js/scripts.js"></script>

</html>