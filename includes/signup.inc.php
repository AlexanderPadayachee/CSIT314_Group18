<?php
	if(isset($_POST["submit"])){
		$name = $_POST["name"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$pwdrepeat = $_POST["pwdrepeat"];
		$phone = $_POST["phone"];
		
		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';
		
		if(emptyInputSignup($name, $username, $password, $pwdrepeat, $phone) !== false){
			header("location: ../signup.php?error=emptyinput");
			exit();
		}
		if(invalidUid($username) !== false){
			header("location: ../signup.php?error=invalidUid");
			exit();
		}
		if(pwdMatch($password, $pwdrepeat) !== false){
			header("location: ../signup.php?error=passMatch");
			exit();
		}
		if(uidExists($conn, $username) !== false){
			header("location: ../signup.php?error=usernameTaken");
			exit();
		}
		
		
		createUser($conn, $name, $username, $password, $phone);
	}
	else{
		header("location: ../signup.php");
		exit();
	}
