<?php
    if(isset($_SESSION['username'])){
        $user_id = $_SESSION['admin_id'];
        if (isset($_POST['save'])) { // if save button on the form is clicked

            $folder_name = $_POST['hidden_folder_name'];
            $extension = array('jpeg','jpg','png','gif','JPG','PNG');
            foreach ($_FILES['myfile']['name'] as $key => $value) {

                $filename = $_FILES['myfile']['name'][$key];
                $filename_temp = $_FILES['myfile']['tmp_name'][$key];
                $path = 'uploads/' . $folder_name;
                echo '<br>';
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                if(in_array($ext, $extension)){
                    if(!file_exists($path . '/' . $filename)){
                        move_uploaded_file($filename_temp, $path . '/' . $filename);
                        $finalimg = $filename;
                    }else{
                        $filename = str_replace('.','-',basename($filename,$ext));
                        $newfilename = $filename.time().".".$ext;
                        move_uploaded_file($filename_temp, $path . '/' . $newfilename);
                        $finalimg = $newfilename;
                    }

                    $sqlFolder = "SELECT * FROM folders WHERE folder_name = '$folder_name'";
                    $runFolder = mysqli_query($db, $sqlFolder);

                    while($folder = mysqli_fetch_array($runFolder)){
                        $folder_id = $folder['id'];
                        $filecount = $folder['filecount'];
                        $name = $folder['folder_name'];
                        if($folder_name === $name){
                            $sql = "INSERT INTO files (user_id, folder_id, name) VALUES ('$user_id','$folder_id','$finalimg')";

                            if ($db->query($sql)) {
                                echo "<script>alert('File Uploaded Successfully!');</script>";
                                $newfilecount = $filecount + 1;
                                $updateCount = "UPDATE folders SET filecount = '$newfilecount' WHERE id = '$folder_id'";
                                $db->query($updateCount);
                                echo "<script>window.open('categories.php','_self')</script>";
                            }else {
                                echo "<script>alert('Failed to upload your file!');</script>";
                                echo "<script>window.open('categories.php','_self')</script>";
                            }
                        }
                    }
                    
                }else{
                    //display error
                }
            }
        }

        if(isset($_POST['upload_feature_image'])){

            $feature_folder_name = $_POST['hidden_feature_folder_name'];

            $feature_image = $_FILES['feature_image']['name'];

            $feature_path = 'uploads/feature_banner_images';
            // destination of the file on the server
            $feature_destination = $feature_path . '/' . $feature_image;

            // get the file extension
            $feature_extension = pathinfo($feature_image, PATHINFO_EXTENSION);

            // the physical file on a temporary uploads directory on the server
            $feature_file = $_FILES['feature_image']['tmp_name'];
            $feature_size = $_FILES['feature_image']['size'];

            if (!in_array($feature_extension, ['jpg', 'png', 'gif', 'jpeg', 'JPG', '.PNG'])) {
                echo "<span class='text-danger p-3'>Your file extension must be .jpg, .png, .gif</span>";
            } elseif ($_FILES['feature_image']['size'] > 10000000) { // file shouldn't be larger than 10Megabyte
                echo "<span class='text-danger p-3'>File too large!</span>";
            } else {
                // move the uploaded (temporary) file to the specified destination
                if (move_uploaded_file($feature_file, $feature_destination)) {
                    if($db->query("UPDATE folders SET feature_image = '$feature_image' WHERE folder_name = '$feature_folder_name'")){
                        echo "<div class='alert alert-success'>Feature image uploaded</div>";
                    }
                }
            }
        }

        if(isset($_POST['upload_banner_image'])){

            $banner_folder_name = $_POST['hidden_banner_folder_name'];

            $banner_image = $_FILES['banner_image']['name'];

            $banner_path = 'uploads/feature_banner_images';
            // destination of the file on the server
            $banner_destination = $banner_path . '/' . $banner_image;

            // get the file extension
            $banner_extension = pathinfo($banner_image, PATHINFO_EXTENSION);

            // the physical file on a temporary uploads directory on the server
            $banner_file = $_FILES['banner_image']['tmp_name'];
            $banner_size = $_FILES['banner_image']['size'];

            if (!in_array($banner_extension, ['jpg', 'png', 'gif', 'jpeg', 'JPG', '.PNG'])) {
                echo "<span class='text-danger p-3'>Your file extension must be .jpg, .png, .gif</span>";
            } elseif ($_FILES['banner_image']['size'] > 10000000) { // file shouldn't be larger than 10Megabyte
                echo "<span class='text-danger p-3'>File too large!</span>";
            } else {
                // move the uploaded (temporary) file to the specified destination
                if (move_uploaded_file($banner_file, $banner_destination)) {
                    if($db->query("UPDATE folders SET banner_image = '$banner_image' WHERE folder_name = '$banner_folder_name'")){
                        echo "<div class='alert alert-success'>Banner image uploaded</div>";
                    }
                }
            }
        }
    }

    // Downloads files
    if (isset($_GET['file_id'])) {
        $id = $_GET['file_id'];

        // fetch file to download from database
        $download = "SELECT * FROM files WHERE id=$id";
        $result = mysqli_query($db, $download);

        $file = mysqli_fetch_assoc($result);
        $filepath = $path . '/' . $file['name'];

        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($path . '/' . $file['name']));
            readfile($path . '/' . $file['name']);

            // Now update downloads count
            $newCount = $file['downloads'] + 1;
            $updateQuery = "UPDATE files SET downloads=$newCount WHERE id=$id";
            mysqli_query($db, $updateQuery);
            exit;
        }

    }

?>