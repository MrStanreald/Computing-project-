<?php
require "header.php";
?>
		<?php
		echo '<div id="form">
		<form action="deleteBurger.php" method="post">
		Category: <input type="text" name="in-cat" required><br>
		item: <input type="text" name="in-item" required><br>
		Serving size: <input type="number" name="in-size" required><br>
		Calories: <input type="number" name="in-calories" required><br>
		<input class="dataButton" type="Submit" name="submit" value="Delete Item">
		</form>
		</div>';

		include "connection.php";

		function removeburger($conn){
			$new_cat = $_POST['in-cat'];
			$new_item = $_POST['in-item'];
			$grams = $_POST['in-size']*28;
			$new_size = $_POST['in-size']." oz (".$grams." g)";   
			$new_cal = $_POST['in-calories'];
			$sql = "DELETE FROM menu WHERE Category='$new_cat' AND Item='$new_item' AND Serving_Size='$new_size' AND Calories='$new_cal'";
			if (mysqli_query($conn, $sql)) {
				echo "Entry deleted successfully";
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
		if (isset($_POST['submit'])){
			removeburger($conn);
		}
			
		mysqli_close($conn);
		?>
	</div>
	</body>
<html>
