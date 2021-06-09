<?php include('includes/header.php'); ?>

	<div class="category_head container mt-5 pt-4">
		<h1 class="font-weight-bold text-center py-4 about-head">VIDEOS</h1>
		<div class="row mx-0">
			<?php
				$videos = $db->query("SELECT * FROM videos ORDER BY id DESC");
				if(mysqli_num_rows($videos) > 0){
					while($video = mysqli_fetch_assoc($videos)){
						?>
						<div class="col-md-4 col-sm-12 col-xs-12 my-2">
							<iframe src="<?=$video["url"];?>" title="<?=$video["title"];?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width:100%;height: 360px;"></iframe>
						</div>
						<?php
					}
				}
			?>
		</div>
	</div>

<?php include('includes/footer.php'); ?>