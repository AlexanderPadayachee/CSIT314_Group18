<?php
	include_once 'header.php';
	include_once 'includes/service-history.inc.php';
	
?>

<head> 
	<title>Service History Page</title>
	<link href="css/style.css" rel="stylesheet">
	<style>
		table.service-history {
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
        <h1>Your Service History</h1>
		<?php 
			$result = serviceTable($conn);
		?>
        <!-- Creating table -->
        <table class="service-history">
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
                while($rows=$result->fetch_assoc())
                {
             ?>
            <tr>
                <!--Displaying data for each row in each column-->
                <td><?php echo $rows['SERVICE_NAME'];?></td>
                <td><?php echo $rows['PRICE'];?></td>
                <td><?php echo $rows['CUSTOMER_ID'];?></td>
                <td><?php if ($rows['IS_PAID'] == 1) {
						#If 1 is put in then that means the customer has paid
						echo "Yes"; 
					} else {
						#If 0 is put in then customer has not yet paid
						echo "No"; 
					}?></td>
				<td><?php echo $rows['LATITUDE'];?></td>
				<td><?php echo $rows['LONGITUDE'];?></td>
            </tr>
            <?php
                } 
             ?> 
        </table> 
    </section>
</body>

<?php
	include_once 'footer.php';
?>