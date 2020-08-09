<?php
session_start();
$count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pearson Bookstore | About</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="./css/components.css">
</head>

<body>
    <nav class="navbar" id="topnav">
        <a href="index.php">Pearson Bookstore</a>
        <div class="nav-right">
            <a href="index.php">Home</a>
            <a href="shop.php">Shop</a>
            <a href="about.php" class="active">About</a>
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
    <?php if (isset($_SESSION['userID'])) : ?>
        <!-- Shopping cart start -->
        <?php require_once "includes/shopping_cart_popup.inc.php" ?>
        <!-- Shopping cart end -->
    <?php endif; ?>
    <div class="container">
        <div class="separate-bar text-center">
            <img src="assets/Pearson Bookstore icon.png" style="height: auto; width: 100%; max-width:510px;">
        </div>
        <div class="row">
            <div id="about-us" class="col-12 col-md-6">
                <h4>About Us</h4>
                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil hic id at nesciunt velit ad atque placeat vitae voluptate non, doloremque, nostrum, illo libero iusto totam sapiente aperiam dolorum quasi.Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil hic id at nesciunt velit ad atque placeat vitae voluptate non, doloremque, nostrum, illo libero iusto totam sapiente aperiam dolorum quasi.Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil hic id at nesciunt velit ad atque placeat vitae voluptate non, doloremque, nostrum, illo libero iusto totam sapiente aperiam dolorum quasi.</p>
            </div>
            <div id="operating-hours" class="col-12 col-md-6">
                <h4>Contact Us</h4>
                <p><span class="bold">Telephone:</span> 0781726444<br><span class="bold">Email:</span> support@peasonbookstore.co.za</p>
                <span class="bold">Operating Hours:</span>
                <ul>
                    <li>Monday to Friday: 7:00am - 5:00pm</li>
                    <li>Satderday to Sunday: 8:00am - 2:00pm</li>
                    <li>Public Holidays: Closed</li>
                </ul>
            </div>
        </div>
    </div>
</body>
<?php include "footer.php" ?>
<script src="js/scripts.js"></script>

</html>