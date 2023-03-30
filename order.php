<?php
include 'header.php';
?>
		<section class="flex-container">
			<section class="table" style="float:left;clear:both">
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
			</section>

			<?php
			include "connection.php";
			$ID = $_SESSION['ID'];
			?>
			<section class="basket" style="position:relative;float:right;">
				<h1>Basket</h1>

				<p style="text-decoration: underline; font-size:20px">Items</p>

				<?php
					$sql = "SELECT * FROM orders WHERE ID = '$ID'";
					$result = mysqli_query($conn, $sql);
					$resultCheck = mysqli_num_rows($result);
					$totalCost = "0";
					if($resultCheck > 0){
						while ($row = mysqli_fetch_assoc($result)) {
							$Item = $row['Item'];
							$Category = $row['Category'];
							$Serving_Size = $row['Serving_Size'];
							$Calories = $row['Calories'];
							$totalCost += $row['Calories']/100;
							?> <br><p>Item:   <?php echo $Item ?><br>Price: <?php echo "£",sprintf($Calories/100)?></p><?php
						}
					}
				?>
				<br>
				<p style="text-decoration: underline; font-size:20px">Total price: £<?php echo $totalCost?></p>
				<?php
				echo '<form method="post"><input class="dataButton" type="Submit" name="submit" value="check out"></form>';

				function truncation($conn){
					$sql = "DELETE FROM orders";

					if (mysqli_query($conn, $sql)) {
						echo "Order successful
						";
					} else {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
				}

				if (isset($_POST['submit'])){
					truncation($conn);
				}
				?>
			</section>
		</section>
	</body>
</html>