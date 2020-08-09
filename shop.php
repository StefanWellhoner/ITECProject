<?php
session_start();
include_once "includes/conn.inc.php";
include_once "includes/book_container.php";

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
$count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pearson Bookstore | Shop</title>
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
            <a href="shop.php" class="active">Shop</a>
            <a href="about.php">About</a>
            <a href="support.php">Support</a>
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
            <h1>Shop</h1>
        </div>
        <section id="search">
            <form class="row">
                <div class="form-group col-lg-4 col-md-12 col-sm-12">
                    <label for="searchBooks"><i class=" fa fa-search" aria-hidden="true"></i></label>
                    <input autofocus tabindex="1" id="searchBooks" class="form-control" type="search" placeholder="Search books" name="search" value="<?php echo (isset($_GET['search'])) ? $_GET['search'] : "" ?>">
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
                        <?php
                        $sql = "SELECT * FROM category";
                        if ($result = mysqli_query($conn, $sql)) :
                            while ($row = mysqli_fetch_array($result)) : ?>
                                <option value="<?php echo $row['categoryID'] ?>" <?php echo ($row['categoryID'] == $_GET['cat']) ? "selected" : "" ?>><?php echo $row['cat_name'] ?></option>
                        <?php endwhile;
                        endif;
                        ?>
                    </select>
                </div>
                <div class="col-lg-2 col-md-12 col-sm-12">
                    <input tabindex="4" type="submit" class="btn btn-sm btn-100 btn-blue" value="Search" style="margin: 0;" />
                </div>
            </form>
        </section>
        <div class="row">
            <div class="col-lg-9">
                <section id="search-result">
                    <h4>Result For: "<?php echo isset($_GET['search']) ? $_GET["search"] : "" ?>"</h4>
                    <div class="row">
                        <?php
                        $query = querycompiler();
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) :
                            while ($row = $result->fetch_assoc()) :
                                echo component4($row['bookID'], $row['bookTitle'], $row['bookImage'], $row['bookPrice']);
                            endwhile;
                        else :
                            echo "<p class='col-lg-12'>No Search Results Found</p>";
                        endif;
                        ?>
                    </div>
                </section>
            </div>
            <div class="col-lg-3">
                <section>
                    <h4>Your Cart: </h4>
                    <section id="cart">
                        <?php if (isset($_SESSION['userID'])) : ?>
                            <p>Your Shopping Cart is Empty</p>
                            <a class="btn btn-blue btn-100" href="viewcart.php">Checkout</a>
                        <?php else : ?>
                            <p><a href="login.php" class="author-link">Login</a> to add to cart</p>
                        <?php endif; ?>
                    </section>
                </section>
            </div>
        </div>
    </div>
    <?php if (isset($_SESSION['userID'])) : ?>
        <a href="#topnav" class="fab" onclick="cartDropdown()"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <div class="badge"><?= $count ?></div>
        </a>
    <?php endif; ?>
</body>
<?php include 'footer.php' ?>
<script src="js/scripts.js"></script>

</html>