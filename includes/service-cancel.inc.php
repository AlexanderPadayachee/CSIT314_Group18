<?php
	if(isset($_POST["submit"])){
		$uid = $_POST["uid"];
	}
	
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
	
	cancelService($conn, $uid);
	
	header("location: ../index.php");