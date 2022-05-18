<?php
	if(isset($_POST["submit"])){
		$username = $_POST["username"];
		
		$phone = $_POST["phone"];
		$address = $_POST["address"];
		$license = $_POST["license"];
		$model = $_POST["model"];
		
		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';
		#$username = getUname();
		
		
		updateUser($conn,$username, $phone, $address, $license, $model);
		
		
		
	}
	else{
		header("location: ../profile-update.php");
		exit();
	}


