<?php
	if(isset($_POST["submit"])){
		$name = $_POST["name"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$pwdrepeat = $_POST["pwdrepeat"];
		$phone = $_POST["phone"];
		$dob = $_POST["dob"];
		
		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';
		
		if(emptyInputSignup($name, $username, $password, $pwdrepeat, $phone) !== false){
			header("location: ../professional-signup.php?error=emptyinput");
			exit();
		}
		if(invalidUid($username) !== false){
			header("location: ../professional-signup.php?error=invalidUid");
			exit();
		}
		if(pwdMatch($password, $pwdrepeat) !== false){
			header("location: ../professional-signup.php?error=passMatch");
			exit();
		}
		if(uidExists($conn, $username) !== false){
			header("location: ../professional-signup.php?error=usernameTaken");
			exit();
		}
		
		if(profExists($conn, $username) !== false){
			header("location: ../professional-signup.php?error=usernameTaken");
			exit();
		}
		
		
		createProfessional($conn, $name, $username, $password, $phone, $dob);
		sleep(2);
		loginUser($conn, $username, $password);
		
		
	}
	else{
		header("location: ../professional-signup.php");
		exit();
	}