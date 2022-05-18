<?php
	if(isset($_POST["submit"])){
		$username = $_POST["username"];
		$memberType = $_POST["memberType"];
		$uses = $_POST["uses"];
		
		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';
		
		updateMembeship($conn, $username, $memberType, $uses);
		#header("location: ../index.php");
	}
	else{
		header("location: ../login.php");
		exit();
	}


