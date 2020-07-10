<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pearson Bookstore | View Profile</title>
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
      <?php
      if (isset($_SESSION['userID'])) : ?>
        <a href="javascript:void(0);" onclick="cartDropdown()">
          <span id="cart-text" class="hidden-sm">View Cart </span> <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge">3</span>
        </a>
        <a href="viewprofile.php" title="View Profile" class="active">
          <span class="hidden-sm">Profile </span> <i class="fa fa-user" aria-hidden="true"></i>
        </a>
        <a href="includes/logout.inc.php" title="Logout">
          <span class="hidden-sm">Logout </span> <i class="fa fa-sign-out" aria-hidden="true"></i>
        </a>
      <?php endif; ?>
    </div>
    <a href="JavaScript:void(0)" class="icon" onclick="collapse()">
      <i class="fa fa-bars"></i>
    </a>

  </div>
  <div class="container">
    <div class="header-message">
      <h1>View Profile</h1>
    </div>
    <form action="includes/update_profile.inc.php" method="POST">
      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <label for="">Email: </label>
            <input type="email" name="email" disabled value="<?php echo $_SESSION['email'] ?>" class="form-control">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="">Firstname: </label>
            <input type="text" name="firstname" disabled value="<?php echo $_SESSION['firstname'] ?>" class="form-control">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="">Lastname: </label>
            <input type="text" name="lastname" disabled value="<?php echo $_SESSION['lastname'] ?>" class="form-control">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="">Phone Number: </label>
            <input type="text" name="number" disabled value="<?php echo $_SESSION['phoneNumber'] ?>" class="form-control">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="">Date of Birth: </label>
            <input type="date" name="dob" disabled value="<?php echo $_SESSION['dateOfBirth'] ?>" class="form-control">
          </div>
        </div>
      </div>
      <div class="text-center">
        <button type="submit" name="submit" class="btn btn-green hide" id="submit" onclick="saveChanges()">Save Changes</button>
      </div>
    </form>
    <div class="text-center">
      <a href="#" id="editprofile" class="btn btn-black btn-sm btn-50" onclick="editProfile()">Edit Profile</a>
      <br>
      <a href="#" class="btn btn-black btn-sm btn-50">Change Password</a>
    </div>
  </div>
</body>
<?php include "footer.php" ?>
<script src="js/scripts.js"></script>

</html>