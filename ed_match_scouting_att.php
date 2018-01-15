<?php

	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$year = date('Y');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	$game = $row['game'];
	$sql = "DELETE FROM match_scouting_attributes WHERE game='$game'";
	if ($conn->query($sql) === TRUE) {
		echo "Data successfully deleted <br/>";
	} else {
		echo "Error deleting data: " . $conn->error;
	}
	
	$i = 1;
	while(isset($_POST['attribute' . $i]) && $_POST['attribute' . $i] != '') {
		$attribute = $_POST['attribute' . $i];
		$sql = "INSERT INTO match_scouting_attributes (game, attribute) VALUES ('$game', '$attribute')";
		if ($conn->query($sql) === TRUE) {
			echo "Data successfully added <br/>";
		} else {
			echo "Error adding data: " . $conn->error;
		}
		$i++;
	}
	header("Location: admin.php");

?>