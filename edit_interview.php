<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<?php
	if(isset($_GET['team']))
		$team = $_GET['team'];
	if(isset($_GET['event']))
		$event = $_GET['event'];
?>

	<form action='interview_data.php' method='POST' name='scouting' enctype="multipart/form-data">

		<table>
		<tr>
		<td>
		Team Number: 
		</td>
		<td>
		<?php echo $team; ?>
		<input type='hidden' name='team' value='<?php echo $team; ?>'>
		<input type='hidden' name='event' value='<?php echo $event; ?>'>
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
			$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
			$game_name = $row['game'];
			$result4 = mysqli_query($conn2, "SELECT * FROM interview_sheet WHERE teamnumber='$team'");
			$row4 = mysqli_fetch_array($result4);
			$result3 = mysqli_query($conn, "SELECT * FROM interview_attributes WHERE game='$game_name'");
			while($row3 = mysqli_fetch_array($result3)) {
				$attribute = $row3['attribute'];
				$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
				$result2 = mysqli_query($conn2, "SELECT * FROM interview_questions WHERE part_of_game='$attribute'");
				echo "<h2>" . $attribute . "</h2>
				<table>";
				while($row2 = mysqli_fetch_array($result2)) {
					$question = $row2['question'];
					if($row2['question_type'] == "yn") {
						echo "<tr>
						<td>
						" . str_replace('_', ' ', $question) . " 
						</td>
						<td>
						<select name='" . $question . "'>
							<option value='No'>No</option>
							<option value='Yes' ";
							if($row4[$question] == "Yes")
								echo " selected";
							echo ">Yes</option>
						</select>
						</td>
						</tr>";
					}
					else if($row2['question_type'] == "mc") {
						echo "<tr>
						<td>
						" . str_replace('_', ' ', $question) . " 
						</td>
						<td>
						<select name='" . $question . "'>";
						for($j = 1; $j <= $row2['num_choices']; $j++) {
							echo "<option value='" . $row2['choice' . $j] . "' ";
							if($row4[$question] == $row2['choice' . $j])
								echo " selected";
							echo ">" . $row2['choice' . $j] . "</option>";
						}
						echo "</select>
						</td>
						</tr>";
					}
					else if($row2['question_type'] == "op") {
						echo "<tr>
						<td>
						" . str_replace('_', ' ', $question) . " 
						</td>
						<td>
						<input type='text' name='" . $question . "' value='" . $row4[$question] . "'>
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
		<textarea name='comment' rows='7' cols='40'><?php echo $row4['comments']; ?></textarea>
		</td>
		</tr>
		</table>
		<input type='submit' name='submit' value='Edit'>

	</form>

</div>

<?php include ("includes/footer.php"); ?>