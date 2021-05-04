<?php

	$db = mysqli_connect('localhost', 'root', '', 'drawingsbysumeet');
	if(mysqli_connect_errno()){
		echo "Database connection failed with following errors: ".mysqli_connect_error();
		die();
	}

	require_once $_SERVER['DOCUMENT_ROOT'].'/drawingsbysumeet/config.php';
	

?>