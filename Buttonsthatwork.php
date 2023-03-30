<?php
require "header.php"
?>
<style>
	form{
		margin:auto;
	}
</style>
<table>
		<tr>
			<th>Category</th>
			<th>Item</th>
			<th>Serving Size</th>
			<th>Calories</th>
			<th>Basket</th>
		</tr>
	<?php
	session_start();
	if (isset($_SESSION['ID'])) {
		$_SESSION['ID'];
	}
	else {
		$_SESSION['ID'] = uniqid("absh");
	}
	
	include "connection.php";
	$row_array = array();
	$sql = "SELECT * FROM menu";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($row_array, $row);
			$Item = $row['Item'];
			$ItemName = str_replace(' ', '', $Item);
			$Category = $row['Category'];
			$Serving_Size = $row['Serving_Size'];
			$Calories = $row['Calories'];
			?>
			<tr><td> <?php echo $Category ?> </td><td> <?php echo $Item ?> </td><td> <?php echo $Serving_Size ?>  </td><td>  <?php echo $Calories ?>  </td><td> <form method="POST"> <input type='submit' name = <?php echo $ItemName ?>  value='ADD'></input> </form></td>
			<?php
		}
	}
	?>
	<?php
	foreach ($row_array as $row) {
		$Item = $row['Item'];
		$ItemName = str_replace(' ', '', $Item);
		if (isset($_POST[$ItemName])) {
			$Category = $row['Category'];
			$Item = $row['Item'];
			$Serving_Size = $row['Serving_Size'];
			$Calories = $row['Calories'];
			$ID = $_SESSION['ID'];
			$sql = "INSERT INTO orders(ID, Category, Item, Serving_Size, Calories) VALUES('$ID', '$Category', '$Item', '$Serving_Size', '$Calories')";
			if (mysqli_query($conn, $sql)) {
			}
			else {
				echo "ERROR" . $sql . "<br>" . mysqli_error($conn);
			}
		}
	}
	mysqli_close($conn);
	?>
</table>

	<a href="rian/order.php">NEXT PAGE</a>
	</body>
	<html>