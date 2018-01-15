<?php
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$year = date('Y');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	$game = $row['game'] . "_" . $year;
	$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
	$ogquestion=$_POST['ogquestion'];
	$question=str_replace(' ', '_', $_POST['question']);
	$multiplier = $_POST['multiplier'];
	$question_type=$_POST['question_type'];
	$old_type=$_POST['type'];
	if($question != $ogquestion) {
		$sql = "UPDATE questions SET question = '$question' WHERE question = '$ogquestion'";
		if ($conn2->query($sql) === TRUE) {
			echo "Question edited successfully<br/>";
		} else {
			echo "Error editing question: " . $conn2->error . "<br/>";
		}
		$sql = "ALTER TABLE scouting CHANGE COLUMN `".$ogquestion."` `".$question."` VARCHAR(100)";
		echo $sql . "<br/>";
		if ($conn2->query($sql) === TRUE) {
			echo "Column edited successfully<br/>";
		} else {
			echo "Error editing column: " . $conn2->error . "<br/>";
		}
	}
	if($old_type != $question_type && $old_type == 'mc') {
		$result3 = mysqli_query($conn2, "SELECT * FROM questions WHERE question = '$question'");
		$row3 = mysqli_fetch_array($result3);
		$i = 1;
		$sql = "UPDATE questions SET num_choices = '0' WHERE question = '$question'";
		if ($conn2->query($sql) === TRUE) {
			echo "Question edited successfully\n";
		} else {
			echo "Error editing question: " . $conn2->error . "\n";
		}
		while($row3['choice' . $i] != '') {
			$sql = "UPDATE questions SET choice".$i." = '' WHERE question = '$question'";
			if ($conn2->query($sql) === TRUE) {
				echo "Question edited successfully\n";
			} else {
				echo "Error editing question: " . $conn2->error . "\n";
			}
			$i++;
		}
	}
	if($question_type == "mc") {
		$part_of_game=$_POST['part1'];
		$averageable=$_POST['averageable1'];
		$get_max=$_POST['max1'];
		$sql = "UPDATE questions SET multiplier = '$multiplier', part_of_game = '$part_of_game', averageable = '$averageable', get_max = '$get_max', type = '$question_type' WHERE question = '$question'";
		if ($conn2->query($sql) === TRUE) {
			echo "Question edited successfully<br/>";
		} else {
			echo "Error editing question: " . $conn2->error . "\n";
		}
		$i = 1;
		while(isset($_POST['choice' . $i])) {
			$choice = $_POST['choice' . $i];
			$value = $_POST['value' . $i];
			$sql = "ALTER TABLE questions ADD choice" . $i . " VARCHAR(100) NOT NULL";
			if ($conn2->query($sql) === TRUE) {
				echo "Question added successfully<br/>";
			} else {
				echo "Error creating table: " . $conn2->error . "<br/>";
			}
			$sql = "UPDATE questions SET choice" . $i . "='$choice' WHERE question='$question'";
			if ($conn2->query($sql) === TRUE) {
				echo "Question added successfully<br/>";
			} else {
				echo "Error creating table: " . $conn2->error . "\n";
			}
			$id = $question . $choice;
			$sql = "INSERT INTO scoring (id, value) VALUES('$id', '$value') ON DUPLICATE KEY UPDATE value='$value'";
			if ($conn2->query($sql) === TRUE) {
				echo "Question added successfully<br/>";
			} else {
				echo "Error creating table: " . $conn->error;
			}
			
			if($choice != '')
				$i++;
			else
				break;
		}
		$i--;
		$sql = "UPDATE questions SET num_choices = '$i' WHERE question = '$question'";
		if ($conn2->query($sql) === TRUE) {
			echo "Question edited successfully\n";
		} else {
			echo "Error editting question: " . $conn->error . "\n";
		}
	}
	else if($question_type == "yn") {
		$part_of_game=$_POST['part2'];
		$averageable='no';
		$get_max='no';
		$yesvalue = $_POST['ynvalue1'];
		$novalue = $_POST['ynvalue2'];
		$sql = "UPDATE questions SET multiplier = '$multiplier', part_of_game = '$part_of_game', averageable = '$averageable', get_max = '$get_max', type = '$question_type' WHERE question = '$question'";
		if ($conn2->query($sql) === TRUE) {
			echo "Question edited successfully\n";
		} else {
			echo "Error editting question: " . $conn->error . "\n";
		}
		$id = $question . "Yes";
		$sql = "INSERT INTO scoring (id, value) VALUES('$id', '$yesvalue') ON DUPLICATE KEY UPDATE value='$yesvalue'";
		if ($conn2->query($sql) === TRUE) {
			echo "Question added successfully<br/>";
		} else {
			echo "Error creating table: " . $conn->error;
		}
		$id = $question . "No";
		$sql = "INSERT INTO scoring (id, value) VALUES('$id', '$novalue') ON DUPLICATE KEY UPDATE value='$novalue'";
		if ($conn2->query($sql) === TRUE) {
			echo "Question added successfully<br/>";
		} else {
			echo "Error creating table: " . $conn->error;
		}
	}
	else if($question_type == "op") {
		$part_of_game=$_POST['part3'];
		$averageable='no';
		$get_max='no';
		$sql = "UPDATE questions SET multiplier = '$multiplier', part_of_game = '$part_of_game', averageable = '$averageable', get_max = '$get_max', type = '$question_type' WHERE question = '$question'";
		if ($conn2->query($sql) === TRUE) {
			echo "Question edited successfully\n";
		} else {
			echo "Error editting question: " . $conn->error . "\n";
		}
	}
	header("Location: admin.php");
?>