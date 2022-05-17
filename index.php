<?php
	include_once 'header.php';
	
	
?>
	<head>
		<title>Home Page</title>
		<link rel="stylesheet" href="css\style.css">
		
		
		
	</head>
	<?php
		if(isset($_SESSION["USER_ID"])){
			if($_SESSION["TYPE"] === "PROFESSIONAL"){
				header("location: prof-index.php");
			}
		};
	?>
	<meta http-equiv="refresh" content="=0;URL=index.php" />
	<body class="main-page">
		<div class="heading">
			<h1>Welcome to #companyName#</h1>
		</div>
		<!--Content Section-->	
		<div class="content">
			<div class="row">
				<div class="column">
					
					<div class="card-content">
						<h4 class="card-title"><b>Membership Options</b></h4>
						<p>See how much our membership subscription will cost you</p>
						<a href = "subscriptions.php" class="forceLink"> Check Now </a>
					</div>
					<div class="card-content">
						<h4 class="card-title"><b>Make Service Request</b></h4>
						<p>Make a service request to have our roadside assistants help you</p>
						<button class="btnMngMem"> Check Now </button>
					</div>
				</div>
				<div class="column">
					<div class="card-content">
						<h4 class="card-title"><b>Manage Membership</b></h4>
						<p>Manage your membership</p>
						<a href = "profile-update.php" class="forceLink"> Check Now </a>
					</div>
					<div class="card-content">
						<h4 class="card-title"><b>View Professionals</b></h4>
						<p>See how many professionals available in your local area</p>
						<button class="btnViewPro"> Check Now </button>
					</div>
				</div>
			</div>
		</div>
		
	</body>
	
	
<?php
	include_once 'footer.php';
?>