<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<form action='edit_match_data.php' method='POST' name='multiscouting'>
	
<?php
	$event = $_POST['event'];
	$matchnumber = $_POST['matchnumber'];
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$year = date('Y');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	$game = $row['game'] . "_" . $year;
	$game_name = $row['game'];
	echo "
	<input type='hidden' name='event' value='" . $event . "'>
	<input type='hidden' name='matchnumber' value='" . $matchnumber . "'>";
	$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
	$result4 = mysqli_query($conn2, "SELECT * FROM scouting WHERE event='$event' AND matchnumber='$matchnumber'");
	$i = 1;
	while($row4 = mysqli_fetch_array($result4)) {
	
	echo "<div style='width:33%; float: left; font-size: 12px;'>
	
		<input type='hidden' name='id" . $i . "' value='" . $row4['id'] . "'>
	
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
		<input type='text' name='team" . $i . "' value='" . $row4['teamnumber'] . "'>
		</td>
		</tr>
		<tr>
		<td>
		Scouter: 
		</td>
		<td>
		" . $row4['scouter'] . "
		</td>
		</tr>
		<tr>
		<td>
		<a href='delete_match_data.php?id=" . $i . "'>Delete this data</a>
		</td>
		</tr>
		</table>";
			$result3 = mysqli_query($conn, "SELECT * FROM match_scouting_attributes WHERE game='$game_name'");
			while($row3 = mysqli_fetch_array($result3)) {
				$attribute = $row3['attribute'];
				$result2 = mysqli_query($conn2, "SELECT * FROM questions WHERE part_of_game='$attribute' ORDER BY `order`");
				echo "<h2>" . $attribute . "</h2>
				<table>";
				while($row2 = mysqli_fetch_array($result2)) {
					$question = $row2['question'];
					if($row2['type'] == "yn") {
						echo "<tr>
						<td>
						" . str_replace('_', ' ', $row2['question']) . " 
						</td>
						<td>
						<select name='" . $row2['question'] . $i . "'>
							<option value='No'>No</option>
							<option value='Yes'";
							if($row4[$question] == 'Yes')
								echo " selected";
							echo ">Yes</option>
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
							echo "<option value='" . $row2['choice' . $j] . "'";
							if($row2['choice' . $j] == $row4[$question])
								echo " selected";
							echo ">" . $row2['choice' . $j] . "</option>";
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
						<input type='text' name='" . $row2['question'] . $i . "' value='" . $row4[$question] . "'>
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
		<textarea name='comment" . $i . "' rows='9' cols='34'>" . $row4['comments'] . "</textarea>
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