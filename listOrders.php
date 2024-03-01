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
		label{ 
			font-size: 18px;
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
	<h2> Orders By Date </h2>
	<form method="POST">
  		<label for="myInputField">Enter Date:</label>
  		<input type="text" id="myInputField" name="myInputField" placeholder = "2063-01-31">
  		<button type="submit">Submit</button>
	</form>
	<?php
		try {
			$connection = new PDO('mysql:host=localhost;dbname=restaurantDB', "root", "");
		} catch (PDOException $e) {
			print "Error!: ". $e->getMessage(). "<br/>";
			die();
		}
		// check to make sure this isnt empty
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$date = $_POST['myInputField']; // set it to what we want 
			$data = $connection->prepare('SELECT fNname, lName, totalPrice, tip, deliveryDate, foodName, employeeFName, employeeLName FROM foodOrder 
				JOIN orderContainsFood ON foodOrder.orderID = orderContainsFood.ID 
				JOIN customerAccount ON customerAccount.email = foodOrder.accountEmail
				JOIN employee ON employee.employeeID = foodOrder.delEmployeeID WHERE deliveryDate = :date'); 
			// sets up query
			$data->bindParam(':date', $date); // loads in user input
			$results = $data->execute();
		}
	?>
	<table>
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Total Pice</th>
				<th>Tip</th>
				<th>Delivery Date</th>
				<th>Food Item</th>
				<th>Employee First Name</th>
				<th>Employee Last Name</th>
			</tr>
		</thead>
		<tbody>
			<?php
					$rows = $data->fetchAll();
					foreach ($rows as $row){
						echo "<tr>";
						echo "<td>".$row["fNname"]."</td>";
						echo "<td>".$row["lName"]."</td>";
						echo "<td>".$row["totalPrice"]."</td>";
						echo "<td>".$row["tip"]."</td>";
						echo "<td>".$row["deliveryDate"]."</td>";
						echo "<td>".$row["foodName"]."</td>";
						echo "<td>".$row["employeeFName"]."</td>";
						echo "<td>".$row["employeeLName"]."</td>";
						echo "</tr>";
					}
			?>

		</tbody>
	</table>

</body>
</html>
