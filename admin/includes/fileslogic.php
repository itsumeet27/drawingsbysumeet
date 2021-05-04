<?php
    if(isset($_SESSION['username'])){
        $user_id = $_SESSION['admin_id'];
        if (isset($_POST['save'])) { // if save button on the form is clicked

            $folder_name = $_POST['hidden_folder_name'];
            // name of the uploaded file
            $filename = $_FILES['myfile']['name'];

            $path = 'uploads/' . $folder_name;
            // destination of the file on the server
            $destination = $path . '/' . $filename;

            // get the file extension
            $extension = pathinfo($filename, PATHINFO_EXTENSION);

            // the physical file on a temporary uploads directory on the server
            $file = $_FILES['myfile']['tmp_name'];
            $size = $_FILES['myfile']['size'];

            if (!in_array($extension, ['zip', 'pdf', 'docx', 'xlsx', 'pptx', 'txt', 'doc', 'xls', 'ppt', 'jpg', 'png', 'gif','JPG','PNG'])) {
                echo "<span class='text-danger p-3'>Your file extension must be .zip, .pdf, .docx, .xlsx, .pptx, .txt, .doc, .xls, .ppt, .jpg, .png, .gif</span>";
            } elseif ($_FILES['myfile']['size'] > 10000000) { // file shouldn't be larger than 10Megabyte
                echo "<span class='text-danger p-3'>File too large!</span>";
            } else {
                // move the uploaded (temporary) file to the specified destination
                if (move_uploaded_file($file, $destination)) {

                    $sqlFolder = "SELECT * FROM folders WHERE folder_name = '$folder_name'";
                    $runFolder = mysqli_query($db, $sqlFolder);

                    while($folder = mysqli_fetch_array($runFolder)){
                        $folder_id = $folder['id'];
                        $filecount = $folder['filecount'];
                        $name = $folder['folder_name'];
                        if($folder_name === $name){
                            $sql = "INSERT INTO files (user_id, folder_id, name, size, downloads) VALUES ('$user_id','$folder_id','$filename', $size, 0)";
                            if (mysqli_query($db, $sql)) {
                                echo "<script>alert('File Uploaded Successfully!');</script>";
                                $newfilecount = $filecount + 1;
                                $updateCount = "UPDATE folders SET filecount = '$newfilecount' WHERE id = '$folder_id'";
                                mysqli_query($db, $updateCount);
                                echo "<script>window.open('repository.php','_self')</script>";
                            }else {
                                echo "<script>alert('Failed to upload your file!');</script>";
                                echo "<script>window.open('repository.php','_self')</script>";
                            }
                        }
                    }
                    
                }else {
                        echo "<script>alert('Failure in file uploading!');</script>";
                        echo "<script>window.open('repository.php','_self')</script>";
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