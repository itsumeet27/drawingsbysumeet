<?php
  // Like the images
    if (isset($_GET['like'])) {
      $ip = getIp();
      $image_id = $_GET['like'];
      $result = $db->query("SELECT * FROM files WHERE id = '$image_id'");
      $row = mysqli_fetch_array($result);
      $n = $row['likes'];

      $insert_like = $db->query("INSERT INTO likes (ip, image_id) VALUES ('$ip', '$image_id')");
      $update_like = $db->query("UPDATE files SET likes = $n+1 WHERE id='$image_id'");

      if($insert_like == 1 || $update_like == 1){
        echo "<script>window.open('index.php','_self')</script>";
      }
    }

    // dislike the images
    if (isset($_GET['dislike'])) {
      $ip = getIp();
      $image_id = $_GET['dislike'];
      $result = $db->query("SELECT * FROM files WHERE id = '$image_id'");
      $row = mysqli_fetch_array($result);
      $n = $row['likes'];

      if($row['likes'] <= 0){
        $db->query("UPDATE files SET likes = 0 WHERE id = '$image_id'");
        echo "<script>window.open('index.php','_self')</script>";
      }else{
        $db->query("UPDATE files SET likes = $n-1 WHERE id = '$image_id'");
        echo "<script>window.open('index.php','_self')</script>";
      }

      // Delete the row from likes table
      $db->query("DELETE FROM likes WHERE image_id = '$image_id' AND ip = '$ip'");
    }
?>
  <div class="category-head text-center py-2">
    <h1 class="font-weight-bold py-4">Recently Added</h1>
    <div class="row m-0 container-fluid">
      <?php 
        $fetch_files = $db->query("SELECT fo.feature_image, fi.likes, fo.banner_image, fo.folder_name, fi.folder_id, fi.id AS file_id, fi.name, fi.featured FROM files fi INNER JOIN folders fo ON fi.folder_id = fo.id ORDER BY file_id DESC LIMIT 4");
        if(mysqli_num_rows($fetch_files) > 0){
          while($files = mysqli_fetch_assoc($fetch_files)){
            ?>
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 my-3">
              <div class="card justify-content-center align-items-center h-100 image-category">
                <div class="card-body">
                  <img src="admin/uploads/<?=$files['folder_name'];?>/<?=$files['name'];?>" class="card-img-top img-fluid">
                  <div class="middle text-center">
                    <a class="text-center text" href="gallery.php?category=<?=$files['folder_id'];?>">
                      <img src="admin/uploads/feature_banner_images/<?=$files['banner_image'];?>" alt="<?=$files['name'];?>" class="img-fluid banner_image"></a>
                  </div>
                </div>                
                <div class="card-footer py-2" style="width: 100%">
                  <div style="float:left">
                    <a href="index.php?like=<?=$files['file_id'];?>" class="btn btn-floating btn-success btn-lg mx-1 like" data-id="<?=$files['file_id'];?>"><i class="fas fa-thumbs-up"></i></a>
                    <a href="index.php?dislike=<?=$files['file_id'];?>" class="btn btn-floating btn-danger btn-lg mx-1 dislike" data-id="<?=$files['file_id'];?>"><i class="fas fa-thumbs-down"></i></a>
                  </div>
                  <div style="float: right;vertical-align: middle;">
                    <?php if($files['likes'] <= 0): ?>
                      <span class="badge bg-danger likes_count" style="font-size: 16px;margin-top:0.5em">0 likes</span>
                    <?php else: ?>
                      <span class="badge bg-primary likes_count" style="font-size: 16px;margin-top:0.5em"><?=$files['likes'];?> likes</span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <?php
          }
        }
      ?>
    </div>
  </div>