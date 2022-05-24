<?php
	include_once 'header.php';
?>
	<head>
		<title>Home Page</title>
		<link rel="stylesheet" href="css\style.css">
	</head>

	<body class="main-page">
		<div class="heading">
			<h1>Welcome to #companyName#</h1>
		</div>
		<!--Content Section-->
		<?php
			if(isset($_SESSION["USER_ID"])){
				if($_SESSION["TYPE"] === "CUSTOMER"){
					header("location: index.php");
				}
			};
		?>
		<div class="content">
			<div class="row">
				<div class="column">
					<div class="card-content">
						<h4 class="card-title"><b>Who needs help?</b></h4>
						<p>See customers in your area that need help</p>
						<a href = "help-finder.php" class="forceLink"> Check Now </a>
					</div>
					<div class="card-content">
						<h4 class="card-title"><b>Service history</b></h4>
						<p>See your service history</p>
						<a href = "service-history.php" class="forceLink"> Check Now </a>
					</div>
				</div>
				<div class="column">
					<div class="card-content">
						<h4 class="card-title"><b>Manage Membership</b></h4>
						<p>Manage your membership</p>
						<button class="btnMngMem"> Check Now </button>
					</div>
					<div class="card-content">
						<h4 class="card-title"><b>Reviews</b></h4>
						<p>See how customers have reviewed your service</p>
						<a href = "reviews.php" class="forceLink"> Check Now </a>
					</div>
				</div>
			</div>
		</div>
		
	</body>
	
	
<?php
	include_once 'footer.php';
?>