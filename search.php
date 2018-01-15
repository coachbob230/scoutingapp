<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

	<form action='searchresults.php' method='POST' name='search'>
	<input type='radio' name='search_type' id='match' value='match' checked> Match Scouting Data
	<input type='radio' name='search_type' id='inter' value='inter'> Interview Data
	<div id='div_match'>
		<table>
		<tr>
		<td>
		<h2>Match Scouting Data</h2>
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
		Scouter: 
		</td>
		<td>
		<input type='text' name='scouter'>
		</td>
		</tr>
		<tr>
		<td>
		Event: 
		</td>
		<td>
		<select name='event'>
			<option value=''> </option>
			<?php
				$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
				$year = date('Y');
				$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
				$row = mysqli_fetch_array($result);
				$game = $row['game'] . "_" . $year;
				$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
				$result2 = mysqli_query($conn2, "SELECT * FROM events");
				while($row2 = mysqli_fetch_array($result2)) {
					echo "<option value='" . $row2['eventname'] . "'>" . $row2['eventname'] . "</option>";
				}
			?>
		</select>
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
		</table>
		
		<?php
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
							<option value=''> </option>
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
						<select name='" . $row2['question'] . "'>
							<option value=''> </option>";
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
		?>
		<input type='submit' value='Search'>
	</div>
	<div id='div_inter' style='display:none'>
		<table>
		<tr>
		<td>
		<h2>Interview Data</h2>
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
		</table>
		
		<?php
			$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
			$year = date('Y');
			$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
			$row = mysqli_fetch_array($result);
			$game = $row['game'] . "_" . $year;
			$game_name = $row['game'];
			$result3 = mysqli_query($conn, "SELECT * FROM interview_attributes WHERE game='$game_name'");
			while($row3 = mysqli_fetch_array($result3)) {
				$attribute = $row3['attribute'];
				$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
				$result2 = mysqli_query($conn2, "SELECT * FROM interview_questions WHERE part_of_game='$attribute' ORDER BY `order`");
				echo "<h2>" . $attribute . "</h2>
				<table>";
				while($row2 = mysqli_fetch_array($result2)) {
					if($row2['question_type'] == "yn") {
						echo "<tr>
						<td>
						" . str_replace('_', ' ', $row2['question']) . " 
						</td>
						<td>
						<select name='" . $row2['question'] . "'>
							<option value=''> </option>
							<option value='No'>No</option>
							<option value='Yes'>Yes</option>
						</select>
						</td>
						</tr>";
					}
					else if($row2['question_type'] == "mc") {
						echo "<tr>
						<td>
						" . str_replace('_', ' ', $row2['question']) . " 
						</td>
						<td>
						<select name='" . $row2['question'] . "'>
							<option value=''> </option>";
						for($j = 1; $j <= $row2['num_choices']; $j++) {
							echo "<option value='" . $row2['choice' . $j] . "'>" . $row2['choice' . $j] . "</option>";
						}
						echo "</select>
						</td>
						</tr>";
					}
					else if($row2['question_type'] == "op") {
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
		?>
		<input type='submit' value='Search'>
	</div>

	</form>

</div>

<?php include ("includes/footer.php"); ?>