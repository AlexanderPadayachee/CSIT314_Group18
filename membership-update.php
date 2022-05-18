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
				<tr>
					<td>Insurance Member Number: </td>
					<td>
					<?php 
					echo($_SESSION["MEMBER_ID"]);
					?>
					</td>
				</tr>
				<tr>
					<td>Current Annual Fee: </td>
					<td>
					<?php 
					echo($_SESSION["ANNUAL_FEE"]);
					?>
					</td>
				</tr>
				<tr>
					<td>Expiry Date: </td>
					<td>
					<?php 
					echo($_SESSION["EXPIRY_DATE"]);
					?>
					</td>
				</tr>
				<tr>
					<td>Number of Uses: </td>
					<td>
					<?php 
					echo($_SESSION["NUM_OF_USE"]);
					?>
					</td>
				</tr>
			</table>
			
			<form action="includes/membership-update.inc.php" method="post">
				<div class="container">
					<?php
						
						
						echo("<label for='memberType'><b>Membership Type</b></label>");
						echo("<select name='memberType' required>");
						echo("<option value = 'basic'>Basic Coverage</option>");
						echo("<option value = 'extended'>Extended Coverage</option>");
						echo("<option value = 'extended'>Single Use</option>");	
						echo("</select></br></br></br></br>");
						
						echo("<label for='uses'><b>Amount of uses you wish to buy</b></label>");
						echo("<input type='text' name='uses' value='0' required>");
					?>
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