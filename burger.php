<?php
require "Head.php";
		echo "<div>";
			require "connection.php";
		
			$uniqueQuery = "SELECT DISTINCT `Category` FROM menu ORDER BY (`Category`) ASC";
			$querystring = "SELECT * FROM menu";
			
			$allData = mysqli_query($conn, $querystring);
			$unique_item = mysqli_query($conn, $uniqueQuery);
			
			if(mysqli_num_rows($allData) == 0){
				echo "No results";
			}
			else{
				echo '<form class="filterSection" action="burger.php" method="POST">
				<select class="dropDown" name="Category">
				<option value = "ANY">All the Burgers</option>';
				foreach($unique_item as $item)
				{
					foreach($item as $key => $value){
						echo '<option value="';
						echo $value;
						echo '">';
						echo $value;
						echo '</option>';
					}
				}
				echo "<input name='submit' class='signButton' type='submit' value='Filter'></select></form>";
			}
		
			echo "<section class='table'>";
			if (array_key_exists('submit',$_POST)){
				$filter_choice = $_POST["Category"];
				if($filter_choice == "ANY"){
				echo "<table> <tr><th>Category</th><th>Item</th><th>Serving Size</th><th>Calories</th></tr>";
				while($row=mysqli_fetch_array($allData, MYSQLI_ASSOC)){
						echo "<tr>";
						echo "<td>";
						echo $row['Category'];
						echo "</td>";
						echo "<td>";
						echo $row['Item'];
						echo "</td>";
						echo "<td>";
						echo $row['Serving_Size'];
						echo "</td>";
						echo "<td>";
						echo $row['Calories'];
						echo "</td>";
						echo "</tr>";
					}
				}
				else{
					echo "<table> <tr><th>Category</th><th>Item</th><th>Serving Size</th><th>Calories</th>";
					while($row=mysqli_fetch_array($allData, MYSQLI_ASSOC)){
							if($row['Category'] == $filter_choice){
								echo "<tr>";
								echo "<td>";
								echo $row['Category'];
								echo "</td>";
								echo "<td>";
								echo $row['Item'];
								echo "</td>";
								echo "<td>";
								echo $row['Serving_Size'];
								echo "</td>";
								echo "<td>";
								echo $row['Calories'];
								echo "</td>";
								echo "</tr>";
							}
						}
					echo "</table>";
					}
			}
			echo "<section>";
			mysqli_close($conn);
			?>
		</div>
	</body>
<html>