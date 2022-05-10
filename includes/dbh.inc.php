<?php

	$servername = "localhost";
	$dBUsername = "root";
	$dBpassword = "";
	$dBname = "314project";

	$conn = mysqli_connect($servername, $dBUsername, $dBpassword, $dBname);
	if(!$conn){
		die("Database Connection Failed: " . mysqli_connect_error());
	}