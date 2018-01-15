<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

	<form action='interview_data.php' method='POST' name='scouting' enctype="multipart/form-data">

		<table>
		<tr>
		<td>
		Team Number: 
		</td>
		<td>
		<input type='text' name='team'>
		</td>
		</tr>
		<tr>
		<td>
		Picture:
		</td>
		<td>
		<input type='file' name='robotpic'>
		</td>
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
				$result2 = mysqli_query($conn2, "SELECT * FROM interview_questions WHERE part_of_game='$attribute'");
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
						<select name='" . $row2['question'] . "'>";
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
		<h2>Other Comments</h2>
		<table>
		<tr>
		<td>
		<textarea name='comment' rows='7' cols='40'></textarea>
		</td>
		</tr>
		</table>
		<input type='submit' name='submit' value='Submit'>

	</form>

</div>

<?php include ("includes/footer.php"); ?>