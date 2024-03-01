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

	</style>
</head>
<body>
	<h1> Restauraunt Database </h1> 
	<div class="button">
	<a href="http://localhost/restaurant.html"><button>HOME</button></a>
	</div>
	<h2> Employee Schedules</h2>
	<?php
		try {
			$connection = new PDO('mysql:host=localhost;dbname=restaurantDB', "root", "");
		} catch (PDOException $e) {
			print "Error!: ". $e->getMessage(). "<br/>";
			die();
		}
		$data = $connection->prepare('SELECT CONCAT(employeeFName, " ", employeeLName)AS employeeName, employeeID FROM employee');
		$data->execute();
		$rows = $data->fetchAll();

		echo "<form method='post'>";
		echo "<label for='employee_id'>Select Employee: </label>";
		echo "<select name='employee_id' id='employee_id'>";
		foreach($rows as $row) {
			$id = $row['employeeID'];
			$name = $row['employeeName'];
			echo "<option value='$id'>$name</option>";
		}
		echo "</select>";
		echo "<input type='submit' value='Submit'>";
		echo "</form>";
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$employee_id = $_POST['employee_id'];
		}
		$newquery = ('SELECT DAYNAME(day) AS dayOfWeek, day, start, end FROM shift where (shift.ID = :employee_id) AND DAYNAME(day) != "Sunday" AND DAYNAME(day) != "Saturday"');
		$data2 = $connection->prepare($newquery);
		$data2->bindParam(':employee_id', $employee_id);
		$data2->execute();
	?>
	<table>
    <thead>
        <tr>
            <th>Day of Week</th>
			<th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $data2->fetch()) { ?>
            <tr>
                <td><?php echo $row['dayOfWeek']; ?></td>
				<td><?php echo $row['day']; ?></td>
                <td><?php echo $row['start']; ?></td>
                <td><?php echo $row['end']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</body>