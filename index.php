<?php include('includes/header.php'); ?>      
  
  <div class="p-5 text-center bg-image">
    <div class="mask" style="background-color: rgba(0, 0, 0, 0.7);">
      <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white">
          <h1 class="mb-3">DRAWINGS BY SUMEET</h1>
          <h6 class="mb-3">-by Sumeet Sharma</h6>
        </div>
      </div>
    </div>
  </div>
  <!-- About -->
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
  <div class="category-head text-center p-2" id="about">
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
  <!-- Categories -->
  <div class="category-head text-center py-2">
    <h1 class="font-weight-bold py-4">Categories</h1>
    <div class="row m-0 container-fluid">
      <?php 
        $fetch_category = $db->query("SELECT fo.feature_image, fo.banner_image, fo.folder_name, fi.folder_id, fi.id, fi.name, fi.featured FROM files fi INNER JOIN folders fo ON fi.folder_id = fo.id WHERE fi.featured = 1");
        if(mysqli_num_rows($fetch_category) > 0){
          while($category = mysqli_fetch_assoc($fetch_category)){
            ?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 my-3">
              <div class="card justify-content-center align-items-center h-100 image-category">
                <img src="admin/uploads/<?=$category['folder_name'];?>/<?=$category['name'];?>" class="card-img-top img-fluid">
                <div class="middle text-center">
                  <a class="text-center text" href="gallery.php?category=<?=$category['folder_id'];?>">
                    <img src="admin/uploads/feature_banner_images/<?=$category['banner_image'];?>" class="img-fluid banner_image">
                  </a>
                </div>
              </div>
            </div>
            <?php
          }
        }
      ?>
    </div>
  </div>

<?php include('includes/footer.php');?>