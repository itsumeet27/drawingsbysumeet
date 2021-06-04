<?php 
	session_start();
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php','_self')</script>";
	}else{
		include('includes/header.php');
		include('includes/fileslogic.php');
		
	    // Fetch data from database
	    $fetch = "SELECT * FROM files";
	    $result = mysqli_query($db, $fetch);

?>
	<style type="text/css">
		td .btn{
			width: 125px!important;
		}

		.btn-floating{			
    		cursor: pointer;
    		border-radius: 50%;
    		overflow: hidden;
    		vertical-align: middle;
    		box-shadow: 0 5px 11px 0 rgba(0,0,0,0.18), 0 4px 15px 0 rgba(0,0,0,0.15);
    		transition: all .2s ease-in-out;

		}

		.btn-floating.btn-lg{
			width: 60px;
    		height: 60px;
    		border:none!important;
		}

		.options{
			width: 45px;
    		height: 45px;
    		border:none!important;
		}

		.remove_file{
			width: 35px;
    		height: 35px;
    		border:none!important;
		}

	</style>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
	<!-- Folder based file upload -->
	<h3 class="h3-responsive text-center p-3 title">LIST OF CATEGORIES</h3>
	<div class="pl-2">
		<button type="button" class="btn-floating options btn-primary" name="create_folder" id="create_folder" style="margin: 0 0.5em" title="Create Folder"><i class="fas fa-folder-plus"></i></button>
	</div>
	<!-- Creating and Renaming Folder -->
	<div class="modal fade" id="folderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h3 class="modal-title w-100" id="change_title">Create Folder</h3>
					<button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body mx-3">
					<div class="md-form mb-5">
						<i class="fas fa-folder prefix elegant-text"></i>
						<label for="folder_name">Folder Name</label>
						<input type="text" id="folder_name" class="form-control validate" name="folder_name" is-valid is-invalid required>
						<input type="hidden" name="action" id="action">
						<input type="hidden" name="old_name" id="old_name">
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger btn-md" type="button" name="close" data-mdb-dismiss="modal" style="width: 125px!important">Close</button>
					<input type="button" name="folder_button" id="folder_button" class="btn btn-primary btn-md" value="Create" class="form-control" style="width: 125px!important">
				</div>
			</div>
		</div>
	</div>
	<!-- Adding files in the folder -->
	<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h3 class="modal-title w-100" id="change_title">Upload file</h3>
					<button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" method="post" id="upload_form" enctype="multipart/form-data">
					<div class="modal-body mx-3">
						<div class="md-form mb-5">						
							<h3 class="h3-responsive pb-3">Upload here!</h3>
							<input type="file" name="myfile[]" multiple>
							<input type="hidden" name="hidden_folder_name" id="hidden_folder_name">					        
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-danger btn-md" type="button" name="close" data-mdb-dismiss="modal" style="width: 125px!important">Close</button>
						<button type="submit" name="save" class="btn btn-primary btn-md" style="width: 125px!important">Upload</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Adding feature image -->
	<div class="modal fade" id="feature_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h3 class="modal-title w-100" id="change_title">Upload file</h3>
					<button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" method="post" id="feature_image_form" enctype="multipart/form-data">
					<div class="modal-body mx-3">
						<div class="md-form mb-5">						
							<h3 class="h3-responsive pb-3">Upload here!</h3>
							<input type="file" name="feature_image">
							<input type="hidden" name="hidden_feature_folder_name" id="hidden_feature_folder_name">					        
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-danger btn-md" type="button" name="close" data-mdb-dismiss="modal" style="width: 125px!important">Close</button>
						<button type="submit" name="upload_feature_image" class="btn btn-primary btn-md" style="width: 125px!important">Upload</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Adding banner image -->
	<div class="modal fade" id="banner_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h3 class="modal-title w-100" id="change_title">Upload file</h3>
					<button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" method="post" id="banner_image_form" enctype="multipart/form-data">
					<div class="modal-body mx-3">
						<div class="md-form mb-5">						
							<h3 class="h3-responsive pb-3">Upload here!</h3>
							<input type="file" name="banner_image">
							<input type="hidden" name="hidden_banner_folder_name" id="hidden_banner_folder_name">					        
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-danger btn-md" type="button" name="close" data-mdb-dismiss="modal" style="width: 125px!important">Close</button>
						<button type="submit" name="upload_banner_image" class="btn btn-primary btn-md" style="width: 125px!important">Upload</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- List files in the folder -->
	<div class="modal fade" id="filelistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h3 class="modal-title w-100" id="change_title">List of files</h3>
					<button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body mx-3" id="file_list">
					
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger btn-md" type="button" name="close" data-mdb-dismiss="modal" style="width: 125px!important">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="table-responsive p-2 container-fluid" id="folder_table"></div>

	<script type="text/javascript">
		$(document).ready(function(){
			load_folder_list();
			// List all the folders
			function load_folder_list(){
				var action = "fetch";
				$.ajax({
					url: "uploads/action.php",
					method: "POST",
					data: {
						action:action
					},
					success: function(data){
						$("#folder_table").html(data);
					}
				})
			}

			// Create folder
			$(document).on('click', '#create_folder', function(){
				$('#action').val('create');
				$('#folder_name').val('');
				$('#folder_button').val('Create');
				$('#old_name').val('');
				$('#change_title').text('Create Folder');
				$('#folderModal').modal('show')
			});

			$(document).on('click', '#folder_button', function(){
				var folder_name = $('#folder_name').val();
				var action = $('#action').val();
				var old_name = $('#old_name').val();
				if(folder_name != ''){
					$.ajax({
						url: "uploads/action.php",
						method: "POST",
						data: {folder_name:folder_name, old_name:old_name, action:action},
						success: function(data){
							$('#folderModal').modal('hide')
							load_folder_list();
							alert(data);
						}
					});
				}else{
					alert("Enter Folder Name");
				}
			});

			// Update/Rename folder
			$(document).on('click', '.update', function(){
				var folder_name = $(this).data("name");
				$('#old_name').val(folder_name);
				$('#folder_name').val(folder_name);
				$('#action').val("change");
				$('#folder_button').val('Update');
				$('#change_title').text("Change Folder Name");
				$('#folderModal').modal("show");
			});

			// Upload files
			$(document).on('click', '.upload', function(){
				var folder_name = $(this).data("name");
				$('#hidden_folder_name').val(folder_name);
				$('#uploadModal').modal('show');
			});

			// Feature image
			$(document).on('click', '.feature_image', function(){
				var feature_folder_name = $(this).data("name");
				$('#hidden_feature_folder_name').val(feature_folder_name);
				$('#feature_image').modal('show');
			});

			// Banner image
			$(document).on('click', '.banner_image', function(){
				var banner_folder_name = $(this).data("name");
				$('#hidden_banner_folder_name').val(banner_folder_name);
				$('#banner_image').modal('show');
			});

			$('#upload_form').on('submit', function(){
				$.ajax({
					url:"includes/fileslogic.php",
					method:"POST",
					data:new FormData(this),
					contentType:false,
					cache:false,
					processData:false,
					success:function(data){
						load_folder_list();
					}
				})
			});

			// View files in folder
			$(document).on('click', '.view_files', function(){
				var folder_name = $(this).data("name");
				var action = "fetch_files";
				$.ajax({
					url:"uploads/action.php",
					method:"POST",
					data:{action:action, folder_name:folder_name},
					success:function(data){
						$('#file_list').html(data);
						$('#filelistModal').modal('show');
					}
				})
			});

			// Remove files from folder
			$(document).on('click', '.remove_file', function(){
				var path = $(this).attr("id");
				var action = "remove_file";
				if(confirm("Are you sure to remove the file?")){
					$.ajax({
						url:"uploads/action.php",
						method:"POST",
						data:{path:path, action:action},
						success:function(data){
							alert(data);
							$('#filelistModal').modal('hide');
							load_folder_list();
						}
					})
				}else{
					return false;
				}
			});

			// Remove/Delete folder
			$(document).on('click', '.delete', function(){
				var folder_name = $(this).data("name");
				var action = "delete";
				if(confirm("Are you sure to delete the folder?")){
					$.ajax({
						url:"uploads/action.php",
						method:"POST",
						data:{folder_name:folder_name, action:action},
						success:function(data){
							load_folder_list();
							alert(data);
						}
					})
				}else{
					return false;
				}
			});
		});
	</script>

<?php include ('includes/footer.php'); } ?>