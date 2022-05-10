<?php
	include_once 'header.php';
?>

<head>
	<title> Company Name </title>
	<link rel="stylesheet" href="css\style.css">
</head>

<body class="signupPage">
	<section class="form">
		<div class="image">
			<img src="img/car-icon.png" alt="Car" class="car-icon">
		</div>
		<div class="signup-box">
			<h2>Sign Up</h2>
			<form action="includes/signup.inc.php" method="post">
				<label for="name"><b>Full Name</b></label>
				<input type="text" name="name" placeholder="Input full name" required></br>

				<label for="username"><b>Username</b></label>
				<input type="text" name="username" placeholder="Input email" required></br>

				<label for="password"><b>Password</b></label>
				<input type="password" name="password" placeholder="Input password" required></br>

				<label for="pwdrepeat"><b>Confirm Password</b></label>
				<input type="password" name="pwdrepeat" placeholder="Confirm password" required></br>

				<label for="phone"><b>Phone Number</b></label>
				<input type="text" name="phone" placeholder="Input phone number" required></br>

				<?php
					if(isset($_GET["error"])){
						if($_GET["error"] == "emptyinput"){
							echo"<p class = 'signup error'> Fill in all fields</p>";
						}
						else if($_GET["error"] == "invalidUid"){
							echo"<p class = 'signup error'> Email must be valid </p>";
						}
						else if($_GET["error"] == "passMatch"){
							echo"<p class = 'signup error'> Passwords must match </p>";
						}
						else if($_GET["error"] == "usernameTaken"){
							echo"<p class = 'signup error'> Email already in use </p>";
						}
						else if($_GET["error"] == "sqlStatementFailed"){
							echo"<p class = 'signup error'> SQL error. user not created. Try again</p>";
						}
						else if($_GET["error"] == "none"){
							echo"<p class = 'signup error'> User Successfully signed up </p>";
						};

					};
	
				?>

				<button class="btnSignup" type = "submit" name = "submit"> Sign Up </button>
			</form>
		</div>
	</section>
</body>

<?php
	include_once 'footer.php';
?>