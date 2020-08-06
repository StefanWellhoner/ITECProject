<?php
session_start();
include_once "includes/conn.inc.php";
include_once "includes/book_container.php";

$sql = "SELECT bookID FROM `cart_item` WHERE cartID = 1";
if($result = mysqli_query($conn, $sql)){
    $cart = mysqli_num_rows($result);    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pearson Bookstore | Home Page</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="./css/components.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar" id="topnav">
        <a href="index.php">Pearson Bookstore</a>
        <div class="nav-right">
            <a href="index.php" class="active">Home</a>
            <a href="shop.php">Shop</a>
            <a href="about.php">About</a>
            <a href="support.php">Support</a>
            <?php if (!isset($_SESSION['userID'])) : ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['userID'])) : ?>
                <a href="javascript:void(0);" onclick="cartDropdown()">
                    <span id="cart-text" class="hidden-sm">View Cart </span> <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge"><?php echo $cart; ?></span>
                </a>
                <a href="viewprofile.php" title="View Profile" id="user-profile"><span class="hidden-sm">Profile </span><i class="fa fa-user" aria-hidden="true"></i></a>
                <a href="includes/logout.inc.php" title="Logout"><span class="hidden-sm">Logout </span><i class="fa fa-sign-out" aria-hidden="true"></i></a>
            <?php endif; ?>
        </div>
        <a href="JavaScript:void(0)" class="icon" onclick="collapse()">
            <i class="fa fa-bars"></i>
        </a>
    </nav>

    <?php if (isset($_SESSION['userID'])) : ?>
        <!-- Shopping cart start -->
        <div class="shopping-cart hide" id="modal-cart">
            <div class="shopping-cart-header">
                Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge"><?php echo $cart; ?></span>
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
            <a href="viewcart.php" class="btn btn-sm btn-green btn-100">Checkout</a>
        </div>
        <!-- Shopping cart end -->
    <?php endif; ?>

    <div class="container">
        <div class="header-message text-center">
            <h1>Welcome to <br> Pearson Bookstore</h1>
        </div>
        <?php
        if (isset($_GET['login'])) {
            echo "<script>
                    $(document).ready(function() {
                        $('#login-msg').fadeIn('slow', function() {
                        $('#login-msg').delay(3000).fadeOut();
                        });
                    });
                    </script>";
            echo '<p class="success-msg" id="login-msg">Login Successfull</p>';
        }
        ?>
        <h4>Current Bestsellers</h4>
        <div class="row">
            <?php
            $query = "SELECT * FROM `book` LIMIT 4;";
            if ($result = mysqli_query($conn, $query)) :
                while ($row = mysqli_fetch_array($result)) :
                    echo component3($row['bookID'], $row['bookTitle'], $row['bookImage'], $row['bookPrice']);
                endwhile;
            endif; ?>
        </div>
    </div>
    
</body>
<?php include "footer.php" ?>
<script src="js/scripts.js"></script>

</html>