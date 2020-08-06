<?php
session_start();
include "includes/conn.inc.php";
if (!isset($_SESSION['userID'])) {
    header('Location: index.php');
}
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
    <style type="text/css">
        table {
            border-collapse: collapse;
        }

        th,
        td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #DDD;
            border-top: 1px solid #DDD;
        }

        tr:nth-child(even) {
            background-color: #FFF;
        }

        tr:nth-child(odd) {
            background-color: #EFEFEF;
        }

        tr:last-child>td{
            text-align: right;
        }

        td>a {
            color: rgb(71, 128, 233);
        }
    </style>
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
                <a href="javascript:void(0);" onclick="cartDropdown()" class="active">
                    <span id="cart-text" class="hidden-sm">View Cart </span> <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge">3</span>
                </a>
                <a href="includes/logout.inc.php" title="Logout">
                    <span class="hidden-sm">Logout </span><i class="fa fa-sign-out" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
        </div>
        <a href="JavaScript:void(0)" class="icon" onclick="collapse()">
            <i class="fa fa-bars"></i>
        </a>
    </div>

    <div class="container">
        <div class="header-message">
            <h1>View Cart</h1>
        </div>
        <table style="width: 100%;">
            <tr>
                <th>Title</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <?php
            $total = 0;
            for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                $cartItem = $_SESSION['cart'][$i];
                echo '<tr>';
                echo '<td><a href=viewbook.php?id=' . $cartItem['bookID'] . '>' . $cartItem["bookTitle"] . '</a></td>';
                echo '<td>R ' . $cartItem["bookPrice"] . '</td>';
                echo '<td>' . $cartItem["quantity"] . '</td>';
                echo '<td>R ' . ($cartItem["quantity"] * $cartItem['bookPrice']) . '</td>';
                echo '</tr>';
                $total += ($cartItem["quantity"] * $cartItem['bookPrice']);
            }
            echo '<tr><td colspan="4">Grand Total: '.$total.'</td></tr>';
            ?>
        </table>
    </div>
</body>
<?php include "footer.php" ?>

</html>