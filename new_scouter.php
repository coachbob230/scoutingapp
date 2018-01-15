<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<h2 style='text-align: center'> Add Scouter </h2>

<form method='POST' name='add_scouter' action=''>

<?php

if(!empty($_POST['submit']) && $_POST['submit'] == "Add") {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$sso = $_POST['sso'];
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$year = date('Y');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	
	$sql = "INSERT INTO scouter (firstname, lastname, sso) VALUES('$firstname', '$lastname', '$sso')";
	if ($conn->query($sql) === TRUE) {
		echo "<div align='center'>Scouter Added Successfully</div>";
	} else {
		echo "Error adding data: " . $conn->error;
	}
}



?>

<table style='text-align: left' align='center'>
<tr>
<td>
First Name: 
</td>
<td>
<input type='text' name='firstname'>
</td>
</tr>
<tr>
<td>
Last Name: 
</td>
<td>
<input type='text' name='lastname'>
</td>
</tr>
<tr>
<td>
SSO?
</td>
<td>
<select name='sso'>
	<option value='no'>No</option>
	<option value='yes'>Yes</option>
</select>
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