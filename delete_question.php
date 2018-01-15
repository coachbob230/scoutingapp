<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<?php
	$question = $_POST['question'];
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$year = date('Y');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	$game = $row['game'] . "_" . $year;
	$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
	if(isset($_POST['submit']) && $_POST['submit'] == 'Yes') {
		$sql = "DELETE FROM questions WHERE question='$question'";
		if($conn2->query($sql) === TRUE) {
			echo "Data deleted successfully!";
		}
		else {
			echo "Could not delete question: " . $conn3->error;
		}
		header("Location: admin.php");
	}
	if(isset($_POST['submit']) && $_POST['submit'] == 'No') {
		header("Location: admin.php");
	}
	echo "<form method='POST' name='delete_question' action='delete_question.php'>
	Are you sure you want to delete the question \"" . $question .  "\"?
	<input type='submit' name='submit' value='Yes'>
	<input type='submit' name='submit' value='No'>
	<input type='hidden' name='question' value='" . $question . "'>
	</form>";
	
?>