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
            <a onclick="cartDropdown()">
                <span id="cart-text">Cart</span> <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge">3</span>
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
            <span class="shopping-cart-total">Total: <span class="money-text"> R 3000</span></span>
        </div>
        <ul class="shopping-cart-items">
            <li class="clearfix">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item1.jpg" alt="item1" />
                <span class="item-name">Introduction to Programming</span>
                <span class="item-price">R100</span>
                <span class="item-quantity"> Quantity: 10</span>
            </li>
        </ul>
        <a class="btn btn-100 primary" href="viewcart.php">Checkout</a>
    </div>
    <!-- Shopping cart end -->
    <div class="container">
        <section id="search">
            <form class="row">
                <div class="form-group col-lg-4 col-md-12 col-sm-12">
                    <label for="searchBooks"><i class="fa fa-search" aria-hidden="true"></i></label>
                    <input id="searchBooks" class="form-control" type="search" placeholder="Search books">
                </div>
                <div class="form-group col-lg-3 col-md-6 col-sm-6">
                    <select name="author" id="author" class="form-control">
                        <option value="null">Select an Author</option>
                        <option value="author1">Author 1</option>
                    </select>
                </div>
                <div class="form-group col-lg-3 col-md-6 col-sm-6">
                    <select name="author" id="author" class="form-control">
                        <option value="null">Select a Category</option>
                        <option value="author1">Category 1</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-12 col-sm-12">
                    <input type="submit" class="btn btn-sm btn-100 btn-blue" value="Search" style="margin: 0;"/>
                </div>
            </form>
        </section>
        <div class="row">
            <div class="col-lg-3">
                <section>
                    <h2>Your Cart: </h2>
                    <section id="cart">
                        <p>Your Shopping Cart is Empty</p>
                        <a class="btn btn-blue btn-100" href="viewcart.php">Checkout</a>
                    </section>
                </section>
            </div>
            <div class="col-lg-9">
                <section id="search-result">
                    <h2>Search Result: </h2>
                    <div class="row">
                        <?php
                        for ($i = 0; $i < 12; $i++) {
                            $random = rand(1, 5);
                        ?>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="book-container">
                                    <img src="assets/book<?php echo $random ?>.png" class="book-img" />
                                    <p class="book-name">Introduction to Programming</p>
                                    <p class="book-price">R 300</p>
                                    <div class="text-center">
                                        <input type="button" value="Add to Cart" class="btn btn-green" />
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>
<footer>
    <p class="text-center">Footer</p>
</footer>
<script src="js/scripts.js"></script>

</html>