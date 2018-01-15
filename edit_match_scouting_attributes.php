<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<h2 style='text-align: center'>Edit Match Scouting Attributes</h2>

<form method='POST' name='edit_match_scouting_attributes' action='ed_match_scouting_att.php'>

<table style='text-align: left' align='center'>
<?php 
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$year = date('Y');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	$game = $row['game'];
	$result2 = mysqli_query($conn, "SELECT * FROM match_scouting_attributes WHERE game='$game'");
	$i = 1;
	while($row2 = mysqli_fetch_array($result2)) {
		echo "<tr>
		<td>
		Attribute " . $i . ": 
		</td>
		<td>
		<input type='text' name='attribute" . $i . "' value='" . $row2['attribute'] . "'>
		</td>
		</tr>";
		$i++;
	}
	echo "</table>
	<div id='attributes'></div>
	<table style='text-align: center' align='center'>
	<tr>
	<td>
	<div id='but'>
	<button type='button' onclick='return addAttribute3(" . $i . ")'>Add Attribute</button>
	</div>
	</td>
	</tr>
	<tr>
	<td>
	<input type='submit' value='Accept Changes'>
	</td>
	</tr>
	</table>";
?>
</form>

</div>

<?php include ('includes/footer.php'); ?>