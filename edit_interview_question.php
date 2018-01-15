<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<h2 style='text-align:center'>Edit Match Scouting Question</h2>

<form method='POST' name='edit_question' action='code_edit_iv_question.php'>

<?php

$question = $_POST['question'];
$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
$year = date('Y');
$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
$row = mysqli_fetch_array($result);
$game = $row['game'] . "_" . $year;
$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);

$result3 = mysqli_query($conn2, "SELECT * FROM interview_questions WHERE question = '$question'");
$row3 = mysqli_fetch_array($result3);

if(isset($_POST['submit']) && $_POST['submit'] == 'Edit') {
	$ogquestion=$_POST['ogquestion'];
	$question=str_replace(' ', '_', $_POST['question']);
	$question_type=$_POST['question_type'];
	if($question != $ogquestion) {
		$sql = "UPDATE questions SET question = '$question' WHERE question = '$ogquestion'";
		if ($conn2->query($sql) === TRUE) {
			echo "Question edited successfully\n";
		} else {
			echo "Error editting question: " . $conn->error . "\n";
		}
		$sql = "ALTER TABLE scouting RENAME COLUMN `".$ogquestion."` TO `".$question."`";
		if ($conn2->query($sql) === TRUE) {
			echo "Column edited successfully\n";
		} else {
			echo "Error editing column: " . $conn->error . "\n";
		}
	}
	if($question_type == "mc") {
		$part_of_game=$_POST['part1'];
		$averageable=$_POST['averageable1'];
		$get_max=$_POST['max1'];
		$sql = "UPDATE questions SET part_of_game = '$part_of_game', averagable = '$averageable', get_max = '$get_max' WHERE question = '$question'";
		if ($conn2->query($sql) === TRUE) {
			echo "Question edited successfully\n";
		} else {
			echo "Error editing question: " . $conn->error . "\n";
		}
		$i = 1;
		while(isset($_POST['choice' . $i]) && $_POST['choice' . $i] != '') {
			$choice = $_POST['choice' . $i];
			$sql = "ALTER TABLE questions ADD choice" . $i . " VARCHAR(100) NOT NULL";
			if ($conn->query($sql) === TRUE) {
				echo "Question added successfully\n";
			} else {
				echo "Error creating table: " . $conn->error . "\n";
			}
			$sql = "UPDATE questions SET choice" . $i . "='$choice' WHERE question='$question'";
			if ($conn2->query($sql) === TRUE) {
				echo "Question added successfully\n";
			} else {
				echo "Error creating table: " . $conn->error . "\n";
			}
			$i++;
		}
		$i--;
		$sql = "UPDATE questions SET num_choices = '$i' WHERE question = '$question'";
		if ($conn2->query($sql) === TRUE) {
			echo "Question edited successfully\n";
		} else {
			echo "Error editting question: " . $conn->error . "\n";
		}
	}
	else if($question_type == "yn") {
		$part_of_game=$_POST['part2'];
		$sql = "UPDATE questions SET part_of_game = '$part_of_game' WHERE question = '$question'";
		if ($conn2->query($sql) === TRUE) {
			echo "Question edited successfully\n";
		} else {
			echo "Error editting question: " . $conn->error . "\n";
		}
	}
	else if($question_type == "op") {
		$part_of_game=$_POST['part3'];
		$sql = "UPDATE questions SET part_of_game = '$part_of_game' WHERE question = '$question'";
		if ($conn2->query($sql) === TRUE) {
			echo "Question edited successfully\n";
		} else {
			echo "Error editting question: " . $conn->error . "\n";
		}
	}
	header("Location: admin.php");
}

?>

<input type='hidden' name='ogquestion' value='<?php echo $question; ?>'>
<input type='hidden' name='type'  id='' value='<?php echo $row3['question_type']; ?>'>

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
Question Type: 
</td>
<td>
<input type='radio' name='question_type' id='mc' value='mc' <?php if($row3['question_type'] == "mc") echo "checked"; ?>> Multiple Choice
<input type='radio' name='question_type' id='yn' value='yn' <?php if($row3['question_type'] == "yn") echo "checked"; ?>> Yes or No
<input type='radio' name='question_type' id='op' value='op' <?php if($row3['question_type'] == "op") echo "checked"; ?>> Open Ended
</td>
</tr>
</table>

<div id='div_mc' <?php if($row3['question_type'] != "mc") echo "style='display:none'"; ?>>
<table style='text-align: left' align='center'>
<?php
	if($row3['question_type'] == "mc") {
		$i = 1;
		while(isset($row3['choice' . $i]) && $row3['choice' . $i] != '') {
			echo "<tr>
			<td>
			Choice " . $i . ": 
			</td>
			<td>
			<input type='text' name='choice" . $i . "' value='" . $row3['choice' . $i] . "'>
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
	if($row3['question_type'] == "mc") {
		echo "<div id='but'>
		<button type='button' onclick='return addChoice2(<?php echo $i; ?>)'>Add Choice</button>
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
		$result2 = mysqli_query($conn, "SELECT * FROM interview_attributes WHERE game='$game'");
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

<div id='div_yn' <?php if($row3['question_type'] != "yn") echo "style='display:none'"; ?>>
<table style='text-align: left' align='center'>
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
		$result2 = mysqli_query($conn, "SELECT * FROM interview_attributes WHERE game='$game'");
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
<input type='hidden' name='averageable2' value='no'>
<input type='hidden' name='max2' value='no'>
<div style='text-align: center'>
<input type='submit' name='submit' value='Edit'>
</div>
</div>

<div id='div_op' <?php if($row3['question_type'] != "op") echo "style='display:none'"; ?>>
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
		$result2 = mysqli_query($conn, "SELECT * FROM interview_attributes WHERE game='$game'");
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