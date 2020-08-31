<?php
session_start();
include "includes/conn.inc.php";
if (!isset($_SESSION['userID'])) {
    header('Location: index.php');
}
$count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if ($count == 0) {
    header('Location: shop.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pearson Bookstore | Order Books</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="./css/components.css">
    <script src="js/scripts.js"></script>
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
                    <a href="javascript:void(0);">
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
            <form action="includes/completeorder.inc.php" method="post">
                <div class="header-message text-center">
                    <h1>Finalise Order</h1>
                </div>
                <?php
                if (isset($_GET['error'])) {
                    echo '<div class="error-msg">';
                    if ($_GET['error'] == 'sqlerror') {
                        echo 'An Error Occurred';
                    }
                    echo '</div>';
                }
                ?>
                <h5>Order Details</h5>
                <?php
                $total = 0;
                if (isset($_SESSION['cart'])) :
                    echo '<table class="table-responsive"><tr>';
                    echo '<th>Title</th>';
                    echo '<th>Quantity</th>';
                    echo '<th>Price</th>';
                    for ($i = 0; $i < $count; $i++) {
                        echo '<tr><td>';
                        echo $_SESSION['cart'][$i]['bookTitle'];
                        echo '</td><td>';
                        echo $_SESSION['cart'][$i]['quantity'];
                        echo '</td><td>R';
                        echo $_SESSION['cart'][$i]['bookPrice'];
                        echo '</td></tr>';
                        $total = $total + ($_SESSION['cart'][$i]['bookPrice'] * $_SESSION['cart'][$i]['quantity']);
                    }
                    echo '<tr><td colspan="4">Grand Total: R' . $total . '</td>';
                    echo '</table>';
                endif;
                ?>
                <input type="hidden" name="total" value="<?= $total ?>">
                <br>
                <h5>Select Delivery Address</h5>
                <?php
                $userID = $_SESSION['userID'];
                $query = "SELECT * FROM `location` WHERE userID = $userID;";
                if ($result = mysqli_query($conn, $query)) :
                    while ($row = mysqli_fetch_array($result)) :
                ?>
                        <div class="address-container">
                            <input type="radio" name="address" value="<?php echo $row['locationID'] ?>" id="<?php echo $row['locationID'] ?>">
                            <label for="<?php echo $row['locationID'] ?>"><?php echo $row['address'] . ", " . $row['suburb'] . ", " . $row['province'] . ", " . $row['zipcode'] . ", ", $row['country'] ?></label>
                        </div>
                <?php endwhile;
                endif;
                ?>
                <br>
                <h5>Payment method</h5>
                <input type="radio" name="payment" id="cash" checked>
                <label for="cash">Cash</label>
                <input type="radio" name="payment" id="credit" disabled>
                <label for="credit">Credit/Debit</label>
                <br>
                <br>
                <button class="btn btn-green" name="order-submit">Complete Order</button>
            </form>
        </div>
        <div class="push"></div>
    </div>
</body>
<?php include 'footer.php' ?>

</html>