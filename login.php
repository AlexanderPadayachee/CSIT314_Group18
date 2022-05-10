<?php
	include_once 'header.php';
?>

<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="css\style.css">
</head>

<body class="loginPage">
<!--Login form-->
	<section class="form">
		<div class="image">
			<img src="img/car-icon.png" alt="Car" class="car-icon">
		</div>
		<div class="login-box">
			<h2>Log In</h2>
			<form action="includes/login.inc.php" method="post">
				<div class="container">
					<label for="username"><b>Email</b></label>
					<input type="text" name="username" placeholder="Input your email" required>
					<label for="password"><b>Password</b></label>
					<input type="password" name="password" placeholder="Input your password" required>
				</div>
				<!--Login Constraint-->
				<?php
					if(isset($_GET["error"])){
						if($_GET["error"] == "emptyinput"){
							echo"<p class = 'signup error'> Fill in all fields</p>";
						}
						else if($_GET["error"] == "wronglogin"){
							echo"<p class = 'signup error'> Username or password incorrect </p>";
						}
						else if($_GET["error"] == "sqlStatementFailed"){
							echo"<p class = 'signup error'> SQL error. user not created. Try again</p>";
						}
						else if($_GET["error"] == "none"){
							echo"<p class = 'signup error'></p>";
						};
					};
				?>
				<button class="btnLogin" type="submit" name="submit"> Log In </button>
				<br/>
				<span class="forgot-password">Forgot your password?</span>
			</form>
		</div>
	</section>	
</body>
	
<?php
	include_once 'footer.php';
?>