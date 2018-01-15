<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>
<?php
	if(isset($_GET['team']))
		$team = $_GET['team'];
	if(isset($_GET['event']))
		$event = $_GET['event'];
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$result = mysqli_query($conn, "SELECT * FROM teams WHERE teamnumber='$team'");
	$row = mysqli_fetch_array($result);
	$teamname = $row['teamname'];
	echo "<h1>" . $teamname . "</h1>";
	$year = date('Y');
	$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
	$row = mysqli_fetch_array($result);
	$game = $row['game'] . "_" . $year;
	$game_name = $row['game'];
	$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
	$result = mysqli_query($conn2, "SELECT * FROM teams WHERE teamnumber='$team'");
	$row = mysqli_fetch_array($result);
?>
<b>Ranking at <?php echo $event; ?>: </b><?php echo $row['per_ranking']; ?>
<div style='border-bottom: 1px solid white; clear:both'>
<div style='float: left; width: 66%'>
<h2>Interview Sheet</h2>

<a href='edit_interview.php?team=<?php echo $team; ?>&event=<?php echo $event; ?>'>Edit Interview Sheet</a>
<?php
			$result3 = mysqli_query($conn, "SELECT * FROM interview_attributes WHERE game='$game_name'");
			$result4 = mysqli_query($conn2, "SELECT * FROM interview_sheet WHERE teamnumber='$team'");
			$row4 = mysqli_fetch_array($result4);
			while($row3 = mysqli_fetch_array($result3)) {
				$attribute = $row3['attribute'];
				$result2 = mysqli_query($conn2, "SELECT * FROM interview_questions WHERE part_of_game='$attribute'");
				echo "<h3>" . $attribute . "</h3>
				<table>";
				while($row2 = mysqli_fetch_array($result2)) {
					echo "<tr>
					<td>
					<u>" . str_replace('_', ' ', $row2['question']) . "</u>
					</td>
					<td>
					" . $row4[$row2['question']] . "
					</td>
					</tr>";
				}
				echo "</table>";
			}
			echo "<h3>Other Comments</h3>
			<p>" . $row4['comments'] . "</p>";
		?>
<br style="clear: both;" />
</div>
<div style='float: right; width:32%;'>
<h2>Their robot</h2>
<?php
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	if(isset($_GET['team']))
		$team = $_GET['team'];
	$result = mysqli_query($conn, "SELECT * FROM teams WHERE teamnumber='$team'");
	$row = mysqli_fetch_array($result);
	if($row['robot_picture'] != '')
		echo "<img src='pictures/" . $row['robot_picture'] . "' width='90%'>";
	else
		echo "No Picture is available.";
