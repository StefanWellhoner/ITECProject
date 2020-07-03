<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pearson Bookstore | About</title>
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
            <a href="about.php" class="active">About</a>
            <a href="support.php">Support</a>
            <?php
            if (isset($_SESSION['userID'])) : ?>
                <a href="javascript:void(0);" onclick="cartDropdown()">
                    <span id="cart-text">View Cart </span> <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge">3</span>
                </a>

                <a href="includes/logout.inc.php">Logout</a>
            <?php endif; ?>

        </div>
        <a href="javascript:void(0);" class="icon" onclick="collapse()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <!-- Shopping cart start -->
    <div class="shopping-cart hide" id="modal-cart">
        <div class="shopping-cart-header">
            Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge">3</span>
            <span class="shopping-cart-total">Total: <span class="money-text"> R 3000</span></span>
        </div>
        <ul class="shopping-cart-items">
            <li class="clearfix">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item1.jpg" alt="item1" />
                <span class="item-name">Introduction to Programming</span>
                <span class="item-price">R100</span>
                <span class="item-quantity"> Quantity: 10</span>
            </li>
        </ul>
        <a class="btn btn-100 primary">Checkout</a>
    </div>
    <!-- Shopping cart end -->
    <div class="container">
        <div class="header-message">
            <h1>About</h1>
        </div>
    </div>
</body>
<?php include "footer.php" ?>
<script src="js/scripts.js"></script>

</html>