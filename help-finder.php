<?php
	include_once 'header.php';
	include_once 'includes/help-finder.inc.php';
	
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
	</style>
</head>

<body>
	<section>
		<h1>People who need help</h1>
		<!-- Creating table -->
		<table class="help-finder">
			<tr>
                <th>SERVICE</th>
                <th>PRICE</th>
                <th>CUSTOMER</th>
                <th>PAID</th>
				<th>LATITUDE</th>
				<th>LONGITUDE</th>
            </tr>
			<!-- Get data from the rows-->
			<?php   
				// Loop through all data
				$result = helpFinderTable($conn);
                while($rows=$result->fetch_assoc())
                {
             ?>
			 <tr>
                <!--Displaying data for each row in each column-->
                <td><?php echo $rows['SERVICE_NAME'];?></td>
                <td><?php echo $rows['PRICE'];?></td>
                <td><?php echo $rows['CUSTOMER_ID'];?></td>
                <td><?php if ($rows['IS_PAID'] == 1) {
						echo "Yes"; 
					} else {
						echo "No"; 
					}?></td>
				<td><?php echo $rows['LATITUDE'];?></td>
				<td><?php echo $rows['LONGITUDE'];?></td>
				<td>
					<form action="includes/help-finder.inc.php" method="POST">
						<!--Submits the serviceID that the professional will work on-->
						<input type="hidden" name="serviceID" value="<?php echo $row['SERVICE_ID']; ?>" />
						<input type="submit" name="updateService" value="Submit">
					</form>
				</td>
            </tr>
            <?php
					if(isset($_POST['updateService'])) {
						$service = $_POST["serviceID"];
						//Updates database to show that new professional is assigned to this service
						$sql = "UPDATE service SET PROFESSIONAL_ID = ".$_SESSION["USER_ID"]."WHERE SERVICE_ID = ".$service."";
					}
                } 
				
             ?>
		</table>
	</section>
</body>

<?php
	include_once 'footer.php';
?>