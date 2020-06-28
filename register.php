<?php
include_once "conn.php";

$query = "INSERT INTO `user`(email, `password`,firstname,lastname,phoneNumber,dateOfBirth) VALUES (?,?,?,?,?,?)";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pearson Bookstore | Support</title>
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
      <a onclick="cartDropdown()">
        <span id="cart-text">Cart</span> <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge">3</span>
      </a>
    </div>
    <a href="javascript:void(0);" class="icon" onclick="collapse()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
  <!-- Shopping cart start -->
  <!-- Shopping cart end -->
  <div class="container">
    <div class="header-message">
      <h1>Register</h1>
    </div>
      <form method="POST" class="row">
        <h3 class="col-lg-12">Login Information</h3>
        <div class="form-group col-md-12">
          <label for="regEmail">Email: </label>
          <input type="email" placeholder="Email" id="regEmail" class="form-control" />
        </div>
        <div class="form-group col-md-6">
          <label for="regPassword">Password: </label>
          <input type="password" placeholder="Password" id="regPassword" class="form-control" />
        </div>
        <div class="form-group col-md-6">
          <label for="regCPassword">Confirm Password: </label>
          <input type="password" placeholder="Confirm Password" id="regCPassword" class="form-control" />
        </div>
        <h3 class="col-lg-12">Personal Information</h3>
        <div class="form-group col-md-12">
          <label for="regFirst">Firstname: </label>
          <input type="text" placeholder="Firstname" id="regFirst" class="form-control" />
        </div>
        <div class="form-group col-md-12">
          <label for="regSurname">Surname: </label>
          <input type="text" placeholder="Surname" id="regSurname" class="form-control" />
        </div>
        <div class="form-group col-md-6">
          <label for="regNumber">Phone Number: </label>
          <input type="number" placeholder="Phone Number" id="regNumber" class="form-control" />
        </div>
        <div class="form-group col-md-6">
          <label for="regDOB">Date Of Birth: </label>
          <input type="date" placeholder="Date Of Birth" id="regDOB" class="form-control"/>
        </div>
        <h3 class="col-lg-12">Shipping Information</h3>
        <div class="form-group col-md-12">
          <label for="regAddress">Address: </label>
          <textarea type="text" placeholder="Address" id="regAddress" rows="5"></textarea>
        </div>
        <div class="form-group col-md-12">
          <label for="regProvince">Country: </label>
          <select class="form-control" id="regProvince">
            <option value="null">Select a Country</option>
            <option value="ZA">South Africa</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label for="regProvince">Province: </label>
          <select class="form-control" id="regProvince">
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
          <input type="text" placeholder="Suburb" class="form-control" id="regSuburb"/>
        </div>      
        <div class="form-group col-md-4">
          <label for="regZip">Zip Code: </label>
          <input type="number" placeholder="Zip Code" class="form-control" id="regZip"/>
        </div>
        <div class="col-lg-12">
          <input type="submit" value="Register" class="btn btn-green btn-100" />
        </div>
      </form>
  </div>
</body>
<footer>
  <p class="text-center">Stefan Wellhoner &copy; 2020</p>
</footer>
<script src="js/scripts.js"></script>
</html>