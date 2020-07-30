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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="./css/components.css">
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
        <div class="row">
            <div class="col-12">
                <?php
                $userID = $_SESSION['userID'];
                $sql = "SELECT book.bookID, book.bookTitle, book.bookPrice, book.bookImage, cart_item.cartID, cart_item.item_quantity, cart.cartID, cart.cartTotal
             FROM book
             INNER JOIN cart_item
             ON book.bookID = cart_item.bookID
             INNER JOIN cart
             ON cart_item.cartID = cart.cartID
             WHERE cart.userID = $userID";
             $counter = 0;
                if ($result = mysqli_query($conn, $sql)) :
                    while ($row = mysqli_fetch_array($result)) :
                        echo ++$counter."<br>"; 
                        echo "Title: " . $row['bookTitle'] . "<br>";
                        echo "Price: " . $row['bookPrice'] . "<br>";
                        echo "Quantity: " . $row['item_quantity'] . "<br>";
                        echo "Total: " . ($row['item_quantity'] * $row['bookPrice']) . "<br><br>";
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</body>
<?php include "footer.php" ?>

</html>