<?php

	$team = $_POST['team'];
	if(isset($_POST['event']))
		$event = $_POST['event'];
	$comment = $_POST['comment'];
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$robotpic=$_FILES["robotpic"]["name"];
	$allowedExts = array("gif", "jpeg", "jpg", "png", "JPG");
	$temp = explode(".", $_FILES["robotpic"]["name"]);
	$extension = end($temp);
	if ((($_FILES["robotpic"]["type"] == "image/gif")
	|| ($_FILES["robotpic"]["type"] == "image/jpeg")
	|| ($_FILES["robotpic"]["type"] == "image/jpg")
	|| ($_FILES["robotpic"]["type"] == "image/pjpeg")
	|| ($_FILES["robotpic"]["type"] == "image/x-png")
	|| ($_FILES["robotpic"]["type"] == "image/png"))
	&& in_array($extension, $allowedExts))
	  {
	  if ($_FILES["robotpic"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["robotpic"]["error"] . "<br>";
		}
	  else
		{
		if (file_exists("pictures/" . $_FILES["robotpic"]["name"]))
		  {
		  echo $_FILES["robotpic"]["name"] . " already exists. ";
		  }
		else
		  {
		  move_uploaded_file($_FILES["robotpic"]["tmp_name"],
		  "pictures/" . $_FILES["robotpic"]["name"]);
		  }
		$sql = "UPDATE teams SET robot_picture = '$robotpic' WHERE teamnumber='$team'";
		if ($conn->query($sql) === TRUE) {
			echo "Data updated successfully\n";
		} else {
			echo "Error updating data: " . $conn->error . "\n" . $sql . "\n";
		}
		}
	  }
	else
	  {
	  echo "Invalid file";
	  }
	
	$year = date('Y');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	$game = $row['game'] . "_" . $year;
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
	$sql = "INSERT INTO interview_sheet (teamnumber, comments) VALUES ('$team', '$comment')
		ON DUPLICATE KEY UPDATE comments='$comment'";
	if ($conn->query($sql) === TRUE) {
		echo "Data added successfully<br/>";
	} else {
		echo "Error adding data: " . $conn->error;
	}
	
	$result = mysqli_query($conn, "SELECT * FROM interview_questions");
	while($row = mysqli_fetch_array($result)) {
		$question = $row['question'];
		$response = $_POST[$question];
		$sql = "UPDATE interview_sheet SET `$question` = '$response' WHERE teamnumber='$team'";
		if ($conn->query($sql) === TRUE) {
			echo "Data updated successfully<br/>";
		} else {
			echo "Error updating data: " . $conn->error . "\n" . $sql . "\n";
		}
	}
	if($_POST['submit'] == 'Submit') {
		header("Location: interview.php");
		echo "Hello.";
	}
	else if($_POST['submit'] == 'Edit') {
		header("Location: team.php?team=" . $team . "&event=" . $event);
		echo "Hello there.";
	}

?>