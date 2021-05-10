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