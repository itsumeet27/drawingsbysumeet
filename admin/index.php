<?php 
	session_start();
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php','_self')</script>";
	}else{
		include('includes/header.php');
?>

	<h3 class="text-center py-2">Admin Index</h3>
	<div class="mt-2 row">
		<?php
			$categories = $db->query("SELECT fo.feature_image, fo.filecount, fo.likes, fo.banner_image, fo.folder_name, fi.folder_id, fi.id, fi.name, fi.featured FROM files fi INNER JOIN folders fo ON fi.folder_id = fo.id WHERE fi.featured = 1");
			$rows = mysqli_num_rows($categories);
			if($rows > 0){
				while($category = mysqli_fetch_assoc($categories)){
				?>
				<div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 my-3">
          <div class="card justify-content-center align-items-center h-100 image-category">
            <div class="card-body">
              <div class="middle text-center">
                <a class="text-center text" href="./gallery.php?category=<?=$category['id'];?>">
                  <img src="uploads/feature_banner_images/<?=$category['banner_image'];?>" class="img-fluid banner_image"></a>
              </div>
            </div>
            <div class="card-footer py-2 text-center" style="width: 100%">
              <span class="lead font-weight-bold"><?=$category['filecount'];?></span>
            </div>                    
          </div>
        </div>
				<?php
				}
			}
		?>
	</div>

<?php include ('includes/footer.php'); } ?>