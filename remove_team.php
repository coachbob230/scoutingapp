<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<h2 style='text-align: center'> Remove Team from Event </h2>

<form method='POST' name='add_team' action=''>

<?php

$event = $_POST['event'];

if(!empty($_POST['submit']) && $_POST['submit'] == "Remove") {
	$teamnumber = $_POST['teamnumber'];
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$year = date('Y');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	$game = $row['game'] . "_" . $year;
	$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
	
	$sql = "DELETE FROM teams WHERE teamnumber = '$teamnumber' AND event = '$event'";
	if ($conn2->query($sql) === TRUE) {
		echo "<div align='center'>Team Removed Successfully</div>";
	} else {
		echo "Error adding data: " . $conn2->error;
	}
}



?>

<table style='text-align: left' align='center'>
<tr>
<td>
Team Number: 
</td>
<td>
<input type='text' name='teamnumber'>
</td>
</tr>
<tr>
<td>
</td>
<td>
<input type='hidden' name='event' value='<?php echo $event; ?>'>
<input type='submit' name='submit' value='Remove'>
</td>
</tr>
</table>

</form>

</div>

<?php include ('includes/footer.php'); ?>