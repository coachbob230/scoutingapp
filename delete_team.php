<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<h2 style='text-align:center'>Delete Team</h2>

<?php
	$teamnumber = $_POST['teamnumber'];
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$year = date('Y');
	$result = mysqli_query($conn, "SELECT * FROM teams WHERE teamnumber='$teamnumber'");
	$row = mysqli_fetch_array($result);
	if(isset($_POST['submit']) && $_POST['submit'] == 'Yes') {
		$sql = "DELETE FROM teams WHERE teamnumber='$teamnumber'";
		if($conn->query($sql) === TRUE) {
			echo "Data deleted successfully!";
		}
		else {
			echo "Could not delete question: " . $conn->error;
		}
		header("Location: admin.php");
	}
	if(isset($_POST['submit']) && $_POST['submit'] == 'No') {
		header("Location: admin.php");
	}
	echo "<form method='POST' name='delete_question' action=''>
	<p style='text-align:center'>Are you sure you want to delete the following team?<br/>
	Team Number: " . $teamnumber . "<br/>
	Team Name: " . $row['teamname'] . "<br/>
	<input type='submit' name='submit' value='Yes'>
	<input type='submit' name='submit' value='No'>
	<input type='hidden' name='teamnumber' value='" . $teamnumber . "'></p>
	</form>";
	
?>