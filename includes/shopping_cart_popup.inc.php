 <!-- Shopping cart start -->
 <?php
  include 'conn.inc.php';
  if (isset($_SESSION['userID'])) {
    $cart = 'SELECT * FROM cart WHERE `userID` = ' . $_SESSION['userID'];
    $count = 0;
    if ($result = mysqli_query($conn, $cart)) {
      $row = mysqli_fetch_array($result);
      $total = $row['cartTotal'];
      $cartItems = "SELECT * FROM cart_item WHERE `cartID` =" . $row['cartID'];
      if ($result = mysqli_query($conn, $cartItems)) {
        while ($row = mysqli_fetch_array($result)) {
          $count += 1;
        }
      }
    }
    $count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    $total = 0;
  }
  ?>
 <div class="shopping-cart hide" id="modal-cart">
   <div class="shopping-cart-header">
     Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge"><?= $count ?></span>
   </div>
   <ul class="shopping-cart-items">
     <?php
      for ($i = 0; $i < $count; $i++) {
        $cartItem = $_SESSION['cart'][$i];
        echo '<li class="clearfix">';
        echo "<img src=\"assets/book" . ($i + 1) . ".png\">";
        echo '<span class="item-name" title="' . $cartItem['bookTitle'] . '"><a href=viewbook.php?id=' . $cartItem['bookID'] . '>' . $cartItem["bookTitle"] . '</a></span>';
        echo '<span class="item-price">R ' . $cartItem["bookPrice"] . '</span>';
        echo '<span class="item-quantity">Quantity: ' . $cartItem["quantity"] . '</span>';
        $total = $total + ($cartItem["bookPrice"] * $cartItem["quantity"]);
        echo '</li>';
      }
      ?>
   </ul>
   <span class="shopping-cart-total">Total: <span class="money-text">R<?= $total ?></span></span>
   <a href="viewcart.php" class="btn btn-sm btn-blue btn-100">Checkout</a>
 </div>
 <!-- Shopping cart end -->