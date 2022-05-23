<?php
	require_once 'vendor/autoload.php';
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
	
	function genUsers($iter){
		include 'dbh.inc.php';
		$faker = Faker\Factory::create();
		for($i = 0; $i < $iter; $i++){
			$name = $faker->name();
			$username = $faker->safeEmail();
			$password = $faker->password();
			$name = $faker->name();
			$phone = intval(04).$faker->randomNumber(8, true);
			$dob = $faker->dateTimeBetween('', '-15 years')->format('Y-m-d');
			createUser($conn, $name, $username, $password, $phone, $dob);
		}
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
	
	function getUname(){
		return ($_SESSION["USERNAME"]);
		
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
	
	function carCheck($conn, $username){
		$sql = "SELECT * FROM customer JOIN motor on customer.MOTOR_NUM = motor.NUM_PLATE WHERE USERNAME = ?;";
		
		$stmt = mysqli_stmt_init($conn);
		
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../index.php?error=sqlStatementFailed");
		}
		
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		
		$resultDat = mysqli_stmt_get_result($stmt);
		
		if($row = mysqli_fetch_assoc($resultDat)){
			session_start();
			$_SESSION["CAR_MODEL"] = $row["MODEL"];
			return($row);
			
		}
		else{
			session_start();
			$_SESSION["CAR_MODEL"] = "";
			return(false);
		}
		
		
		
		mysqli_stmt_close($stmt);
		
		
	}
	
	function MembershipCheck($conn, $username){
		$sql = "SELECT * FROM customer JOIN membership on customer.MEMBER_ID = membership.MEMBERSHIP_ID WHERE USERNAME = ?;";
		
		$stmt = mysqli_stmt_init($conn);
		
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../signup.php?error=sqlStatementFailed");
		}
		
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		
		$resultDat = mysqli_stmt_get_result($stmt);
		
		if($row = mysqli_fetch_assoc($resultDat)){
			$_SESSION["MEMBER_ID"] = $row["MEMBER_ID"];
			$_SESSION["ANNUAL_FEE"] = $row["ANNUAL_FEE"];
			$_SESSION["EXPIRY_DATE"] = $row["EXPIRY_DATE"];
			$_SESSION["NUM_OF_USE"] = $row["NUM_OF_USE"];
			return($row);
		}
		else{
			$_SESSION["MEMBER_ID"] = "";
			$_SESSION["ANNUAL_FEE"] = "";
			$_SESSION["EXPIRY_DATE"] = "";
			$_SESSION["NUM_OF_USE"] = "";
			return(false);
		}
		
		
		
		mysqli_stmt_close($stmt);
		
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
				$_SESSION["DOB"] = $uidExists["DOB"];
				$_SESSION["PHONE"] = $uidExists["PHONE"];
				$_SESSION["TYPE"] = "CUSTOMER";
				$_SESSION["ADDRESS"] = $uidExists["ADDRESS"];
				$_SESSION["MOTOR_NUM"] = $uidExists["MOTOR_NUM"];
				$_SESSION["MEMBER_ID"] = $uidExists["MEMBER_ID"];
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
				$_SESSION["DOB"] = $uidExists["DOB"];
				$_SESSION["TYPE"] = "PROFESSIONAL";
				$_SESSION["PHONE"] = $uidExists["PHONE"];
				header("location: ../prof-index.php?LoggedIn");
				exit();
			}
			
		}
		else{
			header("location: ../login.php?error=criticalError");
			exit();
		}
	}
	
	function updateUser($conn, $username, $phone, $address, $license, $model){
		$uidExists = uidExists($conn, $username);
		$membership = MembershipCheck($conn, $username);
		$carCheck = carCheck($conn, $username);
		$member_id = $uidExists["MEMBER_ID"];
		
		if($uidExists === false){
			header("location: ../profile-update.php?error=sqlFail");
			exit();
		}
		
		if(!$carCheck){
			$sql = "INSERT INTO motor (MODEL, NUM_PLATE) VALUES (?,?);";
			$stmt = mysqli_stmt_init($conn);
			
			if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../signup.php?error=sqlStatementFailed");
			exit();
			}
			mysqli_stmt_bind_param($stmt, "ss", $model, $license);
			mysqli_stmt_execute($stmt);
			
			mysqli_stmt_close($stmt);
			
		}
		$sql = "UPDATE customer SET PHONE = ?, ADDRESS = ?, MOTOR_NUM = ?, MEMBER_ID = ? WHERE USERNAME = '". $username ."';";
		
		$stmt = mysqli_stmt_init($conn);
		
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../profile-update.php?error=sqlStatementFailed");
			exit();
		}
		
		mysqli_stmt_bind_param($stmt, "ssss", $phone, $address, $license, $member_id);
		mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		session_start();
		$_SESSION["ADDRESS"] = $address;
		$_SESSION["PHONE"] = $phone;
		$_SESSION["MOTOR_NUM"] = $license;
		$_SESSION["MODEL"] = $model;
		
		
		header("location: ../index.php?error=none");
		exit();		
	}
	
	function updateMembeship($conn, $username, $memberType, $uses){
		$uidExists = uidExists($conn, $username);
		$membership = MembershipCheck($conn, $username);
		$member_id = $uidExists["MEMBER_ID"];
		$cost = 0;
		$basic = 99;
		$extended = 299;
		$single = 50;
		$zero = "0";
		
		if($memberType === 'basic'){
			$sql="INSERT INTO membership (ANNUAL_FEE, EXPIRY_DATE, NUM_OF_USE) values (?,CURRENT_DATE(),?);";
			$stmt = mysqli_stmt_init($conn);
		
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("location: ../membership-update-update.php?error=sqlStatementFailed");
				exit();
			}
			mysqli_stmt_bind_param($stmt, "ss", $basic, $zero);
			mysqli_stmt_execute($stmt);
			
			mysqli_stmt_close($stmt);
		}
		elseif($memberType === 'extended'){
			$sql="INSERT INTO membership (ANNUAL_FEE, EXPIRY_DATE, NUM_OF_USE) values (?,CURRENT_DATE(),?);";
			$stmt = mysqli_stmt_init($conn);
		
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("location: ../membership-update.php?error=sqlStatementFailed");
				exit();
			}
			mysqli_stmt_bind_param($stmt, "ss", $extended, $zero);
			mysqli_stmt_execute($stmt);
			
			mysqli_stmt_close($stmt);
			
		}
		elseif($memberType === 'single'){
			$sql="INSERT INTO membership (ANNUAL_FEE, EXPIRY_DATE, NUM_OF_USE) values (?,CURRENT_DATE(),?);";
			$stmt = mysqli_stmt_init($conn);
		
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("location: ../membership-update.php?error=sqlStatementFailed");
				exit();
			}
			$blank = "";
			$newUses = intval($uses) + intval($membership["NUM_OF_USE"]);
			mysqli_stmt_bind_param($stmt, "ss", $blank, $newUses);
			mysqli_stmt_execute($stmt);
			
			mysqli_stmt_close($stmt);
			
		}
		$ID = mysqli_insert_id($conn);
		
		$sql = "UPDATE customer SET MEMBER_ID = '" . $ID . "' WHERE USERNAME = '" . $username . "';";
		
		$stmt = mysqli_stmt_init($conn);
		
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../membership-update.php?error=sqlStatementFailed");
			exit();
		}
		#mysqli_stmt_bind_param($stmt, "ss", $extended, $zero);
		mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		$membership = MembershipCheck($conn, $username);
		header("location: ../index.php?error=" . $ID . "");
	}