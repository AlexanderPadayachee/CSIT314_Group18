<?php
	function emptyInputSignup($name, $username, $password, $pwdrepeat, $phone){
		$result;
		if(empty($name) || empty($username)|| empty($password) || empty($pwdrepeat) || empty($phone)){
			$result = true;
		}
		else{
			$result = false;
		}
		return $result;
	}
	
	function invalidUid($username){
		$result;
		if(!filter_var($username, FILTER_VALIDATE_EMAIL)){
			$result = true;
		}
		else{
			$result = false;
		}
		return $result;
	}
	
	function pwdMatch($password, $pwdrepeat){
		$result;
		if($password !== $pwdrepeat){
			$result = true;
		}
		else{
			$result = false;
		}
		return $result;
	}
	
	function profExists($conn, $username){
		$sql = "SELECT * FROM professional WHERE USERNAME = ?;";
		
		$stmt = mysqli_stmt_init($conn);
		
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../signup.php?error=sqlStatementFailed");
		}
		
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		
		$resultDat = mysqli_stmt_get_result($stmt);
		
		if($row = mysqli_fetch_assoc($resultDat)){
			return $row;
		}
		else{
			$result = false;
			return $result;
		}
		mysqli_stmt_close($stmt);
	}
	
	function uidExists($conn, $username){
		$sql = "SELECT * FROM customer WHERE USERNAME = ?;";
		
		$stmt = mysqli_stmt_init($conn);
		
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../signup.php?error=sqlStatementFailed");
		}
		
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		
		$resultDat = mysqli_stmt_get_result($stmt);
		
		if($row = mysqli_fetch_assoc($resultDat)){
			return $row;
		}
		else{
			$result = false;
			return $result;
		}
		mysqli_stmt_close($stmt);
	}
	
	
	
	function createUser($conn, $name, $username, $password, $phone, $dob){
		$sql = "INSERT INTO customer (USERNAME, PASSWORD, CUS_NAME, DOB, PHONE) VALUES (?,?,?,?,?);";
		
		$stmt = mysqli_stmt_init($conn);
		
		$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
		
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../signup.php?error=sqlStatementFailed");
			exit();
		}
		
		mysqli_stmt_bind_param($stmt, "sssss", $username, $hashedPwd, $name, $dob, $phone);
		mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		header("location: ../signup.php?error=none");
		exit();
		
	}
	
	function createProfessional($conn, $name, $username, $password, $phone, $dob){
		
		$sql = "INSERT INTO professional (USERNAME, PASSWORD, PRO_NAME, DOB, PHONE) VALUES (?,?,?,?,?);";
		
		$stmt = mysqli_stmt_init($conn);
		
		$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
		
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../professional-signup.php?error=sqlStatementFailed");
			exit();
		}
		
		mysqli_stmt_bind_param($stmt, "sssss", $username, $hashedPwd, $name, $dob, $phone);
		mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		header("location: ../professional-signup.php?error=none");
		exit();
		
		
		
	}
	
	
	function emptyInputlogin($username, $password){
		$result;
		if(empty($username)|| empty($password)){
			$result = true;
		}
		else{
			$result = false;
		}
		return $result;
	}
	
	function loginUser($conn, $username, $password){
		$uidExists = uidExists($conn, $username);
		$profExists = profExists($conn, $username);
		
		
		
		if($uidExists === false && $profExists === false){
			header("location: ../login.php?error=wronglogin");
			exit();
		}
		
		if($profExists === false){
			$pwdhashed = $uidExists["PASSWORD"];
			$checkPwd = password_verify($password, $pwdhashed);
			
			
			
			if($checkPwd === false){
				header("location: ../login.php?error=WrongPassword");
				exit();
			}
			else if($checkPwd === true){
				session_start();
				$_SESSION["USER_ID"] = $uidExists["USER_ID"];
				$_SESSION["USERNAME"] = $uidExists["USERNAME"];
				$_SESSION["NAME"] = $uidExists["CUS_NAME"];
				$_SESSION["TYPE"] = "CUSTOMER";
				header("location: ../index.php?LoggedIn");
				exit();
			}
		}
		elseif($uidExists === false){
			$pwdhashed = $profExists["PASSWORD"];
			$checkPwd = password_verify($password, $pwdhashed);
			if($checkPwd === false){
				header("location: ../login.php?error=wrongPassword");
				exit();
			}
			else if($checkPwd === true){
				session_start();
				$_SESSION["USER_ID"] = $profExists["USER_ID"];
				$_SESSION["USERNAME"] = $profExists["USERNAME"];
				$_SESSION["NAME"] = $profExists["PRO_NAME"];
				$_SESSION["TYPE"] = "PROFESSIONAL";
				header("location: ../prof-index.php?LoggedIn");
				exit();
			}
			
		}
		else{
			header("location: ../login.php?error=criticalError");
			exit();
		}
	}