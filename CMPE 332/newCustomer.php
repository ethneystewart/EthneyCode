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
	<h2> Add New Customer </h2>
	<form method="POST">
  		<label for="FName">Enter First Name:</label>
  		<input type="text" id="FName" name="FName" >

		<label for="LName">Enter Last Name:</label>
  		<input type="text" id="LName" name="LName" >

		<label for="Email">Enter Email:</label>
  		<input type="text" id="Email" name="Email" >

		<label for="pNum">Enter Phone Number:</label>
  		<input type="text" id="pNum" name="pNum" >

		<label for="restaurant">Enter Restaurant:</label>
  		<input type="text" id="restaurant" name="restaurant">

		<label for="street">Enter Street:</label>
  		<input type="text" id="street" name="street" >

		<label for="city">Enter City:</label>
  		<input type="text" id="city" name="city">

		<label for="pc">Enter Postal Code:</label>
  		<input type="text" id="pc" name="pc" >

  		<button type="submit">Submit</button>
	</form>
	<?php
		try {
		$connection = new PDO('mysql:host=localhost;dbname=restaurantDB', "root", "");
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
		print "Error!: ". $e->getMessage(). "<br/>";
		die();
		}

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$fnam = $_POST['FName'];
		$lnam = $_POST['LName'];
		$newemail = $_POST['Email'];
		$newpNum = $_POST['pNum'];
		$restName = $_POST['restaurant'];
		$newstreet = $_POST['street'];
		$newcity = $_POST['city'];
		$newpc = $_POST['pc'];
		$newcredit = 5.00;

		$stmt = $connection->prepare("INSERT INTO customerAccount (email, restaurantName, fNname, lName, cellNum, street, PC, city, credit) VALUES (:email, :restName, :fname, :lname, :phone, :street, :postalcode, :city, :credit)");
		
		$stmt->bindParam(':email', $newemail);
		$stmt->bindParam(':restName', $restName);
		$stmt->bindParam(':fname', $fnam);
		$stmt->bindParam(':lname', $lnam);
		$stmt->bindParam(':phone', $newpNum);
		$stmt->bindParam(':street', $newstreet);
		$stmt->bindParam(':postalcode', $newpc);
		$stmt->bindParam(':city', $newcity);
		$stmt->bindParam(':credit', $newcredit);
		
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			echo "Data inserted successfully.";
		} else {
			echo "Error inserting data.";
		}
		}
	?>

</body>
</html>
