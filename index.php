<?php include('includes/header.php');?>
    
  <div class="container">
    <div class="p-3">
      <h2 class="text-center">Drawings By Sumeet</h2>
    </div>

    <div class="row">
      <?php
        $fetch_categories = $db->query("SELECT * FROM folders");
        if(mysqli_num_rows($fetch_categories) > 0){
          while($category = mysqli_fetch_assoc($fetch_categories)){
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 my-3">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title"><?=$category['folder_name'];?></h5>
                </div>
                <div class="card-body">
                  
                </div>
                <div class="card-footer">
                  <a href="gallery.php?category=<?=$category['id'];?>" class="btn btn-primary">View More</a>
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