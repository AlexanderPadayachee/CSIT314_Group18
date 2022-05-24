<?php 
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
	if(isset($_POST["updateService"])){
		$serviceID = $_POST["serviceID"];
		$profID = $_POST["ProfID"];
		assignProf($conn, $serviceID, $profID);1
		#echo("check");
		header("location: ../help-finder.php");
	}
	if(isset($_POST["FinishService"])){
		$serviceID = $_POST["serviceID"];
		finishService($conn, $serviceID);
		#echo("check");
		header("location: ../help-finder.php");
	}
	
	