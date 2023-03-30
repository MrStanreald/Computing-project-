<?php
require "header.php";
?>
		<?php
		echo '<div id="form">
		<form action="bvrger.php" method="post">
		Category: <input type="text" name="in-cat" required><br>
		item: <input type="text" name="in-item" required><br>
		Serving size: <input type="number" name="in-size" required><br>
		Calories: <input type="number" name="in-calories" required><br>
		<input class="dataButton" type="Submit" name="submit" value="Add Item">
		</form>
		</div>';

		include "connection.php";

		function addburger($conn){
			$new_cat = $_POST['in-cat'];
			$new_item = $_POST['in-item'];
			$grams = $_POST['in-size']*28;
			$new_size = $_POST['in-size']." oz (".$grams." g)";
			$new_cal = $_POST['in-calories'];
			$sql = "INSERT INTO menu (`Category`,`Item`,`Serving_Size`,`Calories`)
			VALUES ('$new_cat','$new_item','$new_size','$new_cal')";

			if (mysqli_query($conn, $sql)) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
		if (isset($_POST['submit'])){
			addburger($conn);
		}
			
		mysqli_close($conn);
		?>
	</div>
	</body>
<html>