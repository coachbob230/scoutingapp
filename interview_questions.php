<?php
	$game = $_POST['game'];
	$question = str_replace(' ', '_', $_POST['question']);
	$question_type = $_POST['question_type'];
	$submit = $_POST['submit'];
	if($submit == "Add") {
		$conn = new mysqli('localhost', 'scouter', 'Ga3lh4wks', $game);
		if($question_type == 'mc') {
			$part_of_game = $_POST['part1'];
			if(isset($_POST['choices']))
				$num_choices = $_POST['choices'];
			else 
				$num_choices = 2;
			$sql = "INSERT INTO interview_questions(question, question_type, part_of_game, num_choices) VALUES('$question', '$question_type', '$part_of_game', '$num_choices')";
			if ($conn->query($sql) === TRUE) {
				echo "Question added successfully\n";
			} else {
				echo "Error creating table: " . $conn->error;
			}
			for($i = 1; $i <= $num_choices; $i++) {
				$choice = $_POST['choice' . $i];
				$sql = "ALTER TABLE interview_questions ADD choice" . $i . " VARCHAR(100) NOT NULL";
				if ($conn->query($sql) === TRUE) {
					echo "Question added successfully\n";
				} else {
					echo "Error creating table: " . $conn->error . "\n";
				}
				$sql = "UPDATE interview_questions SET choice" . $i . "='$choice' WHERE question='$question'";
				if ($conn->query($sql) === TRUE) {
					echo "Question added successfully\n";
				} else {
					echo "Error creating table: " . $conn->error . "\n";
				}
			}
			$sql = "ALTER TABLE interview_sheet ADD `".$question."` VARCHAR(100) NOT NULL";
			if ($conn->query($sql) === TRUE) {
				echo "Column created successfully";
			} else {
				echo "Error creating table: " . $conn->error;
			}
		}
		else if($question_type == 'yn') {
			$part_of_game = $_POST['part2'];
			$sql = "INSERT INTO interview_questions(question, question_type, part_of_game) VALUES('$question', '$question_type', '$part_of_game')";
			if ($conn->query($sql) === TRUE) {
				echo "Question added successfully";
			} else {
				echo "Error creating table: " . $conn->error;
			}
			$sql = "ALTER TABLE interview_sheet ADD `".$question."` VARCHAR(3) NOT NULL";
			if ($conn->query($sql) === TRUE) {
				echo "Column created successfully";
			} else {
				echo "Error creating table: " . $conn->error;
			}
		}
		else if($question_type == 'op') {
			$part_of_game = $_POST['part3'];
			$sql = "INSERT INTO interview_questions(question, question_type, part_of_game) VALUES('$question', '$question_type', '$part_of_game')";
			if ($conn->query($sql) === TRUE) {
				echo "Question added successfully";
			} else {
				echo "Error creating table: " . $conn->error;
			}
			$sql = "ALTER TABLE interview_sheet ADD `".$question."` VARCHAR(100) NOT NULL";
			if ($conn->query($sql) === TRUE) {
				echo "Column created successfully";
			} else {
				echo "Error creating table: " . $conn->error;
			}
		}
		header("Location: new_interview_questions.php?game=" . $game);
	}

?>