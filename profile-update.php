<?php
	include_once 'header.php';
	
	if(!isset($_SESSION["USER_ID"])){
		header("location: index.php?");
	}
	else{
		require_once 'includes/dbh.inc.php';
		require_once 'includes/functions.inc.php';
		
		$memRow = MembershipCheck($conn, $_SESSION["USERNAME"]);
		$carRow = carCheck($conn, $_SESSION["USERNAME"]);
		
	};
?>

<!--  put HTML/PHP code here -->

<body class="profileUpdate">
	<section class="form">
		<div class="image">
			<img src="img/car-icon.png" alt="Car" class="car-icon">
		</div>
		<div class="update-box">
			<h2>Update information</h2>
			<table class = "profileTable">
				<tr>
					<td>Full Name: </td>
					<td>
					<?php 
					echo($_SESSION["NAME"]);
					?>
					</td>
				</tr>
				<tr>
					<td>email: </td>
					<td>
					<?php 
					echo($_SESSION["USERNAME"]);
					?>
					</td>
				</tr>
				<tr>
					<td>DOB: </td>
					<td>
					<?php 
					echo($_SESSION["DOB"]);
					?>
					</td>
				</tr>
			</table>
			<form action="includes/profile-update.inc.php" method="post">
				<div class="container">
					<?php
					echo("<input type = 'hidden' readonly name='username' value = '" . $_SESSION["USERNAME"] . "'></input>");
					
					echo("<label for='phone'><b>Phone Number</b></label>");
					echo("<input type='text' name='phone' value='" . $_SESSION["PHONE"] . "' required></input>");
					
					if($_SESSION["TYPE"] === "CUSTOMER"){
						echo("<label for='address'><b>Address</b></label>");
						if(isset($_SESSION["ADDRESS"])){
							echo("<input type='text' name='address' value='" . $_SESSION["ADDRESS"] . "' required></input>");
						}
						else{
							echo("<input type='text' name='address' value='' required></input>");
						}
						echo("<label for='license'><b>License plate</b></label>");
						if(isset($carRow["NUM_PLATE"])){
							echo("<input type='text' name='license' value='" . $carRow["NUM_PLATE"] . "' required></input>");
						}
						else{
							echo("<input type='text' name='license' value='' required></input>");
						}
						
						
						echo("<label for='model'><b>Car Model</b></label>");
						if(isset($carRow["MODEL"])){
							echo("<input type='text' name='model' value='" . $carRow["MODEL"] . "' required> </input>");
						}
						else{
							echo("<input type='text' name='model' value='' required> </input>");
						}
						
					}
					
					
					?>
					
				</div>
				
				<button class="btnLogin" type="submit" name="submit"> Submit </button>
				<br/>
				
			</form>
		</div>
	</section>	
</body>

<?php
	include_once 'footer.php';
?>