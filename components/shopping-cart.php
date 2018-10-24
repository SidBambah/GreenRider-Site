<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
session_start();
include("$root/components/header.php");
include("$root/components/scripts/functions.php");
include("$root/components/navigation-minimal.php");
?>

  <div class="shopping-cart">
    <h1>Shopping Cart</h1>

  <?php if(!$cart->isEmpty()){ //Check if cart is empty ?>

    <div class="column-labels">
      <label class="product-image">Image</label>
      <label class="product-details">Product</label>
      <label class="product-price">Price</label>
      <label class="product-quantity">Quantity</label>
      <label class="product-removal">Remove</label>
      <label class="product-line-price">Total</label>
    </div>
    
    <?php 
    $allItems = $cart->getItems();
    foreach ($allItems as $id => $items) {
      foreach ($items as $item) {
    ?>
      <div class="product">
        <div class="product-image">
          <img src="https://s.cdpn.io/3/dingo-dog-bones.jpg">
        </div>
        <div class="product-details">
          <div class="product-title"><?php echo $item['attributes']['name']; ?></div>
          <p class="product-description">The best dog bones of all time. Holy crap. Your dog will be begging for these things! I got curious once and ate one myself. I'm a fan.</p>
        </div>
        <div class="product-price"><?php echo $item['attributes']['price']; ?></div>
        <div class="product-quantity">
          <input type="number" value="<?php echo $item['quantity']; ?>" min="1" max="10">
        </div>
        <div class="product-removal">
          <input type="hidden" class="product-id" value="<?php echo $item['id']; ?>" />
          <button class="remove-product">
            Remove
          </button>
        </div>
        <div class="product-line-price">
          <?php 
            $linePrice = $item['attributes']['price'] * $item['quantity'];
            echo number_format($linePrice, 2); 
          ?>
        </div>
      </div>
    <?php
      }
    }
    ?>
    
    <div class="totals">
      <div class="totals-item">
        <label>Subtotal</label>
        <div class="totals-value" id="cart-subtotal">
          <?php echo $cart->getAttributeTotal('price'); ?>
        </div>
      </div>
      <div class="totals-item">
        <label>Tax (5%)</label>
        <div class="totals-value" id="cart-tax"></div>
      </div>
      <div class="totals-item">
        <label>Delivery</label>
        <div class="totals-value" id="cart-delivery"></div>
      </div>
      <div class="totals-item totals-item-total">
        <label>Grand Total</label>
        <div class="totals-value" id="cart-total"></div>
      </div>
    </div>
        <button onclick="location.href = '/index.php';" class="continue-shopping">Continue Shopping</button>
        <button class="checkout" onclick="location.href='/components/checkout.php';">Checkout</button>
  <?php }else{ ?>
    <div class="text-center">
      <h3> Your shopping cart is empty! </h3>
    </div>
  <?php } ?>

  </div> <!-- Close Shopping Cart -->

<?php
include("$root/components/social.php");
include("$root/components/footer.php");
?>