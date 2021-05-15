  <?php
    if (isset($_GET['like'])) {
      $ip = getIp();
      $category_id = $_GET['like'];
      $result = $db->query("SELECT * FROM folders WHERE id = '$category_id'");
      $row = mysqli_fetch_array($result);
      $n = $row['likes'];

      $db->query("INSERT INTO likes (ip, category_id) VALUES ('$ip', '$category_id')");
      $db->query("UPDATE folders SET likes = $n+1 WHERE id='$category_id'");
    }
    if (isset($_GET['unlike'])) {
      $ip = getIp();
      $category_id = $_GET['unlike'];
      $result = $db->query("SELECT * FROM folders WHERE id = '$category_id'");
      $row = mysqli_fetch_array($result);
      $n = $row['likes'];

      $db->query("DELETE FROM likes WHERE category_id = '$category_id' AND ip = '$ip'");
      $db->query("UPDATE folders SET likes = $n-1 WHERE id = '$category_id'");
    }
  ?>
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
                    <img src="admin/uploads/feature_banner_images/<?=$category['banner_image'];?>" class="img-fluid banner_image"></a>
                </div>
                <div class="card-footer text-center">
                  <a href="index.php?like=<?=$category['folder_id'];?>" class="btn btn-floating btn-success btn-lg mx-1"><i class="fas fa-thumbs-up"></i></a>
                  <a href="index.php?unlike=<?=$category['folder_id'];?>" class="btn btn-floating btn-danger btn-lg mx-1"><i class="fas fa-thumbs-down"></i></a>
                </div>
              </div>
            </div>
            <?php
          }
        }
      ?>
    </div>
  </div>