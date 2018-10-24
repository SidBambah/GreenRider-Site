<?php
include_once('scripts/server.php');
$sql = "SELECT * FROM riders ORDER BY id ASC";
$result = mysqli_query($db, $sql);
?>


<section class="bg-light" id="riders">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Our Amazing Riders</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
          </div>
        </div>
        <div class="row">
          <?php
            while ($record = mysqli_fetch_assoc($result)) {
              $name = $record['name'];
              $position = $record['position'];
              $img = str_replace(' ', '_', strtolower($name));
              $img_src = "img/riders/$img.jpg";
              if(!file_exists($img_src)){
                $img_src = "img/riders/nopic.jpg";
              }
              echo "
              <div class='col-sm-4'>
                    <div class='riders-member'>
                      <img class='mx-auto rounded-circle' src=$img_src alt=''>
                      <h4> $name </h4>
                      <p class='text-muted'> $position </p>
                    </div>
              </div>
              ";
            }
          ?>
        </div>
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                 Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
          </div>
        </div>
      </div>
    </section>