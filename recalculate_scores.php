<?php
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$year = date('Y');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	$game = $row['game'] . "_" . $year;
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
	$event = $_POST['event'];
	$team_result = mysqli_query($conn, "SELECT * FROM teams WHERE event='$event'");
	while($row_team = mysqli_fetch_array($team_result)) {
		$team = $row_team['teamnumber'];
		$score = 0;
		$matches = 0;
		$scout = mysqli_query($conn, "SELECT * FROM scouting WHERE teamnumber='$team' AND event='$event'");
		while($scouting = mysqli_fetch_array($scout)) {
			$result = mysqli_query($conn, "SELECT * FROM questions");
			while($row = mysqli_fetch_array($result)) {
				$question = $row['question'];
				$response = $scouting[$question];
				$multiplier = $row['multiplier'];
				$id = $question . $response;
				$result2 = mysqli_query($conn, "SELECT * FROM scoring WHERE id='$id'");
				$row2 = mysqli_fetch_array($result2);
				$result3 = mysqli_query($conn, "SELECT * FROM teams WHERE teamnumber='$team' AND event='$event'");
				$row3 = mysqli_fetch_array($result3);
				$score = $score + ($multiplier * $row2['value']);
			}
			$matches++;
		}
		$score = $score/$matches;
		$sql = "UPDATE teams SET `score` = '$score' WHERE teamnumber='$team' AND event='$event'";
		if ($conn->query($sql) === TRUE) {
			//echo "Score set successfully<br/>";
		} else {
			echo "Error updating data: " . $conn->error . "\n" . $sql . "\n";
		}
	}
	header("Location: admin.php");
?>