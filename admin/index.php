<?php 
	session_start();
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php','_self')</script>";
	}else{
		include('includes/header.php');
?>

	<h3 class="text-center">Admin Index</h3>

<?php include ('includes/footer.php'); } ?>