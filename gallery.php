<?php include('includes/header.php');?>
    
  <div class="container">
    <div class="row">
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
          <div class="banner_image text-center">
            <img src="admin/uploads/feature_banner_images/<?=$banner_image;?>" class="img-responsive img-fluid" style="width: 50%;">
          </div>
          <?php
          $fetch_files = $db->query("SELECT fo.folder_name, fi.name FROM folders fo INNER JOIN files fi ON fo.id = fi.folder_id WHERE fi.folder_id = '".$_GET['category']."'");
          if(mysqli_num_rows($fetch_files) > 0){
            while($files = mysqli_fetch_assoc($fetch_files)){
              ?>
              <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 my-2">
                <div class="p-3" style="box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.5);">
                  <a href="admin/uploads/<?=$files['folder_name'];?>/<?=$files['name'];?>" data-caption="<?=$files['name'];?>" >
                    <img src="admin/uploads/<?=$files['folder_name'];?>/<?=$files['name'];?>" alt="<?=$files['name'];?>" class="img-fluid img-responsive">
                  </a>
                </div>
              </div>
              <?php
            }
          }
        }else{
          ?>
          <div class="row">
            <?php
              $fetchFolders = $db->query("SELECT * FROM folders");
              if(mysqli_num_rows($fetchFolders) > 0){
                while($folders = mysqli_fetch_assoc($fetchFolders)){
                  $folder_name = $folders['folder_name'];
                }
              }
              $fetchFiles = $db->query("SELECT fo.folder_name, fi.name FROM folders fo INNER JOIN files fi ON fo.id = fi.folder_id ORDER BY fo.folder_name ASC");
              if(mysqli_num_rows($fetchFiles) > 0){
                while($images = mysqli_fetch_assoc($fetchFiles)){
                ?>
                  <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12 my-2">
                    <div class="p-3" style="box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.5);">
                      <a href="admin/uploads/<?=$images['folder_name'];?>/<?=$images['name'];?>" data-caption="<?=$images['name'];?>" >
                        <img src="admin/uploads/<?=$images['folder_name'];?>/<?=$images['name'];?>" alt="<?=$images['name'];?>" class="img-fluid img-responsive">
                      </a>
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