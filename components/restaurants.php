<?php 
  session_start();
  include_once('scripts/server.php'); 
?>

<!-- Restaurants Grid -->
<section class="bg-light" id="restaurants">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Restaurants</h2>
            <h3 class="section-subheading text-muted">Here are all of the restaurants you can choose from.</h3>
          </div>
        </div>
        <div class="row">
          <?php
            //Get all of the restaurant names and image locations
            $sql = "SELECT * FROM restaurants ORDER BY id ASC";
            $result = mysqli_query($db, $sql);
            while ($record = mysqli_fetch_assoc($result)) {
              $short_name = $record['shortname'];
              $restaurant_name = $record['name'];
              $restaurant_id = $record['id'];
          ?>
            <div class="col-md-4 col-sm-6 restaurants-item">
              <a class="restaurants-link" data-toggle="collapse" href="#<?php echo "$short_name"; ?>">
                <div class="restaurants-hover">
                  <div class="restaurants-hover-content">
                    <i class="fa fa-plus fa-3x"></i>
                  </div>
                </div>
                <img class="img-fluid" src="img/restaurants/<?php echo "$short_name"; ?>.jpg" alt="">
              </a>
              <div class="restaurants-caption">
                <h4><?php echo "$restaurant_name"; ?></h4>
                <p class="text-muted">Illustration</p>
              </div>
            </div>
            <!-- Display restaurant menu -->
            <div class="collapse container row" id="<?php echo "$short_name"; ?>">
              <?php 
                //Get restaurant menu
                $query = "SELECT * FROM products WHERE restaurant_id=$restaurant_id";
                $itemCollection = mysqli_query($db, $query);
                //List all menu items
                while ($item = mysqli_fetch_assoc($itemCollection)) {
                  $item_name = $item['item'];
                  $item_type = $item['type'];
                  $item_price = $item['price'];
                  $item_id = $item['id'];
              ?>
                <div class="card card-body col-lg-3 col-md-4 col-sm-6 panel">
                  <h4 class="card-title"> <?php echo "$item_name"; ?> </h4>
                  <h6 class="card-subtitle text-muted"> <?php echo "$item_type"; ?> </h6>
                  <p class="card-text">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. </p>
                  <div class="text-right panel-footer">
                    <p class="card-text"> &#36;<?php echo "$item_price"; ?>
                      <?php if($_SESSION["loggedIn"] == true) {?>
                        <input type="hidden" value="<?php echo $item_id; ?>" class="product-id" />
                        <a href="#" class="fa fa-cart-plus add-to-cart"><a/>
                      <?php } //Only show cart if user is logged in ?>
                    </p>
                  </div>
                </div>
                
              <?php } //Close menu item loop?>
            </div>
          <?php } //Close restaurant loop?>

          <!-- More restaurants coming soon! -->
          <div class="col-md-4 col-sm-6 restaurants-item">
              <a class="restaurants-link" href="#">
                <div class="restaurants-hover">
                  <div class="restaurants-hover-content">
                    <i class="fa fa-plus fa-3x"></i>
                  </div>
                </div>
                <img class="img-fluid" src="img/restaurants/more_soon.jpg">
              </a>
              <div class="restaurants-caption">
                <h4>More restaurants coming soon!</h4>
                <p class="text-muted">Stay tuned for updates.</p>
              </div>
            </div>
        </div>
      </div>
    </section>