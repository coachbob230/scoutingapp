<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

	<form action='change_iv_order.php' method='POST' name='scouting'>

		<h1>Interview Question Order</h1>
		
		<?php
			$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
			$year = date('Y');
			$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
			$row = mysqli_fetch_array($result);
			$game = $row['game'] . "_" . $year;
			$game_name = $row['game'];
			$result3 = mysqli_query($conn, "SELECT * FROM interview_attributes WHERE game='$game_name'");
			while($row3 = mysqli_fetch_array($result3)) {
				$attribute = $row3['attribute'];
				$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
				$result2 = mysqli_query($conn2, "SELECT * FROM interview_questions WHERE part_of_game='$attribute'");
				$result4 = mysqli_query($conn2, "SELECT COUNT(*) AS num_questions FROM interview_questions WHERE part_of_game='$attribute'");
				$num_questions = mysqli_fetch_array($result4);
				echo "<h2>" . $attribute . "</h2>
				<table>";
				while($row2 = mysqli_fetch_array($result2)) {
					echo "<tr>
					<td>
					" . str_replace("_", " ", $row2['question']) . "
					</td>
					<td>
					<select name='" . $row2['question'] . "order'>
						<option value='0'>0</option>";
					$i = 1;
					while($i <= $num_questions['num_questions']) {
						echo "<option value='" . $i . "' ";
						if($row2['order'] == $i)
							echo "selected";
						echo ">" . $i . "</option>";
						$i++;
					}
					echo "</td>
					</tr>";
					
				}
				echo "</table>";
			}
		?>
		<input type='submit' value='Submit'>

	</form>

</div>

<?php include ("includes/footer.php"); ?>