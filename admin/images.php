<?php 
	session_start();
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php','_self')</script>";
	}else{
		include('includes/header.php');

		if(isset($_GET['feature'])){
			$db->query("UPDATE files SET featured = 1 WHERE id = '".$_GET['feature']."'");
			echo "<div class='alert alert-success'>Image is set featured</div>";
		}

		if(isset($_GET['not_feature'])){
			$db->query("UPDATE files SET featured = 0 WHERE id = '".$_GET['not_feature']."'");
			echo "<div class='alert alert-danger'>Image is not featured</div>";
		}
?>

	<style type="text/css">
		div.dataTables_wrapper div.dataTables_length select, div.dataTables_wrapper div.dataTables_length input{
			width: 50px!important;
		}
	</style>
	<h2 class="h2-responsive text-center p-3 title">List of all images</h2>

	<div class="container-fluid">
		<div class="table-responsive" style="overflow-x: hidden;">
			<table class="table table-bordered table-sm table-striped" id="dtBasicExample">
				<thead class="text-white" style="background: rgb(0,0,140)">
					<th></th>
					<th>Image</th>
					<th>Category Name</th>
					<th>Featured</th>
				</thead>
				<tbody>
					<?php
						$fetch_images = $db->query("SELECT fi.id, fi.name, fo.folder_name, fi.featured FROM files fi INNER JOIN folders fo ON fi.folder_id = fo.id");
						if(mysqli_num_rows($fetch_images) > 0){
							while($images = mysqli_fetch_assoc($fetch_images)){
								?>
								<tr>
									<td>
										<?php
											if($images['featured'] == 0){
												echo '<a href="images.php?feature='.$images["id"].'"><i class="fas fa-check-circle text-success" title="Set to feature"></i></a>';
											}else{
												echo '<a href="images.php?not_feature='.$images["id"].'"><i class="fas fa-times-circle text-danger" title="Remove feature"></i></a>';
											}
										?>
									</td>
									<td><img src="uploads/<?=$images['folder_name'];?>/<?=$images['name'];?>" class="img-fluid img-responsive" style="width: 100px;"></td>
									<td><?=$images['folder_name'];?></td>
									<td>
										<?php
											if($images['featured'] == 0){
												echo 'Not Featured';
											}else{
												echo 'Featured';
											}
										?>
									</td>
								</tr>
								<?php
							}
						}
					?>
				</tbody>
				<script type="text/javascript">
					$(document).ready(function () {
					  $('#dtBasicExample').DataTable();
					  $('.dataTables_length').addClass('bs-select');
					});
        </script>
			</table>
		</div>
	</div>

<?php include ('includes/footer.php'); } ?>