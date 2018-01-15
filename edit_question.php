<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<h2 style='text-align:center'>Edit Match Scouting Question</h2>

<form method='POST' name='edit_question' action='code_edit_question.php'>

<?php

$question = $_POST['question'];
$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
$year = date('Y');
$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
$row = mysqli_fetch_array($result);
$game = $row['game'] . "_" . $year;
$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);

$result3 = mysqli_query($conn2, "SELECT * FROM questions WHERE question = '$question'");
$row3 = mysqli_fetch_array($result3);

?>

<input type='hidden' name='ogquestion' value='<?php echo $question; ?>'>
<input type='hidden' name='type'  id='' value='<?php echo $row3['type']; ?>'>

<table style='text-align: left' align='center'>
<tr>
<td>
Question: 
</td>
<td>
<textarea name='question' rows='1' cols='35' style='resize:none'><?php echo str_replace('_', ' ', $question); ?></textarea>
</td>
</tr>
<tr>
<td>
Multiplier
</td>
<td>
<input type='text' name='multiplier' value='<?php echo $row3['multiplier']; ?>'>
<tr>
<td>
Question Type: 
</td>
<td>
<input type='radio' name='question_type' id='mc' value='mc' <?php if($row3['type'] == "mc") echo "checked"; ?>> Multiple Choice
<input type='radio' name='question_type' id='yn' value='yn' <?php if($row3['type'] == "yn") echo "checked"; ?>> Yes or No
<input type='radio' name='question_type' id='op' value='op' <?php if($row3['type'] == "op") echo "checked"; ?>> Open Ended
</td>
</tr>
</table>

<div id='div_mc' <?php if($row3['type'] != "mc") echo "style='display:none'"; ?>>
<table style='text-align: left' align='center'>
<?php
	if($row3['type'] == "mc") {
		$i = 1;
		while(isset($row3['choice' . $i]) && $row3['choice' . $i] != '') {
			$choice = $row3['choice' . $i];
			$id = $question . $choice;
			$result4 = mysqli_query($conn2, "SELECT * FROM scoring WHERE id='$id'");
			$row4 = mysqli_fetch_array($result4);
			echo "<tr>
			<td>
			Choice " . $i . ": 
			</td>
			<td>
			<input type='text' name='choice" . $i . "' value='" . $row3['choice' . $i] . "'>
			</td>
			<td>
			Value: 
			</td>
			<td>
			<input type='text' name='value" . $i . "' value='" . $row4['value'] . "'>
			</td>
			</tr>";

			$i++;
		}
	}
?>
</table>
<div id='choices'>
</div>
<table style='text-align: left' align='center'>
<tr>
<td>
<?php
	if($row3['type'] == "mc") {
		echo "<div id='but'>
		<button type='button' onclick='return addChoice2(" . $i . ")'>Add Choice</button>
		</div>";
	}
	else {
		echo "<div id='but'>
		<button type='button' onclick='return addChoice2(1)'>Add Choice</button>
		</div>";
	}
?>
</td>
</tr>
</table>

<table style='text-align: left' align='center'>
<tr>
<td>
Part of Game: 
</td>
<td>
<select name='part1'>
	<option value=''> </option>
	<?php
		$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
		$year = date('Y');
		$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
		$row = mysqli_fetch_array($result);
		$game = $row['game'];
		$num_attributes = $row['num_attributes'];
		$result2 = mysqli_query($conn, "SELECT * FROM match_scouting_attributes WHERE game='$game'");
		while($row2 = mysqli_fetch_array($result2)) {
			echo "<option value='" . $row2['attribute'] . "'";
			if($row2['attribute'] == $row3['part_of_game'])
				echo " selected";
			echo ">" . $row2['attribute'] . "</option>";
		}
	?>
</select>
</td>
</tr>
<tr>
<td>
Averageable: 
</td>
<td>
<select name='averageable1'>
	<option value='no'>No</option>
	<option value='yes' 
	<?php if($row3['averageable'] == 'yes') echo " selected='selected'"; ?>>Yes</option>
</select>
</td>
</tr>
<tr>
<td>
Get Max?
</td>
<td>
<select name='max1'>
	<option value='no'>No</option>
	<option value='yes'
	<?php if($row3['get_max'] == 'yes') echo " selected='selected'"; ?>>Yes</option>
</select>
</td>
</tr>
</table>
<div style='text-align: center'>
<input type='submit' name='submit' value='Edit'>
</div>
</div>

<div id='div_yn' <?php if($row3['type'] != "yn") echo "style='display:none'"; ?>>
<?php
	$id = $question . "No";
	$result4 = mysqli_query($conn2, "SELECT * FROM scoring WHERE id='$id'");
	$row4 = mysqli_fetch_array($result4);
	$novalue = $row4['value'];
	$id = $question . "Yes";
	$result4 = mysqli_query($conn2, "SELECT * FROM scoring WHERE id='$id'");
	$row4 = mysqli_fetch_array($result4);
	$yesvalue = $row4['value'];
?>
<table style='text-align: left' align='center'>
<tr>
<td>
Yes Value: 
</td>
<td>
<input type='text' name='ynvalue1' value='<?php echo $yesvalue; ?>'>
</td>
</tr>
<tr>
<td>
No Value: 
</td>
<td>
<input type='text' name='ynvalue2' value='<?php echo $novalue; ?>'>
</td>
</tr>
<tr>
<td>
Part of Game: 
</td>
<td>
<select name='part2'>
	<option value=''> </option>
	<?php
		$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
		$year = date('Y');
		$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
		$row = mysqli_fetch_array($result);
		$game = $row['game'];
		$num_attributes = $row['num_attributes'];
		$result2 = mysqli_query($conn, "SELECT * FROM match_scouting_attributes WHERE game='$game'");
		while($row2 = mysqli_fetch_array($result2)) {
			echo "<option value='" . $row2['attribute'] . "'";
			if($row2['attribute'] == $row3['part_of_game'])
				echo " selected";
			echo ">" . $row2['attribute'] . "</option>";
		}
	?>
</select>
</td>
</tr>
</table>
<div style='text-align: center'>
<input type='submit' name='submit' value='Edit'>
</div>
</div>

<div id='div_op' <?php if($row3['type'] != "op") echo "style='display:none'"; ?>>
<table style='text-align: left' align='center'>
<tr>
<td>
Part of Game: 
</td>
<td>
<select name='part3'>
	<option value=''> </option>
	<?php
		$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
		$year = date('Y');
		$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
		$row = mysqli_fetch_array($result);
		$game = $row['game'];
		$num_attributes = $row['num_attributes'];
		$result2 = mysqli_query($conn, "SELECT * FROM match_scouting_attributes WHERE game='$game'");
		while($row2 = mysqli_fetch_array($result2)) {
			echo "<option value='" . $row2['attribute'] . "'";
			if($row2['attribute'] == $row3['part_of_game'])
				echo " selected";
			echo ">" . $row2['attribute'] . "</option>";
		}
	?>
</select>
</td>
</tr>
</table>
<input type='hidden' name='averageable3' value='no'>
<input type='hidden' name='max3' value='no'>
<div style='text-align: center'>
<input type='submit' name='submit' value='Edit'>
</div>
</div>

</form>

</div>

<?php include ('includes/footer.php'); ?>