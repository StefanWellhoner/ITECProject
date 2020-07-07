<?php
session_start();
include_once "includes/conn.inc.php";

function querycompiler()
{
    include "includes/conn.inc.php";
    if (isset($_GET['search'])) {
        $search = $conn->real_escape_string($_GET['search']);
    }
    if (isset($_GET['cat'])) {
        $cat = $conn->real_escape_string($_GET['cat']);
    }

    $query = "SELECT * FROM book";
    $conditions = array();

    if (!empty($search)) {
        $conditions[] = "bookTitle LIKE '%$search%'";
    }
    if (!empty($cat)) {
        $conditions[] = "categoryID='$cat'";
    }

    $sql = $query;
    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(' AND ', $conditions);
    }

    return $sql;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pearson Bookstore | Shop</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
</head>

<body>
    <div class="navbar" id="topnav">
        <a href="index.php">Pearson Bookstore</a>
        <div class="nav-right">
            <a href="index.php">Home</a>
            <a href="shop.php" class="active">Shop</a>
            <a href="about.php">About</a>
            <a href="support.php">Support</a>
            <?php
            if (isset($_SESSION['userID'])) : ?>
                <a href="javascript:void(0);" onclick="cartDropdown()">
                    <span id="cart-text" class="hidden-sm">View Cart </span> <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge">3</span>
                </a>
                <a href="includes/logout.inc.php" title="Logout"><span class="hidden-sm">Logout </span><i class="fa fa-sign-out" aria-hidden="true"></i></a>
            <?php endif; ?>

        </div>
        <a href="JavaScript:void(0)" class="icon" onclick="collapse()">
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
        <div class="header-message">
            <h1>Shop</h1>
        </div>
        <section id="search">
            <form class="row">
                <div class="form-group col-lg-4 col-md-12 col-sm-12">
                    <label for="searchBooks"><i class=" fa fa-search" aria-hidden="true"></i></label>
                    <input autofocus tabindex="1" id="searchBooks" class="form-control" type="search" placeholder="Search books" name="search" value="<?php if (isset($_GET['search'])) {echo $_GET['search'];} ?>">
                </div>
                <div class="form-group col-lg-3 col-md-6 col-sm-6">
                    <select tabindex="2" name="auth" id="auth" class="form-control">
                        <option value="">Select an Author</option>
                        <option value="author1">Author 1</option>
                    </select>
                </div>
                <div class="form-group col-lg-3 col-md-6 col-sm-6">
                    <select tabindex="3" name="cat" id="auth" class="form-control">
                        <option value="">Select a Category</option>
                        <option value="1">Category 1</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-12 col-sm-12">
                    <input tabindex="4" type="submit" class="btn btn-sm btn-100 btn-blue" value="Search" style="margin: 0;" />
                </div>
            </form>
        </section>
        <div class="row">
            <div class="col-lg-3">
                <section>
                    <h2>Your Cart: </h2>
                    <section id="cart">
                        <?php if (isset($_SESSION['userID'])) : ?>
                            <p>Your Shopping Cart is Empty</p>
                            <a class="btn btn-blue btn-100" href="viewcart.php">Checkout</a>
                        <?php else : ?>
                            <p>Login to add to cart</p>
                        <?php endif; ?>
                    </section>
                </section>
            </div>
            <div class="col-lg-9">
                <section id="search-result">
                    <h2>Result For: "<?php if (isset($_GET['search'])) {
                                            echo $_GET["search"];
                                        } ?>"</h2>
                    <div class="row">
                        <?php
                        $query = querycompiler();
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) :
                            while ($row = $result->fetch_assoc()) :

                        ?>
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="book-container">
                                        <a href="viewbook.php?id=<?php echo $row["bookID"]; ?>">
                                            <img src="<?php echo $row["bookImage"]; ?>" class="book-img" />
                                            <div class="book-info-container">
                                                <div class="book-name" title="<?php echo $row["bookTitle"]; ?>"><?php echo $row["bookTitle"]; ?></div>
                                                <p class="book-price">R <?php echo $row["bookPrice"]; ?></p>
                                        </a>
                                    </div>

                                </div>
                    </div>
            <?php endwhile;
                        else :
                            echo "<p class='col-lg-12'>No Search Results Found</p>";
                        endif;
            ?>
            </div>
            </section>
        </div>
    </div>
    <a href="#topnav" class="fab" onclick="cartDropdown()"><i class="fa fa-shopping-cart" aria-hidden="true"></i><div class="badge">3</div></a>
    </div>

</body>
<footer>
    <p class="text-center">Footer</p>
</footer>
<script src="js/scripts.js"></script>

</html>