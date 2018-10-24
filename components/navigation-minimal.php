<?php
    session_start();
    include_once("$root/components/scripts/config.php");
?>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="../index.php#page-top">GreenRider</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <?php
            //Show logout button and shopping cart if user is already logged in
            if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
            ?>
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger cart-trigger" href="/components/shopping-cart.php">
                    <i class="fa fa-shopping-cart"></i>
                    Cart (<span id="cart-num-items"><?php echo $cart->getTotalItem(); ?></span>)
                  </a>
                </li>
                <!-- Logout Button -->
                <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="/components/scripts/logout.php?return=logout">Logout</a>
                </li>
            <?php } else{ ?>
                <li class="nav-item">
                <a class="nav-link js-scroll-trigger" data-toggle="modal" href="#" data-target="#loginModal">Login</a>
                </li>
                <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#" data-toggle="modal" data-target="#registerModal">Signup</a>
                </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>

<?php include("$root/components/login.php");
      include("$root/components/register.php");
?>