<?php
session_start();
require 'includes/contact.inc.php';
$count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pearson Bookstore | Support</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="./css/components.css">
</head>

<body>
    <div class="wrapper">
        <nav class="navbar" id="topnav">
            <a href="index.php">Pearson Bookstore</a>
            <div class="nav-right">
                <a href="index.php">Home</a>
                <a href="shop.php">Shop</a>
                <a href="about.php">About</a>
                <a href="support.php" class="active">Support</a>
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
        <div class="push"></div>
    </div>
</body>
<script src="js/scripts.js"></script>
<?php include 'footer.php' ?>

</html>