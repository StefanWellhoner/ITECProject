 <!-- Shopping cart start -->
 <?php $count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
 $total = 0;
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
        echo '</li>';
        $total += ($cartItem["quantity"] * $cartItem["bookPrice"]);
      }
      ?>
   </ul>   
   <span class="shopping-cart-total">Total: <span class="money-text"><?= $total ?></span></span>
   <a href="viewcart.php" class="btn btn-sm btn-blue btn-100">Checkout</a>
 </div>
 <!-- Shopping cart end -->