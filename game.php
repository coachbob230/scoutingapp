<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<?php
	
	if(isset($_GET['id'])) {
	
		$year = $_GET['id'];
		
	}	
	
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	$game = $row['game'] . "_" . $year;
	$con = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
	
	echo "<h1>" . $row['game'] . "</h1><br/><h2>Events</h2>	";
	
	$result = mysqli_query($con, "SELECT * FROM events");
	
	echo "<table cellspacing='' style='font-size: 13px; text-align: center'>
	<tr>";
	
	while($row = mysqli_fetch_array($result)) {
	
	echo "
	<td>
	<a href='event.php?id=" . $row['id'] . "&year=" . $year . "' style='text-decoration: none'>" . $row['eventname'] . "</a>
	</td>";
	
	}
	
	echo "</tr>
	<tr>";
	
	$result = mysqli_query($con, "SELECT * FROM events");
	
	while($row = mysqli_fetch_array($result)) {
	
	echo "<td>" 
	. $row['smonth'] . "/" . $row['sday'] . "/" . $row['syear'] . " to " . $row['emonth'] . "/" . $row['eday'] . "/" . $row['eyear'] . 
	"</td>";
	
	}
	
	echo "</tr>
	<tr>";
	
	$result = mysqli_query($con, "SELECT * FROM events");
	
	while($row = mysqli_fetch_array($result)) {
	
	echo "<td width='305'>
	At: "
	. $row['location'] . 
	"</td>";
	
	}
	
	echo "</tr>
	</table>";
	
	
?>

</div>

<?php include ('includes/footer.php'); ?>