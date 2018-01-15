<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<h1>Gaelhawks Scouting</h1>

<h2>Games</h2>

<?php

$con = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$result = mysqli_query($con, "SELECT * FROM games ORDER BY year ASC LIMIT 30");
	
	echo "<table style='text-align: center'>
	<tr>";
	
	while($row = mysqli_fetch_array($result)) {
	
	echo "
	<td>
	<a href='game.php?id=" . $row['year'] . "' style='text-decoration: none'><img src='pictures/" . $row['gamelogo'] . "' height='84px' width='142'> </a>
	</td>";
	
	}
	
	echo "</tr>
	<tr>";
	
	$result = mysqli_query($con, "SELECT * FROM games ORDER BY year ASC LIMIT 30");
	
	while($row = mysqli_fetch_array($result)) {
		
	$game = str_replace('_', ' ', $row['game']);
	
	echo "<td>
	<a href='game.php?id=" . $row['year'] . "' style='text-decoration: none'>" . $game . "</a>
	</td>";
	
	}
	
	echo "</tr>
	</table>";
	
?>
</div>

<?php include ('includes/footer.php'); ?>