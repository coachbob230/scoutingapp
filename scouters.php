<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<h2> Current Scouters </h2>

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

<table style='text-align: left'>
<?php
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$result = mysqli_query($conn, "SELECT * FROM scouter WHERE loggedin='yes'");
	while($row = mysqli_fetch_array($result)) {
		echo "<tr>
		<td>
		" . $row['firstname'] . " " . $row['lastname'] . "
		</td>
		</tr>";
	}
?>
</table>

</div>

<?php include ('includes/footer.php'); ?>