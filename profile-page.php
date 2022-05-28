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


<!--  put HTML/PHP code here -->
<head>
	<link rel="stylesheet" href="css\profile.css">
</head>
<body class="profilePage">
	<h1>Profile Page</h1>
	<div class="profileDetail">
	<table class = "profileTable">
		<tr>
			<th>Full Name </th>
			<td>:</td>
			<td>
			<?php 
			echo($_SESSION["NAME"]);
			?>
			</td>
		</tr>
		<tr>
			<th>Email </th>
			<td>:</td>
			<td>
			<?php 
			echo($_SESSION["USERNAME"]);
			?>
			</td>
		</tr>
		<tr>
			<th>DOB </th>
			<td>:</td>
			<td>
			<?php 
			echo($_SESSION["DOB"]);
			?>
			</td>
		</tr>
		<tr>
			<th>Phone </th>
			<td>:</td>
			<td>
			<?php 
			echo($_SESSION["PHONE"]);
			?>
			</td>
		</tr>
		<?php
			if($_SESSION["TYPE"] === "CUSTOMER"){
				echo("<tr><th>Address </th><td>:</td>  <td>" . $_SESSION["ADDRESS"] . "</td>  </tr>");
				echo("<tr><th>License Plate  </th><td>:</td>  <td>" . $_SESSION["MOTOR_NUM"] . " </td>  </tr>");
				echo("<tr><th>Insurance ID </th><td>:</td>  <td>" . $_SESSION["MEMBER_ID"] . "</td>  </tr>");

				if($_SESSION["NUM_OF_USE"] != ""){
					echo("<tr><th>number of uses left </th><td>:</td>  <td>" . $_SESSION["NUM_OF_USE"] . "</td>  </tr>");
				}
				else{
					echo("<tr><th>Annual fee </th><td>:</td>  <td>" . $_SESSION["ANNUAL_FEE"] . "</td>  </tr>");
					echo("<tr><th>Expiry Date </th><td>:</td>  <td>" . $_SESSION["EXPIRY_DATE"] . "</td>  </tr>");
				}
			}
		?>
	</table>
	</br></br>

	<a class = "blackLink" href = "profile-update.php"> Update Info </a>
	</div>
</body>




<?php
	include_once 'footer.php';
?>