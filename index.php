 
<?php 
  $root = $_SERVER['DOCUMENT_ROOT'];
  session_start();
  include("$root/components/header.php");
  include("$root/components/navigation.php");
  include("$root/components/masthead.php");
  include("$root/components/restaurants.php"); 
  include("$root/components/features.php");
  include("$root/components/delivery-address.php");
  include("$root/components/about.php");
  include("$root/components/riders.php");
  include("$root/components/clients.php");
  include("$root/components/contact.php");
  include("$root/components/social.php");
  include("$root/components/footer.php");
  if(isset($_SESSION['loggedIn']) && !isset($_SESSION['deliveryAddress'])){
?>
  <script>getDeliveryAddress();</script>
<?php } ?>