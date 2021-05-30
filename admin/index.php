<?php 
	session_start();
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php','_self')</script>";
	}else{
		include('includes/header.php');

	  $category_likes = $db->query("SELECT * FROM folders WHERE likes > 0");

	  $category_images = $db->query("SELECT * FROM folders WHERE filecount > 0");
?>

	<style type="text/css">
		div.dataTables_wrapper div.dataTables_length select, div.dataTables_wrapper div.dataTables_length input{
			width: 50px!important;
		}
	</style>

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<!-- Google Charts -->
	<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart','bar']});
		google.charts.setOnLoadCallback(drawCategoryLikes);
		google.charts.setOnLoadCallback(drawCategoryImages);


		// Category Likes
		function drawCategoryLikes() {
      var data = google.visualization.arrayToDataTable([
      	['Category', 'Likes'],
      	<?php
		   			if(mysqli_num_rows($category_likes) > 0){
						while($categoryLikes = mysqli_fetch_assoc($category_likes)){
							echo "['".$categoryLikes['folder_name']."', ".$categoryLikes['likes']."],";
						}
					}

				?>
      ]);

      var options = {
        title: 'Category Likes',
        is3D: true
      };

      var chart = new google.visualization.PieChart(document.getElementById('category_likes'));
      chart.draw(data, options);
  	}

  	// No. of files in category
  	function drawCategoryImages() {
      var data = google.visualization.arrayToDataTable([
      	['Category', 'No. of Files'],
      	<?php
		   			if(mysqli_num_rows($category_images) > 0){
						while($categoryImages = mysqli_fetch_assoc($category_images)){
							echo "['".$categoryImages['folder_name']."', ".$categoryImages['filecount']."],";
						}
					}

				?>
      ]);

      var options = {
        title: 'No. of Images',
        is3D: true
      };

      var chart = new google.visualization.PieChart(document.getElementById('category_images'));
      chart.draw(data, options);
  	}

	</script>

	<!-- CARD CATEGORIES -->
	<h3 class="text-center py-2">Admin Index</h3>
	<div class="mt-2 row container-fluid">
		<?php
			$categories = $db->query("SELECT fo.feature_image, fo.filecount, fo.likes, fo.banner_image, fo.folder_name, fi.folder_id, fi.id, fi.name, fi.featured FROM files fi INNER JOIN folders fo ON fi.folder_id = fo.id WHERE fi.featured = 1");
			$rows = mysqli_num_rows($categories);
			if($rows > 0){
				while($category = mysqli_fetch_assoc($categories)){
				?>
				<div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 my-3">
          <div class="card justify-content-center align-items-center h-100 image-category" style="box-shadow: 0px 2px 5px 2px rgba(0,0,0,0.5);">
            <div class="card-body">
              <div class="middle text-center">
                <a class="text-center text" href="../gallery.php?category=<?=$category['folder_id'];?>">
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

	<!-- LIKED CATEGORIES and NO. OF IMAGES -->
	<div class="row mt-2">
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div id="category_likes" style="width: 100%; height: 600px;"></div>
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div id="category_images" style="width: 100%; height: 600px;"></div>
		</div>
	</div>


<?php include ('includes/footer.php'); } ?>