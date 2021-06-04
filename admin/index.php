<?php 
	session_start();
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php','_self')</script>";
	}else{
		include('includes/header.php');

	  $category_likes = $db->query("SELECT * FROM folders WHERE likes > 0");

	  $category_images = $db->query("SELECT * FROM folders WHERE filecount > 0");

	  $image_likes = $db->query("SELECT fo.feature_image, fi.likes, fo.banner_image, fo.folder_name, fi.folder_id, fi.id, fi.name, fi.featured FROM files fi INNER JOIN folders fo ON fi.folder_id = fo.id");

	  $image_category = $db->query("SELECT fi.name, fo.folder_name, fi.likes, fi.id AS file_id FROM files fi INNER JOIN folders fo ON fi.folder_id = fo.id WHERE fi.folder_id = '".isset($_GET["category"])."'");	

	  $ip_image_likes = $db->query("SELECT fi.likes, li.image_id, li.ip FROM files fi INNER JOIN likes li ON fi.id = li.image_id");

	  $ip_category_likes = $db->query("SELECT fo.likes, li.category_id, li.ip FROM folders fo INNER JOIN likes li ON fo.id = li.category_id");
	  
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
		google.charts.setOnLoadCallback(drawImageLikes);
  	google.charts.setOnLoadCallback(drawImageCategory);
  	google.charts.setOnLoadCallback(drawIpImageLikes);
  	google.charts.setOnLoadCallback(drawIpCategoryLikes);

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
        pieHole: 0.4
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

  	// Image Likes
  	function drawImageLikes() {
      var data = google.visualization.arrayToDataTable([
      	['Image', 'No. of likes'],
      	<?php
		   			if(mysqli_num_rows($image_likes) > 0){
						while($imageLikes = mysqli_fetch_assoc($image_likes)){
							echo "['".$imageLikes['name']."', ".$imageLikes['likes']."],";
						}
					}

				?>
      ]);

      var options = {
        title: 'Image Likes',
        pieHole: 0.4
      };

      var chart = new google.visualization.PieChart(document.getElementById('image_likes'));
      chart.draw(data, options);
  	}

  	// Image Category Likes
  	function drawImageCategory() {
      var data = google.visualization.arrayToDataTable([
      	['Image', 'No. of likes'],
      	<?php
		   			if(mysqli_num_rows($image_category) > 0){
						while($imageCategory = mysqli_fetch_assoc($image_category)){
							echo "['".$imageCategory['name']."', ".$imageCategory['likes']."],";
						}
					}

				?>
      ]);

      var options = {
        title: 'Image Likes',
        pieHole: 0.4
      };

      var chart = new google.visualization.PieChart(document.getElementById('image_category'));
      chart.draw(data, options);
	  }

	  // Ip based likes histogram
	  function drawIpImageLikes() {
      var data = google.visualization.arrayToDataTable([
        ['IP Adress', 'likes'],
        <?php
	   			if(mysqli_num_rows($ip_image_likes) > 0){
						while($ipImageLikes = mysqli_fetch_assoc($ip_image_likes)){
							echo "['".$ipImageLikes['ip']."', ".$ipImageLikes['likes']."],";
						}
					}

				?>
      ]);

      var options = {
        title: 'Users like based on IP',
        legend: { position: 'none' },
      };

      var chart = new google.visualization.Histogram(document.getElementById('ip_image_likes'));
      chart.draw(data, options);
    }
	
    // Ip based likes histogram
	  function drawIpCategoryLikes() {
	    var data = google.visualization.arrayToDataTable([
	      ['IP Adress', 'likes'],
	      <?php
	   			if(mysqli_num_rows($ip_category_likes) > 0){
						while($ipCategoryLikes = mysqli_fetch_assoc($ip_category_likes)){
							echo "['".$ipCategoryLikes['ip']."', ".$ipCategoryLikes['likes']."],";
						}
					}

				?>
	    ]);

	    var options = {
	      title: 'Categories like based on IP',
	      legend: { position: 'none' },
	    };

	    var chart = new google.visualization.Histogram(document.getElementById('ip_category_likes'));
	    chart.draw(data, options);
	  }
	</script>

	<!-- CARD CATEGORIES -->
	<h3 class="h3-responsive text-center p-3 title">DASHBOARD</h3>
	<div class="container-fluid">
		<div class="row mt-2 mx-0">
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
	</div>

	<div class="row mt-2 mx-0">
		<!-- Category likes -->
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div id="category_likes" style="width: 100%; height: 600px;"></div>
		</div>
		<!-- Total No. of Images -->
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div id="category_images" style="width: 100%; height: 600px;"></div>
		</div>
	</div>

	<div class="row mt-2">
		<!-- Image likes -->
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div id="image_likes" style="width: 100%; height: 600px;"></div>
		</div>
		<!-- Image likes based categories -->
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div class="row m-0">
				<div class="col-md-2 col-sm-12 col-xs-12">
					<ul style="list-style: none;">
						<?php
							$list_category = $db->query("SELECT * FROM folders WHERE filecount > 0");
							if(mysqli_num_rows($list_category) > 0){
								while($categories = mysqli_fetch_assoc($list_category)){
									?>
									<li class="nav-item p-0"><a href="index.php?category=<?=$categories['id'];?>" class="nav-link" style="font-size: 14px"><?=$categories['folder_name'];?></a></li>
									<?php
								}
							}
						?>
					</ul>
				</div>
				<div class="col-md-10 col-sm-12 col-xs-12">
					<div id="image_category" style="width: 100%; height: 600px;"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="row mt-2">
		<!-- IP based image likes -->
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div id="ip_image_likes" style="width: 100%; height: 600px;"></div>
		</div>
		<!-- IP based category likes -->
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div id="ip_category_likes" style="width: 100%; height: 600px;"></div>
		</div>
	</div>

<?php include ('includes/footer.php'); } ?>