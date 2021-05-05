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