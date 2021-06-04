<?php  
	include('../../includes/init.php');
	$id = $_POST["id"];  
	$text = $_POST["text"];  
	$column_name = $_POST["column_name"];  
	$sql = "UPDATE admin SET ".$column_name."='".$text."' WHERE id='".$id."'";  
	if(mysqli_query($db, $sql))  
	{  
		echo 'Data Updated';  
	}  
 ?>