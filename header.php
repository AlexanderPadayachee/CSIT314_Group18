<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset = "utf-8">
		<title> Roadside Assistant Service </title>
		<link rel="stylesheet" href="css\style.css">
	</head>
	
	<body>
		<header>
			<div class="logo">
				<img src="../img/car-icon.png" class="logo-img" />
				<span class="company-name">Company Name</span>
			</div>
			<nav>
				<div class = "wrapper">
						<a href = "index.php">Home</a>
						<?php
							if(isset($_SESSION["USER_ID"])){
								echo"<a href = 'profile-page.php'>  Profile  </a></li>";
								echo"<a href = 'membership-update.php'>  Update Membership  </a></li>";
								echo"<a href = 'service-request.php'>  Request Service  </a></li>";
								echo"<a href = 'includes/logout.inc.php'>  Log out  </a></li>";
								echo"<a class = headerBar>User: " . $_SESSION["NAME"] . "</a>";
							}
							else{ 
								echo"<a href = 'signup.php'>Sign Up</a></li>";
								echo"<a href = 'login.php'>Login</a></li>";
							}
						?>
						<!--
						<li><a href = ""> </a></li>
						-->
						
				</div>
			</nav>
		</header>
	</body>
