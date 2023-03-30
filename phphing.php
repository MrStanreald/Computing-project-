<!DOCTYPE html>
<html>
	<head>
		<title>php</title>
		<link rel="stylesheet" type="text/css" href="php.css">
		<link rel="shortcut icon" href="favicon.ico">
	</head>
	<body>
	<div>
		<h1>My first PHP page</h1>
	</div>
	<div>
		<div class="signOutSection" style="clear:both"><br><form action="logout.php" method="POST" style="signOutButton"><input class="signButton" type="submit" value="Sign Out"></form></div><div class="navigation">
		<a href="viewCars.php"><button>View Database</button></a>
		<a href="addCar.php"><button>Add Car</button></a>
		<a href="add burger.php"><button>Delete Car</button></a>
		<?php
		echo "My first PHP script!";
		?>
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "test";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		$querystring = "SELECT * FROM myguests";
	
		$allData = mysqli_query($conn, $querystring);
		
		echo "<table> <tr><th>Forename</th><th>Surname</th><th>Email</th>";
			while($row=mysqli_fetch_array($allData, MYSQLI_ASSOC)){
				// if($row['lastname'] == $filter_choice){
					echo "<tr>";
					echo "<td>";
					echo $row['firstname'];
					echo "</td>";
					echo "<td>";
					echo $row['lastname'];
					echo "</td>";
					echo "<td>";
					echo $row['email'];
					echo "</td>";
					echo "</tr>";
				// }
			}
		echo "</table>";
		mysqli_close($conn);
		?>
	</div>
	</body>
<html>