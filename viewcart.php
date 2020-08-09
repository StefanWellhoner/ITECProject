<?php
session_start();
include "includes/conn.inc.php";
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
    <title>Pearson Bookstore | View Cart</title>
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
            <a href="about.php">About</a>
            <a href="support.php">Support</a>
            <?php if (!isset($_SESSION['userID'])) : ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['userID'])) : ?>
                <a href="javascript:void(0);" class="active">
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
        <div class="header-message">
            <h1>View Cart</h1>
        </div>
        <table>
            <tr>
                <th>Title</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <?php
            $total = 0;
            $count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
            for ($i = 0; $i < $count; $i++) {
                $cartItem = $_SESSION['cart'][$i];
                echo '<tr>';
                echo '<td><a href=viewbook.php?id=' . $cartItem['bookID'] . '>' . $cartItem["bookTitle"] . '</a></td>';
                echo '<td>R' . $cartItem["bookPrice"] . '</td>';
                echo '<td>' . $cartItem["quantity"] . '</td>';
                echo '<td>R' . ($cartItem["quantity"] * $cartItem['bookPrice']) . '</td>';
                echo '</tr>';
                $total += ($cartItem["quantity"] * $cartItem['bookPrice']);
            }
            echo '<tr><td colspan="2">Grand Total: ' . $total . '</td><td colspan="2"><a class="btn btn-black btn-sm">Order Items</a></td></tr>';
            ?>
        </table>
    </div>
</body>
<?php include "footer.php" ?>

</html>