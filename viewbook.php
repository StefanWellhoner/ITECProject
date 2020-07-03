<?php
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
      <a href="shop.php">Shop</a>
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
    <div class="header-message">
      <h1>Hello</h1>
    </div>
    <div class="row">
      <?php
      $bookID = $_GET["id"];
      $query = "SELECT `book`.*, `category`.* FROM `book` INNER JOIN `category` ON `book`.categoryID = `category`.`categoryID` WHERE bookID = $bookID";
      $result = $conn->query($query);
      if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
      ?>
          <div class="col-lg-4 col-md-6">
            <img src="<?php echo $row['bookImage'] ?>" style="height: auto; min-height: 400px;" class="" />
          </div>
          <div class="col-lg-8 col-md-6">
            <h2><?php echo $row['bookTitle'] ?></h2>
            <h4>Edition: <?php echo $row["bookEdition"] ?></h4>
            <h4>Total Pages: <?php echo $row["bookPage"] ?> pages</h4>
            <h4>Release Date: <?php echo $row["bookReleaseDate"] ?></h4>
            <h4>Authors: <?php
                          $query2 = "SELECT author.authorID, author.auth_firstname, author.auth_surname
                          FROM `book_author`
                          INNER JOIN `author`
                          ON book_author.authorID = author.authorID
                          WHERE book_author.bookID = $bookID;";
                          $result1 = $conn->query($query2);
                          if ($result1->num_rows > 0) {
                            // output data of each row
                            while ($row1 = $result1->fetch_assoc()) {
                              echo "<a class='author-link' href='shop.php?search=" . $row1['authorID'] . "'>" . $row1['auth_firstname'] . " " . $row1['auth_surname'] . "</a>";
                              if ($row1['authorID'] != $result1->num_rows) {
                                echo ", ";
                              } else {
                                echo "<br/>";
                              }
                            }
                          } else {
                            echo "No Authors Found";
                          }
                          ?></h4>
            <h4>Category: <a href="shop.php?search=<?php echo $row['categoryID']?>"><?php echo $row["cat_name"] ?></a></h4>
        <?php }
      } else {
        echo "0 results";
      } ?>
        <div class="row">
          <div class="form-group col-lg-8">
            <label for="quantity">Quantity: </label>
            <input type="number" id="quantity" min="1" max="10" value="1" class="form-control" />
          </div>
          <div class="col-lg-12">
            <a class="btn btn-green">Add to Cart</a>
          </div>
        </div>
          </div>
    </div>
  </div>
</body>
<footer>
  <p class="text-center">Footer</p>
</footer>
<script src="js/scripts.js"></script>

</html>