<?php
	$event = $_POST['ename'];
	$location = $_POST['location'];
	$smonth=$_POST['smonth'];
	$sday=$_POST['sday'];
	$syear=$_POST['syear'];
	$emonth=$_POST['emonth'];
	$eday=$_POST['eday'];
	$eyear=$_POST['eyear'];
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$year = date('Y');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	$game = $row['game'] . "_" . $year;
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
	$sql = "INSERT INTO events (eventname, location, smonth, sday, syear, emonth, eday, eyear) VALUES('$event', '$location', '$smonth', '$sday', '$syear', '$emonth', '$eday', '$eyear')";
	if ($conn->query($sql) === TRUE) {
		echo "Data added successfully\n";
	} else {
		echo "Error adding data: " . $conn->error;
	}
	header("Location: admin.php");
?>