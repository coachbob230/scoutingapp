<?php

$game = str_replace(' ', '_', $_POST['game']);
$year = $_POST['year'];
$num_attributes = $_POST['num_attributes'];
$num_iattributes = $_POST['num_iattributes'];
$db_name = $game . "_" . $year;
$gamelogo=$_FILES["gamelogo"]["name"];
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["gamelogo"]["name"]);
$extension = end($temp);
if ((($_FILES["gamelogo"]["type"] == "image/gif")
|| ($_FILES["gamelogo"]["type"] == "image/jpeg")
|| ($_FILES["gamelogo"]["type"] == "image/jpg")
|| ($_FILES["gamelogo"]["type"] == "image/pjpeg")
|| ($_FILES["gamelogo"]["type"] == "image/x-png")
|| ($_FILES["gamelogo"]["type"] == "image/png"))
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["gamelogo"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["gamelogo"]["error"] . "<br>";
    }
  else
    {
    if (file_exists("pictures/" . $_FILES["gamelogo"]["name"]))
      {
      echo $_FILES["gamelogo"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["gamelogo"]["tmp_name"],
      "pictures/" . $_FILES["gamelogo"]["name"]);
      }
    }
  }
else
  {
  echo "Invalid file";
  }

// Create connection
$conn = new mysqli('localhost', 'scouter', 'Ga3lh4wks');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn3 = new mysqli('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
// Check connection
if ($conn3->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
}

if($conn3->query("INSERT INTO games (game, year, gamelogo, num_attributes) VALUES('$game', '$year', '$gamelogo', '$num_attributes')") === TRUE) {
	echo "Successfully inserted data!";
}
else {
	echo "Could not insert data into table: " . $conn3->error;
}

$i = 1;
while(isset($_POST['iattribute' . $i]) && $_POST['iattribute' . $i] != '') {
	$attribute = $_POST['iattribute' . $i];
	if($conn3->query("INSERT INTO interview_attributes (game, attribute) VALUES('$game', '$attribute')") === TRUE) {
		echo "Successfully inserted data!";
	}
	else {
		echo "Could not insert data into table: " . $conn3->error;
	}
	$i++;
}

$i = 1;
while(isset($_POST['attribute' . $i]) && $_POST['attribute' . $i] != '') {
	$attribute = $_POST['attribute' . $i];
	if($conn3->query("INSERT INTO match_scouting_attributes (game, attribute) VALUES('$game', '$attribute')") === TRUE) {
		echo "Successfully inserted data!";
	}
	else {
		echo "Could not insert data into table: " . $conn3->error;
	}
	$i++;
}

// Create database
$sql = "CREATE DATABASE `".$db_name."`";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn2 = new mysqli('localhost', 'scouter', 'Ga3lh4wks', $db_name);
// Check connection
if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
}

$sql = "CREATE TABLE events(
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	eventname VARCHAR(50) NOT NULL,
	location VARCHAR(100) NOT NULL,
	smonth INT(2) NOT NULL,
	sday INT(2) NOT NULL,
	syear INT(4) NOT NULL,
	emonth INT(2) NOT NULL,
	eday INT(2) NOT NULL,
	eyear INT(4) NOT NULL
	)";
	
if ($conn2->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn2->error;
}

$sql = "CREATE TABLE teams(
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	teamnumber INT(5) NOT NULL,
	event VARCHAR(100) NOT NULL
	)";
	
if ($conn2->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn2->error;
}

$sql = "CREATE TABLE scouting(
	matchnumber INT(4) NOT NULL,
	teamnumber INT(5) NOT NULL,
	scouter VARCHAR(100) NOT NULL,
	event VARCHAR(100) NOT NULL,
	comments TEXT
	)";
	
if ($conn2->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn2->error;
}

$sql = "CREATE TABLE interview_sheet(
	teamnumber INT(5) PRIMARY KEY,
	comments TEXT
	)";
	
if ($conn2->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn2->error;
}

$sql = "CREATE TABLE scoring(
	id VARCHAR(200) PRIMARY KEY,
	value INT(3)
	)";
	
if ($conn2->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn2->error;
}

$sql = "CREATE TABLE questions(
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	question TEXT NOT NULL,
	multiplier INT(3),
	type VARCHAR(50) NOT NULL,
	part_of_game VARCHAR(100) NOT NULL,
	averageable VARCHAR(3) NOT NULL,
	get_max VARCHAR(3) NOT NULL,
	`order` INT(3) NOT NULL,
	num_choices INT(3)
	)";
	
if ($conn2->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn2->error;
}

$sql = "CREATE TABLE interview_questions(
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	question TEXT NOT NULL,
	question_type VARCHAR(10) NOT NULL,
	part_of_game VARCHAR(50) NOT NULL,
	`order` INT(3) NOT NULL,
	num_choices INT(3)
	)";
	
if ($conn2->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn2->error;
}

$conn->close();
header("Location: admin.php");
die();
?> 