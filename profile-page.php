<?php
	include_once 'header.php';
	
	if(!isset($_SESSION["USER_ID"])){
		header("location: index.php?");
	}
	else{
		require_once 'includes/dbh.inc.php';
		require_once 'includes/functions.inc.php';
		
		MembershipCheck($conn, $_SESSION["USERNAME"]);
		
	};
	
?>

<style>
	.blackLink{
	color: black !important;

	}
</style>


<!--  put HTML/PHP code here -->
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
		<td>PHONE: </td>
		<td>
		<?php 
		echo($_SESSION["PHONE"]);
		?>
		</td>
	</tr>
	<?php
		if($_SESSION["TYPE"] === "CUSTOMER"){
			echo("<tr><td>Address: </td>  <td>" . $_SESSION["ADDRESS"] . "</td>  </tr>");
			echo("<tr><td>License Plate:  </td>  <td>" . $_SESSION["MOTOR_NUM"] . " </td>  </tr>");
			echo("<tr><td>Insurance ID: </td>  <td>" . $_SESSION["MEMBER_ID"] . "</td>  </tr>");
			
			if($_SESSION["NUM_OF_USE"] != ""){
				echo("<tr><td>number of uses left: </td>  <td>" . $_SESSION["NUM_OF_USE"] . "</td>  </tr>");
			}
			else{
				echo("<tr><td>Annual fee: </td>  <td>" . $_SESSION["ANNUAL_FEE"] . "</td>  </tr>");
				echo("<tr><td>Expiry Date: </td>  <td>" . $_SESSION["EXPIRY_DATE"] . "</td>  </tr>");
			}
		}
	?>
</table>
</br></br>

<a class = "blackLink" href = "profile-update.php"> Update Info </a>





<?php
	include_once 'footer.php';
?>