<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<form action='code_edit_game.php' method='POST' name='createDB' onsubmit='return validateForm()' enctype="multipart/form-data">
<?php
	$game = $_POST['game'];
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE game = '$game'");
	$row = mysqli_fetch_array($result);
?>
<table style='text-align: left' align='center'>
<tr>
<td>
Game Name: 
</td>
<td>
<?php echo str_replace("_", " ", $game); ?>
<input type='hidden' name='game' value='<?php echo $game; ?>'>
</td>
</tr>
<tr>
<td>
Year: 
</td>
<td>
<input type='text' name='year' value='<?php echo $row['year']; ?>'>
</td>
</tr>
<tr>
<td>
Logo: 
</td>
<td>
<input type='file' name='gamelogo' id='gamelogo'>
</td>
</tr>
<tr>
<td></td>
<td>
<input type='submit' value='Edit'>
</td>
</tr>
</table>
</form>

</form>


</body>
</html>