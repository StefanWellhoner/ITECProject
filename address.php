<?php
session_start();
require 'includes/address.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pearson Bookstore | Address</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/components.css">
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
                <a href="includes/logout.inc.php" title="Logout"><span class="hidden-sm">Logout </span><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                <a href="viewprofile.php" title="View Profile" id="user-profile" class="active"><span class="hidden-sm">Profile </span><i class="fa fa-user" aria-hidden="true"></i></a>
            <?php endif; ?>
        </div>
        <a href="JavaScript:void(0)" class="icon" onclick="collapse()">
            <i class="fa fa-bars"></i>
        </a>

    </div>
    <?php
    if (isset($_SESSION['userID'])) : ?>
        <!-- Shopping cart start -->
        <div class="shopping-cart hide" id="modal-cart">
            <div class="shopping-cart-header">
                Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge">3</span>
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
        <div class="header-message">
            <h1>Address</h1>
        </div>
        <?php if (isset($_GET['address']) != "") : ?>
            <div class="success-msg">
                <p><?php echo $_GET['address'] ?></p>
            </div>
        <?php endif; ?>
        <form action="includes/address.inc.php" method="POST">
            <div class="form-group">
                <label for="">Address line: </label>
                <input type="text" placeholder="Address" name="address" class="form-control" />
            </div>
            <div class="form-group">
                <label for="">Suburb: </label>
                <input type="text" placeholder="Suburb" name="suburb" class="form-control" />
            </div>
            <div class="form-group">
                <label for="country">Country: </label>
                <select class="form-control" name="country">
                    <option value="South Africa">South Africa</option>
                </select>
            </div>
            <div class="form-group">
                <label for="province">Province: </label>
                <select class="form-control" name="province">
                    <option value="Western Cape">Western Cape</option>
                    <option value="Eastern Cape">Eastern Cape</option>
                    <option value="Freestate">Freestate</option>
                    <option value="Gauteng">Gauteng</option>
                    <option value="KwaZulu-Natal">KwaZulu-Natal</option>
                    <option value="Limpopo">Limpopo</option>
                    <option value="Northern Cape">Northern Cape</option>
                    <option value="North West">North West</option>
                    <option value="Mpumalanga">Mpumalanga</option>
                </select>
            </div>
            <div class="form-group">
                <label for="zipcode">Zipcode: </label>
                <input type="number" placeholder="Zipcode" name="zipcode" class="form-control" />
            </div>
            <button type="submit" class="btn btn-blue btn-100" name="address-submit">Add Address</button>
        </form>
    </div>
</body>
<?php include "footer.php" ?>
<script src="js/scripts.js"></script>

</html>