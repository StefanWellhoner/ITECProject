<?php
session_start();
if (!isset($_SESSION['userID'])) {
  header('Location: index.php');
}
include_once "includes/conn.inc.php";
$resultMsg = "";
if (isset($_POST['delete-submit'])) {
  $userID = $_SESSION['userID'];
  $locationID = $_POST['id'];
  $sql = "DELETE FROM `location` WHERE userID = ? AND `locationID` = ?";
  $stmt = mysqli_stmt_init($conn);
  if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "ii", $userID, $locationID);
    $result = mysqli_stmt_execute($stmt);
    if ($result) {
      echo '<script>window.location = "viewprofile.php"</script>';
    } else {
      $resultMsg = "Failed to remove address";
    }
  }
}
$count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pearson Bookstore | View Profile</title>
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
          <a href="viewprofile.php" class="active" title="View Profile" id="user-profile"><span class="hidden-sm">Profile </span><i class="fa fa-user" aria-hidden="true"></i></a>
          <a href="includes/logout.inc.php" title="Logout"><span class="hidden-sm">Logout </span><i class="fa fa-sign-out" aria-hidden="true"></i></a>
        <?php endif; ?>
      </div>
      <a href="JavaScript:void(0)" class="icon" onclick="collapse()">
        <i class="fa fa-bars"></i>
      </a>
    </nav>
    <?php if (isset($_SESSION['userID'])) : ?>
      <?php require_once "includes/shopping_cart_popup.inc.php" ?>
    <?php endif; ?>
    <div class="container">
      <div class="header-message">
        <h1>View Profile</h1>
      </div>
      <div id="error-msg">
        <?php
        if (isset($_GET["error"])) {
          echo '<div class="error-msg" id="message">';
          if ($_GET["error"] == "emptyfields") {
            echo 'Fill in all fields!';
          } else if ($_GET["error"] == "invalidname") {
            echo 'Invalid First Name';
          } else if ($_GET["error"] == "invalidlast") {
            echo 'Invalid Last Name';
          } else if ($_GET["error"] == "invalidnum") {
            echo 'Invalid Phone Number';
          }
          echo '</div>';
        } else if (isset($_GET['update'])) {
          echo '<p class="success-msg" id="message">Updated Successful</p>';
        }
        ?>
      </div>
      <h4>Personal Information</h4>
      <form action="includes/update_profile.inc.php" method="POST" id="update-form" onsubmit="validateInputs();">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label for="email">Email: </label>
              <input type="email" name="email" disabled id="email" value="<?php echo $_SESSION['email'] ?>" class="form-control">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label for="firstname">First Name: </label>
              <input type="text" name="firstname" disabled id="firstname" value="<?php echo $_SESSION['firstname'] ?>" class="form-control">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label for="lastname">Last Name: </label>
              <input type="text" name="lastname" disabled id="lastname" value="<?php echo $_SESSION['lastname'] ?>" class="form-control">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label for="number">Phone Number: </label>
              <input type="text" name="number" disabled id="number" value="<?php echo $_SESSION['phoneNumber'] ?>" class="form-control">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label for="dob">Date of Birth: </label>
              <input type="date" name="dob" disabled id="dob" value="<?php echo $_SESSION['dateOfBirth'] ?>" class="form-control">
            </div>
          </div>
        </div>
        <div class="text-center">
          <button type="submit" name="submit-update" class="btn btn-green btn-sm btn-50 hide" id="submit">Save Changes</button>
          <a id="editprofile" class="btn btn-black btn-sm btn-50" onclick="editProfile()">Edit Profile</a>
          <a href="changepassword.php" class="btn btn-black btn-sm btn-50">Change Password</a>
        </div>
      </form>
      <h4>Address <a href="address.php" style="font-size: 0.75em; color: #333;"><i class="fa fa-plus-circle"></i></a></h4>
      <?php if ($resultMsg !== "") : ?>
        <div class="error-msg" id="result-msg">
          <?php echo $resultMsg; ?>
        </div>
      <?php endif; ?>
      <?php
      $userID = $_SESSION['userID'];
      $query = "SELECT * FROM `location` WHERE userID = $userID;";
      if ($result = mysqli_query($conn, $query)) :
        while ($row = mysqli_fetch_array($result)) :
      ?>
          <div class="address-container">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" class="row" method="POST">
              <input type="hidden" name="id" value="<?php echo $row['locationID'] ?>">
              <p class="col-lg-11 col-10"><?php echo $row['address'] . ", " . $row['suburb'] . ", " . $row['province'] . ", " . $row['zipcode'] . ", ", $row['country'] ?></p>
              <span class="col-lg-1 col-2">
                <button class="delete-address" type="submit" name="delete-submit" title="Delete"><i class="fa fa-trash"></i></button>
              </span>
            </form>
          </div>
      <?php endwhile;
      endif;
      ?>
      <h4>Order History</h4>
      <div class="table-responsive">
        <table>
          <tr>
            <th>Order Number</th>
            <th>Status</th>
            <th>Grand Total</th>
            <th>Order Date</th>
          </tr>
          <?php
          $orderQuery = "SELECT * FROM `order` WHERE userID = $userID ORDER BY `orderDate` DESC;";
          if ($result = mysqli_query($conn, $orderQuery)) :
            while ($row = mysqli_fetch_array($result)) :
          ?>
              <tr>
                <td><?= $row['orderID'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>R<?= $row['grandTotal'] ?></td>
                <td><?= $row['orderDate'] ?></td>
              </tr>
          <?php endwhile;
          endif;
          ?>
        </table>
      </div>
    </div>
    <div class="push"></div>
  </div>
</body>
<?php include "footer.php" ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script>
  //When the page has loaded.
  $(document).ready(function() {
    $('#result-msg').fadeIn('slow', function() {
      $('#result-msg').delay(3000).fadeOut();
    });
  });
  $(document).ready(function() {
    $('#message').fadeIn('slow', function() {
      $('#message').delay(3000).fadeOut();
    });
  });
</script>

</html>