<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<h2 style='text-align: center'> Edit Team </h2>

<form method='POST' name='edit_team' action=''>

<?php
$teamnumber = $_POST['teamnumber'];
$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
$year = date('Y');
$result = mysqli_query($conn, "SELECT * FROM teams WHERE teamnumber='$teamnumber'");
$row = mysqli_fetch_array($result);

if(!empty($_POST['submit']) && $_POST['submit'] == "Edit") {
	$teamname = $_POST['teamname'];
	$sql = "UPDATE teams SET teamname='$teamname' WHERE teamnumber='$teamnumber'";
	if ($conn->query($sql) === TRUE) {
		echo "<div align='center'>Team Edited Successfully</div>";
	} else {
		echo "Error adding data: " . $conn->error;
	}
	header("Location:admin.php");
}



?>

<table style='text-align: left' align='center'>
<tr>
<td>
Team Number: 
</td>
<td>
<input type='text' name='teamnumber' value='<?php echo $teamnumber; ?>'>
</td>
</tr>
<tr>
<td>
Team Name: 
</td>
<td>
<input type='text' name='teamname' value='<?php echo $row['teamname']; ?>'>
</td>
</tr>
<tr>
<td>
</td>
<td>
<input type='submit' name='submit' value='Edit'>
</td>
</tr>
</table>

</form>

</div>

<?php include ('includes/footer.php'); ?>