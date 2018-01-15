<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<?php
	
	if(isset($_GET['event'])) {
		$event = $_GET['event'];
	}
	if(isset($_GET['year'])) {
		$year = $_GET['year'];
	}
	
	echo "<h1>" . $event . " Rankings</h1><br/>";
	
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	$game = $row['game'] . "_" . $year;
	$con = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
	
	echo "<table cellpadding='5' border='2px'>
	<tr>
	<td>
	Rank
	</td>
	<td>
	Team Number
	</td>
	<td>
	Score
	</td>
	</tr>";
	
	$result = mysqli_query($con, "SELECT * FROM teams WHERE event='$event' ORDER BY score DESC, per_ranking, teamnumber");
	$i = 1;
	while($row = mysqli_fetch_array($result)) {
		echo "<tr>
		<td>
		" . $i . "
		</td>
		<td>
		<a href='team.php?team=" . $row['teamnumber'] . "&event=" . $event . "' style='text-decoration: none'>" . $row['teamnumber'] . "</a>
		</td>
		<td>
		" . $row['score'] . "
		</td>
		</tr>";
		$i++;
	}
	echo "</table>";
	
?>

</div>

<?php include ('includes/footer.php'); ?>