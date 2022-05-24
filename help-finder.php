<?php
	include_once 'header.php';
	include_once 'includes/help-finder.inc.php';
	$url1=$_SERVER['REQUEST_URI'];
	header("Refresh: 20; URL=$url1");
	
?>

<head>
	<title>People who are in need of help</title>
	<link href="css/style.css" rel="stylesheet">
	<style>
		table.help-finder {
			margin-left: auto;
			margin-right: auto;
			border-collapse: collapse;
		}
		
		th, td {
			border: 1px solid black;
			font-size: 18px;
			padding: 5px;
		}	
		
		tbody tr:nth-child(odd) {
			background-color: #fff;
		}

		tbody tr:nth-child(even) {
			background-color: #eee;
		}
		
		.CURRENT{
			background-color: #b1ffb1 !important;
		}
	</style>
</head>

<body>
	<section>
		<h1>People who need help</h1>
		<!-- Creating table -->
		<table class="help-finder">
			<tr>
                <th>SERVICE</th>
                <th>DESCRIPTION</th>
                <th>CUSTOMER</th>
				<th>LATITUDE</th>
				<th>LONGITUDE</th>
            </tr>
			<!-- Get data from the rows-->
			<?php   
				// Loop through all data
				$result = helpFinderTable($conn);
				$temp = 0;
				#$secondary_array = $result -> fetch_array();
                while($rows = $result->fetch_assoc())
                { 
					#echo("<tr><td>" . print_r($rows) . "</td></tr>");
					#echo("<tr><td>" . strval($rows["PROFESSIONAL_ID"]) . "</td><td> " . strval($_SESSION['USER_ID']) . "</td></tr>");
					if($rows["IS_FINISHED"] != 1 and(is_null($rows["PROFESSIONAL_ID"]) or $rows["PROFESSIONAL_ID"] == $_SESSION['USER_ID'])){
            ?>
			<?php 
			if((int)($rows["PROFESSIONAL_ID"]) === (int)($_SESSION['USER_ID'])){
				echo '<tr class = CURRENT>';
			}
			else{
				echo '<tr>';
			}
			?>
                <!--Displaying data for each row in each column-->
                <td><?php echo $rows['SERVICE_NAME'];?></td>
                <td><?php echo $rows['DESCRIPTION'];?></td>
                <td><?php echo $rows['CUSTOMER_ID'];?></td>
				<td><?php echo $rows['LATITUDE'];?></td>
				<td><?php echo $rows['LONGITUDE'];?></td>
				<td>
					<form action="includes/help-finder.inc.php" method="POST">
						<!--Submits the serviceID that the professional will work on-->
						<input type="hidden" name="serviceID" value="<?php echo $rows['SERVICE_ID']; ?>" />
						<input type="hidden" name="ProfID" value="<?php echo $_SESSION['USER_ID']; ?>" />
						<?php
							if((int)($rows["PROFESSIONAL_ID"]) === (int)($_SESSION['USER_ID'])){
								
								echo('<input type="submit" name="FinishService" value="Complete Service">');
							}
							else{
								echo('<input type="submit" name="updateService" value="Help This Person">');
							}
						
						?>
					</form>
				</td>
            </tr>
            <?php
					
					}
					#if(isset($_POST['updateService'])) {
					#	$service = $_POST["serviceID"];
					#	//Updates database to show that new professional is assigned to this service
					#	$sql = "UPDATE service SET PROFESSIONAL_ID = ".$_SESSION["USER_ID"]."WHERE SERVICE_ID = ".$service."";
					#}
					$temp = $temp+1;
                } 
				
             ?>
		</table>
	</section>
</body>

<?php
	include_once 'footer.php';
?>