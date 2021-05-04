<?php
	session_start();
	include('../../includes/init.php');

	// Format folder Size
	function format_folder_size($size){
		if($size >= 1073741824){
			$size = number_format($size / 1073741824, 2) . ' GB';
		}elseif($size >= 1048576){
			$size = number_format($size / 1048576, 2) . ' MB';
		}elseif($size >= 1024){
			$size = number_format($size / 1024, 2) . ' KB';
		}elseif($size > 1){
			$size = $size . ' bytes';
		}elseif($size == 1){
			$size = $size . ' byte';
		}else{
			$size = '0 bytes';
		}
		return $size;
	}
	
	// Get folder Size
	function get_folder_size($folder_name){
		$total_size = 0;
		$file_data = scandir($folder_name);
		foreach($file_data as $file){
			if($file === '.' OR $file === '..'){
				continue;
			}else{
				$path = $folder_name . '/' . $file;
				$total_size = $total_size + filesize($path);
			}
		}
		return format_folder_size($total_size);
	}

	if(isset($_SESSION['username'])){
        $user_id = $_SESSION['admin_id'];

		if(isset($_POST['action'])){

			// Fetch all folders
			if($_POST["action"] == "fetch"){
				$folder = array_filter(glob('*'), 'is_dir');
				$output = ' 
					<table class="table table-bordered table-sm table-hover">
						<thead class="indigo lighten-5 elegant-text">
							<th class="font-weight-bold">Folder Name</th>
							<th class="font-weight-bold">Total Files</th>
							<th class="font-weight-bold">Size</th>
							<th class="font-weight-bold">Update folder</th>
							<th class="font-weight-bold">Upload File</th>
							<th class="font-weight-bold">View Files</th>
							<th class="font-weight-bold">Delete</th>
						</thead>
				';
							// <th class="font-weight-bold">Update</th>

				if(count($folder) > 0){
					foreach($folder as $name){
						$output .= '
							<tbody>
								<tr>
									<td><i class="fas fa-folder-open" style="font-size:18px"></i> &nbsp;&nbsp;'.$name.'</td>
									<td>'.(count(scandir($name))-2).'</td>
									<td>'.get_folder_size($name).'</td>
									<td>
										<button type="button" class="btn-floating btn-warning update options" name="update" data-name="'.$name.'" title="Update"><i class="far fa-edit"></i></button>
									</td>
									<td>
										<button type="button" class="btn-floating btn-success upload options" name="upload" data-name="'.$name.'" title="Upload"><i class="fas fa-cloud-upload-alt"></i></i></button>
									</td>
									<td>
										<button type="button" class="btn-floating btn-primary view_files options" name="view_files" data-name="'.$name.'" title="View Files"><i class="far fa-eye"></i></button>
									</td>
									<td>
										<button type="button" class="btn-floating btn-danger options delete" name="delete" data-name="'.$name.'" title="Delete"><i class="far fa-trash-alt"></i></button>
									</td>
								</tr>
							</tbody>
						';
					}
				}else{
					$output .= '
						<tbody>
							<tr>
								<td colspan="6" class="text-danger">No folder found</td>
							</tr>
						</tbody>
					';
				}

				$output .= '</table>';
				echo $output;
			}

			// Create folder
			if($_POST["action"] == "create"){
				if(!file_exists($_POST["folder_name"])){					
					$new_folder = $_POST["folder_name"];
					mkdir($new_folder, 0777, true);
					$created_by = $user_id;
					$filecount = count(scandir($new_folder))-2;
					$size = get_folder_size($new_folder);

					$addFolder = "INSERT INTO folders (folder_name,filecount,created_by) VALUES ('$new_folder','$filecount','$created_by')";
					$runFolder = mysqli_query($db, $addFolder);
					if ($runFolder) {
                        echo "Folder has been created";
                    }
				}else{
					echo "Folder Already Created";
				}
			}

			// Change/Rename folder name
			if($_POST["action"] == "change"){
				if(!file_exists($_POST["folder_name"])){
					$old_name = $_POST['old_name'];
					$new_name = $_POST['folder_name'];

					$readFolders = "SELECT * FROM folders WHERE folder_name = '$old_name'";
					if($db->query($readFolders)){
						rename($old_name, $new_name);						
						$updateFolderName = "UPDATE folders SET folder_name = '$new_name' WHERE folder_name = '$old_name'";
						$runFolderName = mysqli_query($db,$updateFolderName);
						echo "Folder has been renamed";	
					}
				}else{
					echo "Folder Already Created";
				}
			}

			// List all files in folder
			if($_POST["action"] == "fetch_files"){
				$file_data = scandir($_POST["folder_name"]);
				$output = '
					<table class="table table-condensed table-sm table-bordered table-striped">
						<thead>
							<th class="font-weight-bold">File Name</th>
							<th class="font-weight-bold">Delete</th>
						</thead>
				';

				foreach ($file_data as $file) {
					if($file === '.' OR $file === '..'){
						continue;
					}else{
						$path = $_POST["folder_name"] . '/' . $file;
						$output .= '
							<tbody>
								<tr>
									<td>'.$file.'</td>
									<td>
										<button type="button" class="btn-floating btn-danger remove_file" name="remove_file" id="'.$path.'" title="Remove"><i class="far fa-trash-alt"></i></button>
									</td>
								</tr>
							</tbody>
						';
					}
				}

				$output .= '</table>';
				echo $output;
			}

			// Remove/Delete files from folder
			if($_POST["action"] == "remove_file"){
				$path = $_POST["path"];
				$file = basename($path);
				$dirname = dirname($path);

				// Fetch folders from db
				$sqlFolder = "SELECT * FROM folders WHERE folder_name = '$dirname'";
                $runFolder = mysqli_query($db, $sqlFolder);

                while($folder = mysqli_fetch_array($runFolder)){
                    $folder_id = $folder['id'];
                    $filecount = $folder['filecount'];
                    $newfilecount = $filecount - 1;
					if(file_exists($_POST["path"])){
						unlink($_POST["path"]);
						$delFile = "DELETE FROM files WHERE name = '$file'";
						mysqli_query($db, $delFile);
						$updateFolder = "UPDATE folders SET filecount = '$newfilecount' WHERE folder_name = '$dirname'";
						mysqli_query($db, $updateFolder);
						echo "File has been deleted";
					}
                }
			}

			// Remove/Delete folder
			if($_POST["action"] == "delete"){
				$files = scandir($_POST["folder_name"]);
				foreach($files as $file){
					if($file === '.' OR $file === '..'){
						continue;
					}else{
						unlink($_POST["folder_name"] . '/' . $file);
					}
				}

				if(rmdir($_POST["folder_name"])){
					$delete_folder = $_POST["folder_name"];
					$sql = "SELECT * FROM folders WHERE folder_name = '$delete_folder'";
					$result = mysqli_query($db, $sql);

					// Delete folder from files table
					while($folder = mysqli_fetch_array($result)){
						$folder_id = $folder['id'];

						$sqlFile = "SELECT * FROM files WHERE folder_id = '$folder_id'";
						$resultFile = mysqli_query($db, $sqlFile);

						while($file = mysqli_fetch_array($resultFile)) {
							$folder_file_id = $file['folder_id'];
							$deleteFolderFile = "DELETE FROM files WHERE folder_id = '$folder_file_id'";
							mysqli_query($db, $deleteFolderFile);
						}
					}
					
					// Delete folder from folders table
					$deleteFolder = "DELETE FROM folders WHERE folder_name = '$delete_folder'";
					if(mysqli_query($db, $deleteFolder)){
						echo "Folder has been deleted";	
					}
				}
			}
		}
	}
?>