?>
<form name='upload_picture' method='POST' action='change_picture.php' enctype="multipart/form-data">
<h3>Change picture</h3>
<input type='file' name='robotpic'><br/><br/>
<input type='hidden' name='team' value='<?php echo $_GET['team']; ?>'>
<input type='hidden' name='event' value='<?php echo $_GET['event']; ?>'>
<input type='submit' value='Submit'>
</form>
<br style="clear: both">
</div>
<br style="clear: both;" />
</div>
<div style='float: left; width: 50%; text-align: center; font-size: 14px'>
<h2>Averages</h2>
	<?php
		if(isset($_GET['team']))
			$team = $_GET['team'];
		$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
		$year = date('Y');
		$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
		$row = mysqli_fetch_array($result);
		$game = $row['game'] . "_" . $year;
		$game_name = $row['game'];
		$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
		$result2 = mysqli_query($conn2, "SELECT * FROM questions WHERE averageable='yes'");
		echo "<table align='center' style='text-align: left'>";
		while($row2 = mysqli_fetch_array($result2)) {
			$question = $row2['question'];
			$result3 = mysqli_query($conn2, "SELECT AVG(`$question`) AS AverageResponse FROM scouting WHERE teamnumber='$team'");
			$row3 = mysqli_fetch_array($result3);
			echo "<tr>
			<td>
			" . str_replace("_", " ", $question) . " 
			</td>
			<td>
			" . round($row3['AverageResponse'], 2) . "
			</td>
			</tr>";
		}
		echo "</table>
		</div>
		<div style='float: left; min-width:50%;  text-align: center; font-size:14px'>
		<h2>Maxs</h2>";
		$result2 = mysqli_query($conn2, "SELECT * FROM questions WHERE get_max='yes'");
		echo "<table align='center' style='text-align: left'>";
		while($row2 = mysqli_fetch_array($result2)) {
			$question = $row2['question'];
			$result3 = mysqli_query($conn2, "SELECT MAX(`$question`) AS MaxResponse FROM scouting WHERE teamnumber='$team'");
			$row3 = mysqli_fetch_array($result3);
			echo "<tr>
			<td>
			" . str_replace("_", " ", $question) . " 
			</td>
			<td>
			" . $row3['MaxResponse'] . "
			</td>
			</tr>";
		}
		echo "</table>
		</div>
		<div style='width: 100%; height: 150px'></div>
		<div style='width: 100%; float: left'>
		<table style='font-size: 10px; text-align: center; padding-bottom: 20px'>
		<tr>
		<td>
		Match
		</td>
		<td>
		Scouter
		</td>
		<td>
		Event
		</td>";
		$result5 = mysqli_query($conn, "SELECT * FROM match_scouting_attributes WHERE game='$game_name'");
		while($row5 = mysqli_fetch_array($result5)) {
			$attribute = $row5['attribute'];
			$result2 = mysqli_query($conn2, "SELECT * FROM questions WHERE part_of_game='$attribute' ORDER BY `order`");
			while($row2 = mysqli_fetch_array($result2)) {
				echo "<td>
				" . str_replace("_", " ", $row2['question']) . "
				</td>";
			}
		}
		echo "
		</tr>";
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE teamnumber='$team' AND event='$event'");
		while($row3 = mysqli_fetch_array($result3)) {
			echo "<tr>
			<td>
			" . $row3['matchnumber'] . "
			</td>
			<td>
			" . $row3['scouter'] . "
			</td>
			<td>
			" . $row3['event'] . "
			</td>";
			$result5 = mysqli_query($conn, "SELECT * FROM match_scouting_attributes WHERE game='$game_name'");
			while($row5 = mysqli_fetch_array($result5)) {
				$attribute = $row5['attribute'];
				$result4 = mysqli_query($conn2, "SELECT * FROM questions WHERE part_of_game='$attribute' ORDER BY `order`");
				while($row4 = mysqli_fetch_array($result4)) {
					$question = $row4['question'];
					echo "<td>
					" . $row3[$question] . "
					</td>";
				}
			}
			echo "
			</tr>";
		}
		echo "<tr>
		<td>
		<b>TOTALS: </b>
		</td>
		<td></td>
		<td></td>";
		$result5 = mysqli_query($conn, "SELECT * FROM match_scouting_attributes WHERE game='$game_name'");
		while($row5 = mysqli_fetch_array($result5)) {
			$attribute = $row5['attribute'];
			$result4 = mysqli_query($conn2, "SELECT * FROM questions WHERE part_of_game='$attribute' ORDER BY `order`");
			while($row4 = mysqli_fetch_array($result4)) {
				$question = $row4['question'];
				$score = 0;
				$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE teamnumber='$team' AND event='$event'");
				while($row3 = mysqli_fetch_array($result3)) {
					$id = $question . $row3[$question];
					$result6 = mysqli_query($conn2, "SELECT * FROM scoring WHERE id='$id'");
					$row6 = mysqli_fetch_array($result6);
					$score += $row6['value'];
				}
				echo "<td>
				" . $score . "
				</td>";
			}
		}
		echo "</tr>
		</table>
		</div>";
		
	?>
	<h2>Comments</h2>
	<table style='font-size: 13px; cell-spacing:5px'>
	<tr>
	<td>
	Match
	</td>
	<td>
	Scouter
	</td>
	<td>
	Comment
	</td>
	</tr>
	<?php
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE teamnumber='$team' AND event='$event'");
		while($row3 = mysqli_fetch_array($result3)) {
			echo "<tr>
			<td style='text-align:center'>
			" . $row3['matchnumber'] . "
			</td>
			<td>
			" . $row3['scouter'] . "
			</td>
			<td>
			" . $row3['comments'] . "
			</td>
			</tr>";
		}
	?>
	</table>
			
	
	</div>

<?php include ('includes/footer.php'); ?>