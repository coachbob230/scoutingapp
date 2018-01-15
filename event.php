<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<?php
	
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
	}	
	if(isset($_GET['year'])) {
		$year = $_GET['year'];
	}	
	
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	$game = $row['game'] . "_" . $year;
	$con = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
	
	$result = mysqli_query($con, "SELECT * FROM events WHERE id='$id'");
	
	$row = mysqli_fetch_array($result);
	
	echo "<h1>" . $row['eventname'] . "</h1><br/>
	
	<a href='rankings.php?event=" . $row['eventname'] . "&year=" . $year . "'>Rankings 1</a><br/>
	<a href='rankings2.php?event=" . $row['eventname'] . "&year=" . $year . "'>Rankings 2</a><br/>
	
	<h2>Teams</h2>	";
	
	$event = $row['eventname'];
	
	$result2 = mysqli_query($con, "SELECT * FROM teams WHERE event='$event' ORDER BY teamnumber ASC");
	
	echo "	<table cellpadding='5' border='2px'>
	<tr>
	<td>
	Number
	</td>
	<td>
	Name
	</td>
	</tr>";
	
	while($row2 = mysqli_fetch_array($result2)) {
	$teamnumber = $row2['teamnumber'];
	$result3 = mysqli_query($conn, "SELECT teamname FROM teams WHERE teamnumber = '$teamnumber'");
	$row3 = mysqli_fetch_array($result3);
	
	echo "
	
	<tr>
	<td>
	<a href='team.php?team=" . $row2['teamnumber'] . "&event=" . $row2['event'] . "' style='text-decoration: none'>" . $row2['teamnumber'] . "</a>
	</td>
	<td>
	<a href='team.php?team=" . $row2['teamnumber'] . "&event=" . $row2['event'] . "' style='text-decoration: none'>" . $row3['teamname'] . "</a>
	</td>
	</tr>";
	
	}
	
	echo "</table>";
	
	
?>

</div>

<?php include ('includes/footer.php'); ?>