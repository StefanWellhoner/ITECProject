<?php
session_start();
include_once "includes/conn.inc.php";
$product_ids = array();
if (isset($_SESSION['userID'])) {
  if (isset($_POST['add-cart-submit'])) {
    if (isset($_SESSION['cart'])) {
      $count = count($_SESSION['cart']);

      $product_ids = array_column($_SESSION['cart'], 'bookID');

      if (!in_array($_POST['bookID'], $product_ids)) {
        $_SESSION['cart'][$count] = array(
          'bookID' => $_POST['bookID'],
          'bookTitle' => $_POST['bookTitle'],
          'bookPrice' => $_POST['bookPrice'],
          'quantity' => $_POST['quantity'],
        );
      } else {
        for ($i = 0; $i < count($product_ids); $i++) {
          if ($product_ids[$i] == $_POST['bookID']) {
            $_SESSION['cart'][$i]['quantity'] += $_POST['quantity'];
          }
        }
      }
    } else {
      $_SESSION['cart'][0] = array(
        'bookID' => $_POST['bookID'],
        'bookTitle' => $_POST['bookTitle'],
        'bookPrice' => $_POST['bookPrice'],
        'quantity' => $_POST['quantity'],
      );
    }
  }
}
$count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
// pre_r($_SESSION['cart']);

// function pre_r($array)
// {
//   echo '<pre>';
//   print_r($array);
//   echo '</pre>';
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pearson Bookstore | About</title>
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="./css/components.css">
</head>

<body>
  <header class="navbar" id="topnav">
    <a href="index.php">Pearson Bookstore</a>
    <nav class="nav-right">
      <a href="index.php">Home</a>
      <a href="shop.php" class="active">Shop</a>
      <a href="about.php">About</a>
      <a href="support.php">Support</a>
      <?php if (isset($_SESSION['userID'])) : ?>
        <a href="javascript:void(0);" onclick="cartDropdown()">
          <span id="cart-text" class="hidden-sm">View Cart </span>
          <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          <span class="badge"><?=$count?></span>
        </a>
        <a href="includes/logout.inc.php" title="Logout"><span class="hidden-sm">Logout </span> <i class="fa fa-sign-out" aria-hidden="true"></i></a>
      <?php endif; ?>
    </nav>
    <a href="JavaScript:void(0)" class="icon" onclick="collapse()">
      <i class="fa fa-bars"></i>
    </a>
  </header>

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
      <h1>Shop</h1>
    </div>
    <div class="row">
      <?php
      $bookID = $_GET["id"];
      $bookQuery = "SELECT `book`.*, `category`.* FROM `book` INNER JOIN `category` ON `book`.categoryID = `category`.`categoryID` WHERE bookID = $bookID";
      $authorQuery = "SELECT author.authorID, author.auth_firstname, author.auth_surname FROM `book_author` INNER JOIN `author` ON book_author.authorID = author.authorID WHERE book_author.bookID = $bookID;";
      $result = $conn->query($bookQuery);
      if ($result->num_rows > 0) :
        while ($row = $result->fetch_assoc()) :
      ?>
          <div class="col-lg-4 col-md-4 col-sm-6 col-8">
            <div style="text-align: center;">
              <img id="bookImage" src="<?= $row['bookImage'] ?>" style="height: auto; min-height: 250px;" />
            </div>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-12 col-12">
            <h4><?= $row['bookTitle'] ?></h4>
            <p class="book-info">Edition: <?= $row["bookEdition"] ?></p>
            <p class="book-info">Total Pages: <?= $row["bookPage"] ?> pages</p>
            <p class="book-info">Release Date: <?= $row["bookReleaseDate"] ?></p>
            <p class="book-info">Authors:
              <?php
              $authorResult = $conn->query($authorQuery);
              if ($authorResult->num_rows > 0) :
                while ($author = $authorResult->fetch_assoc()) :
                  echo "<a class='author-link' href='shop.php?search=" . $author['authorID'] . "'>" . $author['auth_firstname'] . " " . $author['auth_surname'] . "</a>";
                  if ($author['authorID'] != $authorResult->num_rows) :
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
            <?php
            if (isset($_SESSION['userID'])) : ?>
              <form action="viewbook.php?action=add&id=<?= $row['bookID'] ?>" method="POST">
                <div class="form-group">
                  <label for="quantity">Quantity: </label>
                  <input type="number" name="quantity" id="quantity" min="1" max="10" value="1" tabindex="1" class="form-control" required />
                  <input type="hidden" name="bookID" value="<?= $row['bookID'] ?>" />
                  <input type="hidden" name="bookPrice" value="<?= $row['bookPrice'] ?>" />
                  <input type="hidden" name="bookTitle" value="<?= $row['bookTitle'] ?>" />
                </div>
                <button class="btn btn-green" type="submit" name="add-cart-submit">Add to Cart</button>
              </form>
        <?php
            else:
              echo '<div class="error-msg">You need to <a href=login.php?redirect=viewbook.php?id='.$_GET['id'].' class="bold underlined">login</a> to add to cart</div>';
            endif;
          endwhile;
        else :
          echo "0 results";
        endif; ?>
          </div>
    </div>
  </div>
</body>
<footer>
  <p class="text-center">Footer</p>
</footer>
<script src="js/scripts.js"></script>

</html>