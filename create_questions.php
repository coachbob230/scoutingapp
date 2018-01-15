<?php
	$game = $_POST['game'];
	$question = str_replace(' ', '_', $_POST['question']);
	$multiplier = $_POST['multiplier'];
	$question_type = $_POST['question_type'];
	$submit = $_POST['submit'];
	if($submit == "Add") {
		$conn = new mysqli('localhost', 'scouter', 'Ga3lh4wks', $game);
		if($question_type == 'mc') {
			$part_of_game = $_POST['part1'];
			$multiplier = $_POST['multiplier'];
			$averageable = $_POST['averageable1'];
			$max = $_POST['max1'];
			if(isset($_POST['choices']))
				$num_choices = $_POST['choices'];
			else 
				$num_choices = 2;
			$sql = "INSERT INTO questions(question, multiplier, type, part_of_game, averageable, num_choices, get_max) VALUES('$question', '$multiplier', '$question_type', '$part_of_game', '$averageable', '$num_choices', '$max')";
			if ($conn->query($sql) === TRUE) {
				echo "Question added successfully\n";
			} else {
				echo "Error creating table: " . $conn->error;
			}
			$i = 1;
			while(isset($_POST['choice' . $i]) && $_POST['choice' . $i] != '') {
				$choice = $_POST['choice' . $i];
				$value = $_POST['value' . $i];
				$sql = "ALTER TABLE questions ADD choice" . $i . " VARCHAR(100) NOT NULL";
				if ($conn->query($sql) === TRUE) {
					echo "Question added successfully\n";
				} else {
					echo "Error creating table: " . $conn->error . "\n";
				}
				$sql = "UPDATE questions SET choice" . $i . "='$choice' WHERE question='$question'";
				if ($conn->query($sql) === TRUE) {
					echo "Question added successfully\n";
				} else {
					echo "Error creating table: " . $conn->error . "\n";
				}
				$id = $question . $choice;
				$sql = "INSERT INTO scoring(id, value) VALUES('$id', '$value')";
				if ($conn->query($sql) === TRUE) {
					echo "Question added successfully";
				} else {
					echo "Error creating table: " . $conn->error;
				}
				$i++;
			}
			$sql = "ALTER TABLE scouting ADD `".$question."` VARCHAR(100) NOT NULL";
			if ($conn->query($sql) === TRUE) {
				echo "Column created successfully";
			} else {
				echo "Error creating table: " . $conn->error;
			}
		}
		else if($question_type == 'yn') {
			$part_of_game = $_POST['part2'];
			$averageable = $_POST['averageable2'];
			$max = $_POST['max2'];
			$value1 = $_POST['ynvalue1'];
			$value2 = $_POST['ynvalue2'];
			$sql = "INSERT INTO questions(question, multiplier, type, part_of_game, averageable, get_max) VALUES('$question', '$multiplier', '$question_type', '$part_of_game', '$averageable', '$max')";
			if ($conn->query($sql) === TRUE) {
				echo "Question added successfully";
			} else {
				echo "Error creating table: " . $conn->error;
			}
			$id = $question . "Yes";
			$sql = "INSERT INTO scoring(id, value) VALUES('$id', '$value1')";
			if ($conn->query($sql) === TRUE) {
				echo "Question added successfully";
			} else {
				echo "Error creating table: " . $conn->error;
			}
			$id = $question . "No";
			$sql = "INSERT INTO scoring(id, value) VALUES('$id', '$value2')";
			if ($conn->query($sql) === TRUE) {
				echo "Question added successfully";
			} else {
				echo "Error creating table: " . $conn->error;
			}
			$sql = "ALTER TABLE scouting ADD `".$question."` VARCHAR(3) NOT NULL";
			if ($conn->query($sql) === TRUE) {
				echo "Column created successfully";
			} else {
				echo "Error creating table: " . $conn->error;
			}
		}
		else if($question_type == 'op') {
			$part_of_game = $_POST['part3'];
			$averageable = $_POST['averageable3'];
			$max = $_POST['max3'];
			$sql = "INSERT INTO questions(question, type, part_of_game, averageable, get_max) VALUES('$question', '$question_type', '$part_of_game', '$averageable', '$max')";
			if ($conn->query($sql) === TRUE) {
				echo "Question added successfully";
			} else {
				echo "Error creating table: " . $conn->error;
			}
			$sql = "ALTER TABLE scouting ADD `".$question."` VARCHAR(100) NOT NULL";
			if ($conn->query($sql) === TRUE) {
				echo "Column created successfully";
			} else {
				echo "Error creating table: " . $conn->error;
			}
		}
		header("Location: new_game_questions.php?game=" . $game);
	}

?>