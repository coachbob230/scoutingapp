<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<h2 style='text-align: center'> Add Team </h2>

<form method='POST' name='add_team' action=''>

<?php

if(!empty($_POST['submit']) && $_POST['submit'] == "Add") {
	$teamnumber = $_POST['teamnumber'];
	$teamname = $_POST['teamname'];
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$year = date('Y');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	
	$sql = "INSERT INTO teams (teamnumber, teamname) VALUES('$teamnumber', '$teamname')";
	if ($conn->query($sql) === TRUE) {
		echo "<div align='center'>Team Added Successfully</div>";
	} else {
		echo "Error adding data: " . $conn->error;
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
Team Name: 
</td>
<td>
<input type='text' name='teamname'>
</td>
</tr>
<tr>
<td>
</td>
<td>
<input type='submit' name='submit' value='Add'>
</td>
</tr>
</table>

</form>

</div>

<?php include ('includes/footer.php'); ?>