<?php
session_start();
if (!isset($_SESSION['userID'])) {
    header('Location: index.php');
}
$count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pearson Bookstore | Change Password</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="./css/components.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
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
                <h1>Change Password</h1>
            </div>
            <?php if (isset($_GET['error'])) : ?>
                <div class="error-msg" style="margin-bottom: 1rem;">
                    <?php if ($_GET['error'] == "passwordsame") : ?>
                        <?php echo 'New password cannot be the same as current' ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <form action="includes/changepassword.inc.php" method="post" id="changepass-form">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="current_pass">Current Password: </label>
                            <input type="password" name="current_pass" id="current_pass" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="new_pass">New Password: </label>
                            <input type="password" name="new_pass" id="new_pass" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="firstname">Confirm New Password: </label>
                            <input type="password" name="confirm_pass" id="confirm_pass" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <p class="hint-text">*You will be logged out once your password was changed successfully</p>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" name="changepass-submit" class="btn btn-sm btn-black">Change Password</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="push"></div>
    </div>
</body>
<script src="js/scripts.js"></script>
<?php include "footer.php" ?>

</html>