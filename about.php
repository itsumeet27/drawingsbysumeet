  <?php
    $sql = "SELECT * FROM about";
    $result = $db->query($sql);
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $name = $row['name'];
        $short_desc = $row['feature_desc'];
        $salutation = $row['salutation'];
        $description = $row['about_desc'];
        $address = $row['address'];
        $mobile = $row['mobile'];
        $email = $row['email'];
        $image = $row['image'];
      }
  ?>
  <div class="category-head text-center py-2" id="about">
    <h1 class="font-weight-bold py-4 about-head">About</h1>
    <div class="container bg-white p-0 about-section">
      <div class="banner row m-0">
        <div class="col-md-4 profile-image">
          <div class="image">
            <?php if($image != ''): ?>
              <img src="img/sumeet-sharma.jpg" class="img-fluid img-responsive">
            <?php else: ?>
              <img src="img/profile.webp" class="img-fluid img-responsive">
            <?php endif; ?>
          </div>
        </div>
        <div class="col-md-8 details px-4">
          <h6 class="h6-responsive salutation"><?=$salutation;?></h6>
          <h1 class="h1-responsive name"><?=$name;?></h1>
          <hr class="title">
          <p class="text-justify lead short_desc"><?=$short_desc;?></p>
          <p class="description"><?=$description;?></p>
          <!-- <a href="portfolio.php" class="btn btn-portfolio btn-lg">Portfolio</a>
          <a href="contact.php" class="btn btn-contact btn-lg ml-2">Hire Me</a> -->
        </div>
      </div>
    </div>

    <?php } else { echo ""; } ?>
  </div>