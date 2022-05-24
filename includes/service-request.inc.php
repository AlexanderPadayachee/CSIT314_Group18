<?php
	if(isset($_POST["submit"])){
		$username = $_POST["username"];
		$problem = $_POST["problem"];
		$description = $_POST["description"];
		$PublicIp = $_POST["ip"];
		
		$latitude = "";
		$longitude = "";
		
		
		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';
		
		$new_arr[]= unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$PublicIp));
		
		
		$lat  = $new_arr[0]['geoplugin_latitude'];
		$long  = $new_arr[0]['geoplugin_longitude'];
		
		$ID = createServiceRequest($conn, $username, $problem, $description, $lat, $long);
		
		header("location: ../index.php?error=none");
	}
	else{
		header("location: ../index.php?error=ServiceRequestError");
		exit();
	}