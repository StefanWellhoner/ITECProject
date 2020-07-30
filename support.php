<?php
session_start();
require 'includes/contact.inc.php';
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
    <link rel="stylesheet" href="./css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="./css/components.css">
</head>

<body>
    <div class="navbar" id="topnav">
        <a href="index.php">Pearson Bookstore</a>
        <div class="nav-right">
            <a href="index.php">Home</a>
            <a href="shop.php">Shop</a>
            <a href="about.php">About</a>
            <a href="support.php" class="active">Support</a>
            <?php if (isset($_SESSION['userID'])) : ?>
                <a href="javascript:void(0);" onclick="cartDropdown()">
                    <span class="hidden-sm">View Cart </span> <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge">3</span>
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
            <h1>Support Form</h1>
        </div>
        <?php if (isset($resultMsg) != "") : ?>
            <div class="<?php echo $resultClass ?>">
                <p><?php echo $resultMsg ?></p>
            </div>
        <?php endif; ?>
        <form id="support-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="name">Name: </label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo isset($_POST['name']) ? $name : ''; ?>" />
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>" />
            </div>
            <div class="form-group">
                <label for="message">Message: </label>
                <textarea rows="10" name="message" placeholder="Type your message here..."><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-blue btn-100">Send Message</button>
        </form>
    </div>
</body>
<footer>
    <p class="text-center">Stefan Wellhoner &copy; 2020</p>
</footer>
<script src="js/scripts.js"></script>

</html>