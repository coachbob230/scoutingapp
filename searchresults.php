<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<?php
	if($_POST['search_type'] == 'match') {
		$matchnumber = $_POST['match'];
		$event = $_POST['event'];
		$scouter = $_POST['scouter'];
		$teamnumber = $_POST['team'];
		$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
		$year = date('Y');
		$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
		$row = mysqli_fetch_array($result);
		$game = $row['game'] . "_" . $year;
		$game_name = $row['game'];
		$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
		echo "<table style='font-size: 10px; text-align: center; padding-bottom: 20px'>
			<tr>
			<td>
			Match
			</td>
			<td>
			Scouter
			</td>
			<td>
			Event
			</td>
			<td>
			Team
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
			include('search_poss.php');
			while($row3 = mysqli_fetch_array($result3)) {
				$check = true;
				$result2 = mysqli_query($conn2, "SELECT * FROM questions");
				while($row2 = mysqli_fetch_array($result2)) {
					$question = $row2['question'];
					if($row2['averageable'] == 'yes') {
						if($_POST[$question] != '' && $_POST[$question] > $row3[$question]) {
							$check = false;
							break;
							echo "Check failed<br/>";
						}
					}
					else {
						if($_POST[$question] != '' && $_POST[$question] != $row3[$question]) {
							$check = false;
							break;
							echo "Check failed<br/>";
						}
					}
				}
				if($check) {
					echo "<tr>
					<td>
					" . $row3['matchnumber'] . "
					</td>
					<td>
					" . $row3['scouter'] . "
					</td>
					<td>
					" . $row3['event'] . "
					</td>
					<td>
					" . $row3['teamnumber'] . "
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
			}
			echo "</table>";
	}
	else if($_POST['search_type'] == 'inter') {
		$teamnumber = $_POST['team'];
		$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
		$year = date('Y');
		$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
		$row = mysqli_fetch_array($result);
		$game = $row['game'] . "_" . $year;
		$game_name = $row['game'];
		$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
		if($teamnumber != '')
			$result3 = mysqli_query($conn2, "SELECT * FROM interview_sheet WHERE teamnumber='$teamnumber'");
		else
			$result3 = mysqli_query($conn2, "SELECT * FROM interview_sheet");
		while($row3 = mysqli_fetch_array($result3)) {
			$check = true;
			$result2 = mysqli_query($conn2, "SELECT * FROM interview_questions");
			while($row2 = mysqli_fetch_array($result2)) {
				$question = $row2['question'];
				if($_POST[$question] != '' && $_POST[$question] != $row3[$question]) {
					$check = false;
					break;
					echo "Check failed<br/>";
				}
			}
			if($check) {
				echo "<div style='border-bottom: 2px solid black'>
				<h1>Team " . $row3['teamnumber'] . "</h1>";
				$result4 = mysqli_query($conn, "SELECT * FROM interview_attributes WHERE game='$game_name'");
				while($row4 = mysqli_fetch_array($result4)) {
					$attribute = $row4['attribute'];
					$result2 = mysqli_query($conn2, "SELECT * FROM interview_questions WHERE part_of_game='$attribute'");
					echo "<h2>" . $attribute . "</h2>
					<table>";
					while($row2 = mysqli_fetch_array($result2)) {
						echo "<tr>
						<td>
						<u>" . str_replace('_', ' ', $row2['question']) . "</u>
						</td>
						<td>
						" . $row3[$row2['question']] . "
						</td>
						</tr>";
					}
					echo "</table>";
				}
				echo "<h2>Other Comments</h2>
				<p>" . $row3['comments'] . "</p>
				</div>";
			}
		}
	}
?>

</div>

<?php include ('includes/footer.php'); ?>