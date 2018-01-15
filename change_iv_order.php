<?php
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$year = date('Y');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	$game = $row['game'] . "_" . $year;
	$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
	
	$result = mysqli_query($conn2, "SELECT * FROM interview_questions");
	while($row = mysqli_fetch_array($result)) {
		$question = $row['question'];
		$order = $_POST[$question . "order"];
		$sql = "UPDATE interview_questions SET `order` = '$order' WHERE question = '$question'";
		if ($conn2->query($sql) === TRUE) {
			echo "Data updated successfully\n";
		} else {
			echo "Error updating data: " . $conn2->error . "<br/>" . $sql . "<br/>";
		}
	}
	
	header("Location: admin.php");

?>