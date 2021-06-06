<?php  
include('../../includes/init.php');
$sql = "INSERT INTO videos(title, url) VALUES('".$_POST["title"]."', '".$_POST["url"]."')";  
if(mysqli_query($db, $sql))  
{  
     echo 'Data Inserted';  
}  
 ?>