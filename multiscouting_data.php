<?php

	$scouter = mysql_escape_string($_POST['scouter']);
	$match = $_POST['match'];
	$event = $_POST['event'];
	
	$i = 1;
	while($i <= 6) {
		$team = $_POST['team' . $i];
		if($team != '') {
			$comment = $_POST['comment' . $i];
			
			$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
			$year = date('Y');
			$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
			$row = mysqli_fetch_array($result);
			$game = $row['game'] . "_" . $year;
			$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
			$sql = "INSERT INTO scouting (matchnumber, teamnumber, scouter, event, comments) VALUES('$match', '$team', '$scouter', '$event', '$comment')";
			if ($conn->query($sql) === TRUE) {
				echo "Data added successfully\n";
			} else {
				echo "Error adding data: " . $conn->error;
			}
			
			$result = mysqli_query($conn, "SELECT * FROM questions");
			while($row = mysqli_fetch_array($result)) {
				$question = $row['question'];
				$response = $_POST[$question . $i];
				$sql = "UPDATE scouting SET `$question` = '$response' WHERE matchnumber='$match' AND teamnumber='$team' AND event='$event'";
				if ($conn->query($sql) === TRUE) {
					echo "Data updated successfully\n";
				} else {
					echo "Error updating data: " . $conn->error . "\n" . $sql . "\n";
				}
				$multiplier = $row['multiplier'];
				$id = $question . $response;
				$result2 = mysqli_query($conn, "SELECT * FROM scoring WHERE id='$id'");
				$row2 = mysqli_fetch_array($result2);
				$result3 = mysqli_query($conn, "SELECT * FROM teams WHERE teamnumber='$team' AND event='$event'");
				$row3 = mysqli_fetch_array($result3);
				$score = $row3['score'] + ($multiplier * $row2['value']);
				$sql = "UPDATE teams SET `score` = '$score' WHERE teamnumber='$team' AND event='$event'";
				if ($conn->query($sql) === TRUE) {
					echo "Score set successfully<br/>";
				} else {
					echo "Error updating data: " . $conn->error . "\n" . $sql . "\n";
				}
			}
		}
		$i++;
	}
	
	header("Location: multiscouting.php");

?>