<?php  
include('../../includes/init.php');
$sql = "INSERT INTO about (name, feature_desc, about_desc, salutation, address, mobile, email) VALUES ('".$_POST["name"]."', '".$_POST["feature_desc"]."', '".$_POST["about_desc"]."', '".$_POST["salutation"]."', '".$_POST["address"]."', '".$_POST["mobile"]."', '".$_POST["email"]."')";  
if(mysqli_query($db, $sql))  
{  
     echo 'Data Inserted';  
}  
 ?>