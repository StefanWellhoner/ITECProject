<?php
include_once "includes/conn.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pearson Bookstore | Home Page</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
</head>

<body>
    <div class="navbar" id="topnav">
        <a href="index.php">Pearson Bookstore</a>
        <div class="nav-right">
            <a href="index.php" class="active">Home</a>
            <a href="shop.php">Shop</a>
            <a href="about.php">About</a>
            <a href="support.php">Support</a>
            <a href="javascript:void(0);" onclick="cartDropdown()">
                <span id="cart-text">View Cart </span> <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge">3</span>
            </a>
        </div>
        <a href="javascript:void(0);" class="icon" onclick="collapse()">
            <i class="fa fa-bars"></i>
        </a>

    </div>
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
        <a href="viewcart.php" class="btn btn-sm btn-blue btn-100">Checkout</a>
    </div>
    <!-- Shopping cart end -->
    <div class="container">
        <div class="text-center">
            <h1 id="welcome-message">Welcome To</h1>
            <img src="assets/Pearson Bookstore Black.png" id="welcome-img" />
        </div>
        <!-- Login form start -->
        <form action="" method="post" id="login-form">
            <h2>Login</h2>
            <div class="form-group">
                <label for="loginEmail">Email: </label>
                <input type="email" placeholder="Email" id="loginEmail" name="loginEmail" class="form-control" />
            </div>
            <div class="form-group">
                <label for="loginPassword">Password: </label>
                <input type="password" placeholder="Password" id="loginPassword" name="loginPassword" class="form-control" />
            </div>
            <input type="submit" value="Login" class="btn btn-blue btn-100" />
            <a href="register.php" class="btn btn-green btn-100">Register</a>
        </form>
        <!-- Login form end -->
        <div class="separate-bar"></div>
        <h2>Current Bestsellers</h2>

        <div class="row">
            <?php
            $query = "SELECT * FROM `book`;";
            if ($result = mysqli_query($conn, $query)) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="book-container">
                            <a href="viewbook.php?id=<?php echo $row["bookID"]; ?>">
                                <img src="<?php echo $row["bookImage"]; ?>" class="book-img" />
                                <div class="book-info-container">
                                    <div class="book-name" title="<?php echo $row["bookTitle"]; ?>">
                                        <?php echo $row["bookTitle"]; ?>
                                    </div>
                            </a>
                            <p class="book-price">
                                R <?php echo $row["bookPrice"]; ?>
                            </p>
                            <div class="text-center">
                                <input type="button" value="Add to Cart" class="btn btn-green" />
                            </div>
                        </div>

                    </div>
        </div>
<?php } ?>
           <?php } ?>
<div class="separate-bar"></div>
    </div>
    </div>
</body>
<?php include "footer.php" ?>
<script src="js/scripts.js"></script>

</html>