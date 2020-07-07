<?php
session_start();
include_once "includes/conn.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pearson Bookstore | About</title>
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
        <a href="includes/logout.inc.php" title="Logout"><span class="hidden-sm">Logout </span> <i class="fa fa-sign-out" aria-hidden="true"></i></a>
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
  <div class="custom-container">
    <!-- <section id="search">
      <form class="row" action="shop.php">
        <div class="form-group col-lg-4 col-md-12 col-sm-12">
          <label for="searchBooks"><i class=" fa fa-search" aria-hidden="true"></i></label>
          <input autofocus tabindex="1" id="searchBooks" class="form-control" type="search" placeholder="Search books" name="search">
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
    </section> -->
    <div class="header-message">
      <h1>Shop</h1>
    </div>
    <div class="row">
      <?php
      $bookID = $_GET["id"];
      $query = "SELECT `book`.*, `category`.* FROM `book` INNER JOIN `category` ON `book`.categoryID = `category`.`categoryID` WHERE bookID = $bookID";
      $result = $conn->query($query);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
      ?>
          <div class="col-lg-4 col-md-4 col-sm-6 col-8">
            <div style="text-align: center;">
              <img id="bookImage" src="<?php echo $row['bookImage'] ?>" style="height: auto; min-height: 250px;" />
            </div>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-12 col-12">
            <h2><?php echo $row['bookTitle'] ?></h2>
            <p class="book-info">Edition: <?php echo $row["bookEdition"] ?></p>
            <p class="book-info">Total Pages: <?php echo $row["bookPage"] ?> pages</p>
            <p class="book-info">Release Date: <?php echo $row["bookReleaseDate"] ?></p>
            <p class="book-info">Authors: <?php
                                          $query2 = "SELECT author.authorID, author.auth_firstname, author.auth_surname
                          FROM `book_author`
                          INNER JOIN `author`
                          ON book_author.authorID = author.authorID
                          WHERE book_author.bookID = $bookID;";
                                          $result1 = $conn->query($query2);
                                          if ($result1->num_rows > 0) :
                                            while ($row1 = $result1->fetch_assoc()) :
                                              echo "<a class='author-link' href='shop.php?search=" . $row1['authorID'] . "'>" . $row1['auth_firstname'] . " " . $row1['auth_surname'] . "</a>";
                                              if ($row1['authorID'] != $result1->num_rows) :
                                                echo ", ";
                                              else :
                                                echo "<br/>";
                                              endif;
                                            endwhile;
                                          else :
                                            echo "No Authors Found";
                                          endif;
                                          ?></p>
            <p class="book-info">Category: <a class="author-link" href="shop.php?search=&auth=&cat=<?php echo $row['categoryID'] ?>"><?php echo $row["cat_name"] ?></a></p>
            <p>Price: <span class="money-text">R <?php echo $row['bookPrice'] ?></span></p>
        <?php }
      } else {
        echo "0 results";
      } ?>
        <?php
        if (isset($_SESSION['userID'])) : ?>
          <div class="form-group">
            <label for="quantity">Quantity: </label>
            <input type="number" id="quantity" min="1" max="10" value="1" tabindex="1" class="form-control" />
          </div>
          <a class="btn btn-green" onclick="openWindow()">Add to Cart</a>
        <?php endif; ?>

          </div>
    </div>
  </div>
</body>
<footer>
  <p class="text-center">Footer</p>
</footer>
<script src="js/scripts.js"></script>

</html>