

<!DOCTYPE html>
<html>
<head>
	<title>Restaurant Database</title>
	<style>
		body {
			background-color: #121c38;
			color: white;
			font-family: Arial, sans-serif;
		}
		
		h1{
			font-family: "Monaco", monospace;
			font-size: 36px;
			color: #C0CAFB;
			text-align: center;
			margin-top: 50px;
		}
		h2 { 
			font-family: "Monaco", monospace;
			font-size: 20px;
			color: #C0CAFB;
	
			margin-top: 50px;

		}
		button{ 
			display: flex;
			justify-content: center;
			height: 100vh;
 			font-size: 18px;
			color: #323436;
  			padding: 16px 32px;
  			border: none;
  			border-radius: 5px;
  			margin-right: 10px;
			width: 120px;
  			height: 50px;
			background-color: #87A1D6;
			margin-bottom: 10px;
			white-space: nowrap;	
		}
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			text-align: left;
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}

		th {
			background-color: #f2f2f2;
			color: #666;
			border-top: 1px solid #ddd;
			border-bottom: 1px solid #ddd;
		}
	</style>
</head> 
<body>
	<h1> Restauraunt Database </h1> 
	<div class="button">
	<a href="http://localhost/restaurant.html"><button>HOME</button></a>
	</div>
	<h2> All Orders </h2>
	<table>
		<thead>
			<tr>
				<th>Delivery Date</th>
				<th>Number of Orders</th>

			
			</tr>
		</thead>
		<tbody>
			<?php
					try {
						$connection = new PDO('mysql:host=localhost;dbname=restaurantDB', "root", "");
					} catch (PDOException $e) {
						print "Error!: ". $e->getMessage(). "<br/>";
						die();
					}
					$result = $connection->query("SELECT deliveryDate, count(orderID) as countOrders from foodOrder group by deliveryDate");
					$rows = $result->fetchAll();
					foreach ($rows as $row){
						echo "<tr>";
						echo "<td>".$row["deliveryDate"]."</td>";
						echo "<td>".$row["countOrders"]."</td>";
						echo "</tr>";
					}
			?>

		</tbody>
	</table>

</body>
</html>