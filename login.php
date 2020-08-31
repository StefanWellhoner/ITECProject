<?php
session_start();
if (isset($_SESSION['userID'])) {
    header('Location: index.php');
}
include_once "includes/conn.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pearson Bookstore | Login</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
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
                <a href="support.php">Support</a>
                <?php if (!isset($_SESSION['userID'])) : ?>
                    <a href="login.php" class="active">Login</a>
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
        <div class="container">
            <form action="includes/login.inc.php" method="post" id="login-form">
                <h4 class="text-center">Login</h4>
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyfields") {
                        echo '<p class="error-msg">Fill in all fields!</p>';
                    } else if ($_GET["error"] == "wrongdetails") {
                        echo '<p class="error-msg">Wrong username or password!</p>';
                    } else if ($_GET["error"] == "sqlerror") {
                        echo '<p class="error-msg">Error 503, please try again later!</p>';
                    }
                }
                ?>
                <div class="form-group">
                    <label for="loginEmail">Email: </label>
                    <input type="email" placeholder="Email" name="email" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="loginPassword">Password: </label>
                    <input type="password" placeholder="Password" name="password" class="form-control" />
                </div>
                <input type="hidden" name="redirect" value="<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : "" ?>">
                <button type="submit" class="btn btn-blue btn-100" name="login-submit">Login</button>
                <a href="register.php" class="btn btn-green btn-100">Register</a>
            </form>
        </div>
        <div class="push"></div>
    </div>
</body>
<?php include "footer.php" ?>
<script src="js/scripts.js"></script>

</html>