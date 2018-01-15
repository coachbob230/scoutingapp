<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<form action='multiscouting_data.php' method='POST' name='multiscouting'>

<div align='center'>
	<h2>Match Info</h2>
	<table>
		<tr>
		<td>
		Scouter: 
		</td>
		<td>
		<input type='text' name='scouter'>
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
		<select name='event'>
			<?php
			$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
			$year = date('Y');
			$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
			$row = mysqli_fetch_array($result);
			$game = $row['game'] . "_" . $year;
			$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
			$result = mysqli_query($conn2, "SELECT * FROM events");
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='" . $row['eventname'] . "'>
				" . $row['eventname'] . "
				</option>";
			}
			?>
		</select>
		</td>
		</tr>
	</table>
	</div>

	
<?php
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$year = date('Y');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	$game = $row['game'] . "_" . $year;
	$game_name = $row['game'];
	$i = 1;
	while($i <= 6) {
	
	echo "<div style='width:33%; float: left; font-size: 12px;";
	if($i == 1 || $i == 2 || $i == 3)
		echo " border-bottom:1px solid white;";
	if($i == 1 || $i == 2 || $i == 4 || $i == 5)
		echo " border-right:1px solid white;";
	echo"'>

		<table>
		<tr>
		<td>
		<h2>Team " . $i. "</h2>
		</td>
		</tr>
		<tr>
		<td>
		Team Number: 
		</td>
		<td>
		<input type='text' name='team" . $i . "'>
		</td>
		</tr>
		</table>";
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
						<select name='" . $row2['question'] . $i . "'>
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
						<select name='" . $row2['question'] . $i . "'>";
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
						<input type='text' name='" . $row2['question'] . $i . "'>
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
		<textarea name='comment" . $i . "' rows='9' cols='34'></textarea>
		</td>
		</tr>
		</table>
		
		</div>";
		$i++;
	}
?>

<div style='text-align: center'>
<input type='submit' value='Submit'>
</div>
</form>

</div>

<?php include ("includes/footer.php"); ?>