<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

	<form action='change_rankings.php' method='POST' name='scouting'>

		<h1>Edit Rankings</h1>
		
		<?php
			$event = $_POST['event'];
			echo "<input type='hidden' name='event' value='" . $event . "'>";
			$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
			$year = date('Y');
			$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
			$row = mysqli_fetch_array($result);
			$game = $row['game'] . "_" . $year;
			$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
			$result3 = mysqli_query($conn2, "SELECT * FROM teams WHERE event='$event' ORDER BY per_ranking, teamnumber");
			$result4 = mysqli_query($conn2, "SELECT COUNT(*) AS num_teams FROM teams WHERE event='$event'");
			$num_teams = mysqli_fetch_array($result4);
			echo "<table>";
			while($row3 = mysqli_fetch_array($result3)) {
				echo "<tr>
				<td>
				" . $row3['teamnumber'] . "
				</td>
				<td>
				<select name='" . $row3['teamnumber'] . "ranking'>
					<option value='0'>0</option>";
				$i = 1;
				while($i <= $num_teams['num_teams']) {
					echo "<option value='" . $i . "' ";
					if($row3['per_ranking'] == $i)
						echo "selected";
					echo ">" . $i . "</option>";
					$i++;
				}
				echo "</td>
				</tr>";
					
			}
			echo "</table>";
		?>
		<input type='submit' value='Submit'>

	</form>

</div>

<?php include ("includes/footer.php"); ?>