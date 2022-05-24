<?php
	include_once 'header.php';
	
	if($_SESSION["TYPE"] != "CUSTOMER"){
		header("location: index.php");
	}
	else{
		require_once 'includes/dbh.inc.php';
		require_once 'includes/functions.inc.php';
		
		MembershipCheck($conn, $_SESSION["USERNAME"]);
		carCheck($conn, $_SESSION["USERNAME"]);
		$check = checkService($conn, $_SESSION["USERNAME"]);
		if($check){
			echo("");
			$_SESSION["SERVICE_CHECK"] = True;
			#header("location: service-request.php?error=service");
			$url1=$_SERVER['REQUEST_URI'];
			header("Refresh: 10; URL=$url1");
		}
		else{
			$_SESSION["SERVICE_CHECK"] = False;
			#header("location: service-request.php?error=NoService");
		}
		
	};
	
	
	
?>
<body class="Service">
	<section class="form">
		<div class="image">
			<img src="img/car-icon.png" alt="Car" class="car-icon">
		</div>
		<div class="ServiceRequest" id = "ServiceRequestPage">
			<h2>Update information</h2>

			<form action="includes/service-request.inc.php" method="post" >
				<div class="container">
					<?php
						echo("<input readonly name='username' value = '" . $_SESSION["USERNAME"] . "'>");
					?>
					<label for="problem"><b>Car Problem</b></label>
					<input type="text" name="problem" placeholder="Car Problem" required></br>
					
					<label for="ip"><b>IP address ##temporary measure</b></label>
					<input type="text" name="ip" placeholder="  " required></br>
					
					<label for="description"><b>Description (200 character maximum)</b></label>
					<textarea  type="text" name="description" placeholder="Description" required></textarea>
					
					
					
					
				</div>
				<button class="btnLogin" type="submit" name="submit"> Submit </button>
				<br/>
				
			</form>
		</div>
		<div class="ServiceRequest" id = "ServiceRequestConfirm">
			<?php
				#stuff to put in here: problem, description, has a prof been assigned, cancel button
				require_once 'includes/dbh.inc.php';
				require_once 'includes/functions.inc.php';
				
				$row = getServiceRow($conn, $_SESSION["USERNAME"]);
				
				echo("Problem: " . $row["SERVICE_NAME"] . "</br>");
				echo("Description: " . $row["DESCRIPTION"] . "</br>");
				if($row["PROFESSIONAL_ACCEPTED"] == 0){
					echo("No Professional is on the way yet</br>");
				}
				else{
					echo("A Professional is on the way</br>");
					$prof = profExistsByID($conn, $row["PROFESSIONAL_ID"]);
					echo("Professional Name: " . $prof["PRO_NAME"] . "</br>");
				}
				
				
				echo('<form action="includes/service-cancel.inc.php" method="post" >');
				echo("<input readonly name='uid' value = '" . $row["SERVICE_ID"] . "' id = 'hide'>");
				echo('<button class="btnLogin" type="submit" name="submit"> Cancel Service </button>');
				
				echo('</form>');
				
				
			?>
		</div>
		
		
		
		
		<script>
		service = "<?php echo($_SESSION["SERVICE_CHECK"])?>"
		console.log(service)
		if(service == "1"){
			document.getElementById("ServiceRequestPage").style.visibility = "hidden";
			document.getElementById("ServiceRequestConfirm").style.visibility = "visible";
		}
		else{
			document.getElementById("ServiceRequestPage").style.visibility = "visible";
			document.getElementById("ServiceRequestConfirm").style.visibility = "hidden";
		}
		document.getElementById("hide").style.visibility = "hidden";
		</script>
	</section>	
</body>



<?php
	include_once 'footer.php';
?>