<?php
	include_once 'header.php';
	
	if(!isset($_SESSION["USER_ID"])){
		header("location: index.php?");
	}
	else{
		require_once 'includes/dbh.inc.php';
		require_once 'includes/functions.inc.php';
		
		MembershipCheck($conn, $_SESSION["USERNAME"]);
		carCheck($conn, $_SESSION["USERNAME"]);
		
		
	};
	
?>

<head>
<link rel="stylesheet" href="css\profile.css">
</head>
<body class="profileUpdate">
	<section class="form">
		<div class="image">
			<img src="img/car-icon.png" alt="Car" class="car-icon">
		</div>
		<div class="update-box">
			<h2>Update information</h2>
			
			
			<table class = "profileTable">
				<tr>
					<td>Full Name </td>
					<td>:</td>
					<td>
					<?php 
					echo($_SESSION["NAME"]);
					?>
					</td>
				</tr>
				<tr>
					<td>Email </td>
					<td>:</td>
					<td>
					<?php 
					echo($_SESSION["USERNAME"]);
					?>
					</td>
				</tr>
				<tr>
					<td>DOB </td>
					<td>:</td>
					<td>
					<?php 
					echo($_SESSION["DOB"]);
					?>
					</td>
				</tr>
				<tr>
					<td>Insurance Member Number </td>
					<td>:</td>
					<td>
					<?php 
					echo($_SESSION["MEMBER_ID"]);
					?>
					</td>
				</tr>
				<tr>
					<td>Current Annual Fee </td>
					<td>:</td>
					<td>
					<?php 
					echo($_SESSION["ANNUAL_FEE"]);
					?>
					</td>
				</tr>
				<tr>
					<td>Expiry Date </td>
					<td>:</td>
					<td>
					<?php 
					echo($_SESSION["EXPIRY_DATE"]);
					?>
					</td>
				</tr>
				<tr>
					<td>Number of Uses </td>
					<td>:</td>
					<td>
					<?php 
					echo($_SESSION["NUM_OF_USE"]);
					?>
					</td>
				</tr>
			</table>
			
			<form action="includes/membership-update.inc.php" method="post">
				<div class="container">
					<label>Username</label>
					<?php
						echo("<input readonly name='username' value = '" . $_SESSION["USERNAME"] . "'></br></br></br>");
					?>
					<label for='memberType'><b>Membership Type</b></label>
					<select name='memberType' required>
						<option value = 'basic'>Basic Coverage</option>
						<option value = 'extended'>Extended Coverage</option>
						<option value = 'single'>Single Use</option>
					</select></br></br></br></br>
					
					<label for='uses'><b>Amount of uses you wish to buy</b></label>
					<input type='text' name='uses' value='0' required>
					
				</div>
				
				
				<br/>
				<button class="Btn" type="submit" name="submit"> Submit </button>
			</form>
		</div>
	</section>	
</body>





<?php
	include_once 'footer.php';
?>