<?php  
include('../../includes/init.php');
$sql = "INSERT INTO admin(username, password) VALUES('".$_POST["username"]."', '".$_POST["password"]."')";  
if(mysqli_query($db, $sql))  
{  
     echo 'Data Inserted';  
}  
 ?>