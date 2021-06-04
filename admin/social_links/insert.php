<?php  
include('../../includes/init.php');
$sql = "INSERT INTO social (facebook, instagram, tumblr, deviantart, pinterest, youtube, behance) VALUES ('".$_POST["facebook"]."', '".$_POST["instagram"]."', '".$_POST["tumblr"]."', '".$_POST["deviantart"]."', '".$_POST["pinterest"]."', '".$_POST["youtube"]."', '".$_POST["behance"]."')";  
if(mysqli_query($db, $sql))  
{  
     echo 'Data Inserted';
}  
 ?>