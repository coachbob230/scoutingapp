<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<h2 style='text-align:center'>Add Interview Questions</h2>

<form action='interview_questions.php' method='POST' name='interviewQuestions'>
<?php
	if(isset($_GET['game']) && $_GET['game'] != '') {
		echo "<input type='hidden' name='game' value='" . $_GET['game'] . "'>";
	}
?>
<table style='text-align: left' align='center'>
<tr>
<td>
Question: 
</td>
<td>
<textarea name='question' rows='1' cols='35' style='resize:none'></textarea>
</td>
</tr>
<tr>
<td>
Question Type: 
</td>
<td>
<input type='radio' name='question_type' id='mc' value='mc'> Multiple Choice
<input type='radio' name='question_type' id='yn' value='yn'> Yes or No
<input type='radio' name='question_type' id='op' value='op'> Open Ended
</td>
</tr>
</table>

<div id='div_mc' style='display:none'>
<table style='text-align: left' align='center'>
<tr>
<td>
Choice 1: 
</td>
<td>
<input type='text' name='choice1'>
</td>
</tr>
<tr>
<td>
Choice 2: 
</td>
<td>
<input type='text' name='choice2'>
</td>
</tr>
</table>
<div id='choices'>
</div>
<table style='text-align: left' align='center'>
<tr>
<td>
<button type='button' onclick='return addChoice()'>Add Choice</button>
</td>
</tr>
<tr>
<td>
Attribute: 
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
			echo "<option value='" . $row2['attribute'] . "'>" . $row2['attribute'] . "</option>";
		}
	?>
</select>
</td>
</tr>
</table>
<div style='text-align: center'>
<input type='submit' name='submit' value='Add'>
<input type='submit' name='submit' value='No more Questions'>
</div>
</div>
<div id='div_yn' style='display:none'>
<table style='text-align: left' align='center'>
<tr>
<td>
Attribute: 
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
			echo "<option value='" . $row2['attribute'] . "'>" . $row2['attribute'] . "</option>";
		}
	?>
</select>
</td>
</tr>
</table>
<input type='hidden' name='averageable2' value='no'>
<input type='hidden' name='max2' value='no'>
<div style='text-align: center'>
<input type='submit' name='submit' value='Add'>
<input type='submit' name='submit' value='No more Questions'>
</div>
</div>
<div id='div_op' style='display:none'>
<table style='text-align: left' align='center'>
<tr>
<td>
Attribute: 
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
			echo "<option value='" . $row2['attribute'] . "'>" . $row2['attribute'] . "</option>";
		}
	?>
</select>
</td>
</tr>
</table>
<input type='hidden' name='averageable3' value='no'>
<input type='hidden' name='max3' value='no'>
<div style='text-align: center'>
<input type='submit' name='submit' value='Add'>
</div>
</div>
</form>

</body>
</html>