<?php
	include_once 'header.php';
	include_once 'includes/reviews.inc.php';
	
?>

<head> 
	<title>Reviews Page</title>
	<link href="css/style.css" rel="stylesheet">
	<style>
		table.reviewTable {
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
		<?php 
			$result = reviewTable($conn);
		?>
        <h1>Your Review Page</h1>
        <!-- Creating table -->
        <table class="reviewTable">
            <tr>
                <th>RATING</th>
                <th>COMMENT</th>
            </tr>
            <!-- Get data from the rows-->
            <?php   
				// Loop through all data
                while($rows=$result->fetch_assoc())
                {
             ?>
            <tr>
                <!--Displaying data for each row in each column-->
                <td><?php echo $rows['RATING'];?></td>
                <td><?php echo $rows['COMMENCE'];?></td>
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