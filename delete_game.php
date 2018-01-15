<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<h2 style='text-align:center'>Delete Team</h2>

<?php
	$game = $_POST['game'];
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE game = '$game'");
	$row = mysqli_fetch_array($result);
	$year = $row['year'];
	$game_name = $game . "_" . $year;
	$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game_name);
	include('password.php');
	if(isset($_POST['password']) && $_POST['password'] == $password) {
		$sql = "DELETE FROM games WHERE game='$game'";
		if($conn->query($sql) === TRUE) {
			echo "Data deleted successfully!";
		}
		else {
			echo "Could not delete question: " . $conn->error;
		}
		$sql = "DROP DATABASE " . $game_name;
		if($conn2->query($sql) === TRUE) {
			echo "Data deleted successfully!";
		}
		else {
			echo "Could not delete database: " . $conn->error;
		}
		header("Location: admin.php");
	}
	if(isset($_POST['submit']) && $_POST['submit'] == 'No') {
		header("Location: admin.php");
	}
	if(!isset($_POST['submit'])) {
		echo "<form method='POST' name='delete_question' action=''>
		<p style='text-align:center'>Are you <b>ABSOLUTELY SURE</b> you want to delete the following game? There is no undoing this.<br/>
		Game: " . $game . "<br/>
		<input type='submit' name='submit' value='Yes'>
		<input type='submit' name='submit' value='No'>
		<input type='hidden' name='game' value='" . $game . "'></p>
		</form>";
	}
	else if(!isset($_POST['password'])) {
		echo "Please enter the password to complete this operation.
		<form method='POST' name='delete_game' action=''>
		Password: <input type='password' name='password'>
		<br><input type='hidden' name='game' value='" . $game . "'>
		<input type='submit' value='Submit'>
		</form>";
	}
	
?>