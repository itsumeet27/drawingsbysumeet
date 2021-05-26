<?php include('includes/header.php');?>
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
        echo "<script>window.open('gallery.php','_self')</script>";
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
        echo "<script>window.open('gallery.php','_self')</script>";
      }else{
        $db->query("UPDATE files SET likes = $n-1 WHERE id = '$image_id'");
        echo "<script>window.open('gallery.php','_self')</script>";
      }

      // Delete the row from likes table
      $db->query("DELETE FROM likes WHERE image_id = '$image_id' AND ip = '$ip'");
    }
?>    
  <div class="mb-2">
    <div class="row m-0">
      <?php
        if(isset($_GET['category'])){
          $fetch_category = $db->query("SELECT * FROM folders WHERE id = '".$_GET['category']."'");
          if(mysqli_num_rows($fetch_category) > 0){
            while($folders = mysqli_fetch_assoc($fetch_category)){
              $folder_name = $folders['folder_name'];
              $banner_image = $folders['banner_image'];
            }
          }
          ?>
          <div class="banner_image_gallery text-center">
            <img src="admin/uploads/feature_banner_images/<?=$banner_image;?>" class="img-responsive img-fluid">
          </div>
          <?php
          $fetch_files = $db->query("SELECT fo.feature_image, fi.likes, fo.banner_image, fo.folder_name, fi.folder_id, fi.id, fi.name, fi.featured FROM files fi INNER JOIN folders fo ON fi.folder_id = fo.id WHERE fi.folder_id = '".$_GET['category']."'");
          if(mysqli_num_rows($fetch_files) > 0){
            while($files = mysqli_fetch_assoc($fetch_files)){
              ?>
              <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 my-3">
                <div class="card justify-content-center align-items-center h-100 image-category">
                  <div class="card-body">
                    <div class="p-3 gallery-image-frame">
                      <a href="admin/uploads/<?=$files['folder_name'];?>/<?=$files['name'];?>" data-caption="<?=$files['name'];?>" >
                        <img src="admin/uploads/<?=$files['folder_name'];?>/<?=$files['name'];?>" alt="<?=$files['name'];?>" class="img-fluid img-responsive">
                      </a>
                    </div>
                  </div>
                  <div class="card-footer py-2" style="width: 100%">
                    <div style="float:left">
                      <a href="gallery.php?like=<?=$files['id'];?>" class="btn btn-floating btn-success btn-lg mx-1 like" data-id="<?=$files['id'];?>"><i class="fas fa-thumbs-up"></i></a>
                      <a href="gallery.php?dislike=<?=$files['id'];?>" class="btn btn-floating btn-danger btn-lg mx-1 dislike" data-id="<?=$files['id'];?>"><i class="fas fa-thumbs-down"></i></a>
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
        }else{
          ?>
          <div class="row my-3 py-5">
            <?php
              $fetchFolders = $db->query("SELECT * FROM folders");
              if(mysqli_num_rows($fetchFolders) > 0){
                while($folders = mysqli_fetch_assoc($fetchFolders)){
                  $folder_name = $folders['folder_name'];
                }
              }
              $fetchFiles = $db->query("SELECT fo.feature_image, fi.likes, fo.banner_image, fo.folder_name, fi.folder_id, fi.id, fi.name, fi.featured FROM files fi INNER JOIN folders fo ON fi.folder_id = fo.id ORDER BY fO.folder_name ASC");
              if(mysqli_num_rows($fetchFiles) > 0){
                while($images = mysqli_fetch_assoc($fetchFiles)){
                ?>
                  <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12 my-3">
                    <div class="card justify-content-center align-items-center h-100 image-category">
                      <div class="card-body">
                        <div class="p-3 gallery-image-frame">
                          <a href="admin/uploads/<?=$images['folder_name'];?>/<?=$images['name'];?>" data-caption="<?=$images['name'];?>" >
                            <img src="admin/uploads/<?=$images['folder_name'];?>/<?=$images['name'];?>" alt="<?=$images['name'];?>" class="img-fluid img-responsive">
                          </a>
                        </div>
                      </div>
                      <div class="card-footer py-2" style="width: 100%">
                        <div style="float:left">
                          <a href="gallery.php?like=<?=$images['id'];?>" class="btn btn-floating btn-success btn-sm mx-1 like" data-id="<?=$images['id'];?>"><i class="fas fa-thumbs-up"></i></a>
                          <a href="gallery.php?dislike=<?=$images['id'];?>" class="btn btn-floating btn-danger btn-sm mx-1 dislike" data-id="<?=$images['id'];?>"><i class="fas fa-thumbs-down"></i></a>
                        </div>
                        <div style="float: right;vertical-align: middle;">
                          <?php if($images['likes'] <= 0): ?>
                            <span class="badge bg-danger likes_count" style="font-size: 12px;margin-top:0.5em">0 likes</span>
                          <?php else: ?>
                            <span class="badge bg-primary likes_count" style="font-size: 12px;margin-top:0.5em"><?=$images['likes'];?> likes</span>
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
          <?php
        }
      ?>
    </div>
  </div>

<?php include('includes/footer.php');?>