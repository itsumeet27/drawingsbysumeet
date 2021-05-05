<?php include('includes/header.php');?>
    
  <div class="container">
    <div class="p-3">
      <h2 class="text-center">Gallery</h2>
    </div>
    <div class="row">
      <?php
        if(isset($_GET['category'])){
          $fetch_category = $db->query("SELECT * FROM folders WHERE id = '".$_GET['category']."'");
          if(mysqli_num_rows($fetch_category) > 0){
            while($folders = mysqli_fetch_assoc($fetch_category)){
              $folder_name = $folders['folder_name'];
            }
          }
          ?>
          <h4 class="p-3 text-center"><?=$folder_name;?></h4>
          <?php
          $fetch_files = $db->query("SELECT fo.folder_name, fi.name FROM folders fo INNER JOIN files fi ON fo.id = fi.folder_id WHERE fi.folder_id = '".$_GET['category']."'");
          if(mysqli_num_rows($fetch_files) > 0){
            while($files = mysqli_fetch_assoc($fetch_files)){
              ?>
              <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 my-2">
                <div class="p-3" style="box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.5);">
                  <img src="admin/uploads/<?=$files['folder_name'];?>/<?=$files['name'];?>" alt="<?=$files['name'];?>" class="img-fluid img-responsive">
                </div>
              </div>
              <?php
            }
          }
        }
      ?>
    </div>
  </div>

<?php include('includes/footer.php');?>