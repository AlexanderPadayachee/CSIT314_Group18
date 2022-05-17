<?php
	if(isset($_POST["submit"])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';
		
		header("location: ../profile-update.php?error=emptyinput"); #### comment this out later
		exit();
		
		#loginUser($conn, $username, $password);
	}
	else{
		header("location: ../login.php");
		exit();
	}


