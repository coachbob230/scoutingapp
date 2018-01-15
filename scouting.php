<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

	<?php
	
	if(isset($_GET['event']))
		$event = $_GET['event'];
	
	if($_SESSION['status'] != 'authorized') 
		echo "Please log in with your first and last name in the top right before scouting.";
	
	else {
	echo "
	<form action='/scouting/scouting_data.php' method='POST' name='scouting'>

		<table>
		<tr>
		<td>
		<h2>Match Info</h2>
		</td>
		</tr>
		<tr>
		<td>
		Scouter: 
		</td>
		<td>
		" . $_SESSION['first_name'] . " " . $_SESSION['last_name'] . "
		<input type='hidden' name='scouter' value='" . $_SESSION['first_name'] . " " . $_SESSION['last_name'] . "'>
		</td>
		</tr>
		<tr>
		<td>
		Match Number: 
		</td>
		<td>
		<input type='text' name='match'>
		</td>
		</tr>
		<tr>
		<td>
		Event: 
		</td>
		<td>
		<select name='event'>";
			$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
			$year = date('Y');
			$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
			$row = mysqli_fetch_array($result);
			$game = $row['game'] . "_" . $year;
			$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
			$result = mysqli_query($conn2, "SELECT * FROM events");
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='" . $row['eventname'] . "'";
				if(isset($_GET['event']) && $event == $row['eventname'])
					echo " selected"; 
				echo ">
				" . $row['eventname'] . "
				</option>";
			}
		echo "</select>
		</td>
		</tr>
		<tr>
		<td>
		Team Number: 
		</td>
		<td>
		<input type='text' name='team'>
		</td>
		</tr>
		</table>";
		
			$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
			$year = date('Y');
			$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
			$row = mysqli_fetch_array($result);
			$game = $row['game'] . "_" . $year;
			$game_name = $row['game'];
			$result3 = mysqli_query($conn, "SELECT * FROM match_scouting_attributes WHERE game='$game_name'");
			while($row3 = mysqli_fetch_array($result3)) {
				$attribute = $row3['attribute'];
				$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
				$result2 = mysqli_query($conn2, "SELECT * FROM questions WHERE part_of_game='$attribute' ORDER BY `order`");
				echo "<h2>" . $attribute . "</h2>
				<table>";
				while($row2 = mysqli_fetch_array($result2)) {
					if($row2['type'] == "yn") {
						echo "<tr>
						<td>
						" . str_replace('_', ' ', $row2['question']) . " 
						</td>
						<td>
						<select name='" . $row2['question'] . "'>
							<option value='No'>No</option>
							<option value='Yes'>Yes</option>
						</select>
						</td>
						</tr>";
					}
					else if($row2['type'] == "mc") {
						echo "<tr>
						<td>
						" . str_replace('_', ' ', $row2['question']) . " 
						</td>
						<td>
						<select name='" . $row2['question'] . "'>";
						for($j = 1; $j <= $row2['num_choices']; $j++) {
							echo "<option value='" . $row2['choice' . $j] . "'>" . $row2['choice' . $j] . "</option>";
						}
						echo "</select>
						</td>
						</tr>";
					}
					else if($row2['type'] == "op") {
						echo "<tr>
						<td>
						" . str_replace('_', ' ', $row2['question']) . " 
						</td>
						<td>
						<input type='text' name='" . $row2['question'] . "'>
						</td>
						</tr>";
					}
				}
				echo "</table>";
			}
		
		echo "<table>
		<tr>
		<td>
		Comments: 
		</td>
		<td>
		<textarea name='comment' rows='7' cols='40'></textarea>
		</td>
		</tr>
		</table>
		<input type='submit' value='Submit'>

	</form>";
	}
?>

</div>

<?php include ("includes/footer.php"); ?>