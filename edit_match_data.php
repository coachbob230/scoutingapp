<?php
	$matchnumber = $_POST['matchnumber'];
	$event = $_POST['event'];
	
	$i = 1;
	while($i <= 3) {
		$team = $_POST['team' . $i];
		$comment = $_POST['comment' . $i];
		$id = $_POST['id' . $i];
		
		$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
		$year = date('Y');
		$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
		$row = mysqli_fetch_array($result);
		$game = $row['game'] . "_" . $year;
		$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
		$sql = "UPDATE scouting SET comments = '$comment' WHERE id='$id'";
		if ($conn->query($sql) === TRUE) {
			echo "Data added successfully\n";
		} else {
			echo "Error adding data: " . $conn->error;
		}
		
		$result = mysqli_query($conn, "SELECT * FROM questions");
		while($row = mysqli_fetch_array($result)) {
			$question = $row['question'];
			$response = $_POST[$question . $i];
			$sql = "UPDATE scouting SET `$question` = '$response' WHERE id='$id'";
			if ($conn->query($sql) === TRUE) {
				echo "Data updated successfully\n";
			} else {
				echo "Error updating data: " . $conn->error . "\n" . $sql . "\n";
			}
		}
		$i++;
	}
	
	header("Location: admin.php");

?>