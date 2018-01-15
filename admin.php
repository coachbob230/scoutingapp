<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<?php

	if($_POST && !empty($_POST['password'])) {
		if($_POST['password'] == 'Ga3lh4wks')
			$_SESSION['admin_status'] = 'authorized';
	}

	if($_SESSION['admin_status'] != "authorized") {
		echo "<h1 style='text-align:center'>Log In</h1>";
		if(isset($response))
			echo $response . "<br/>";
		echo "Please enter the password to access the admin page.
		<form method='POST' name='login' action='admin.php'>
		Password: <input type='password' name='password'>
		<br>
		<input type='submit' value='Submit'>
		</form>
		</div>";
	}
	else {
		echo "
			<h1 style='text-align:center'>Admin</h1>
			<br class='clear' />
			<div style='float: left; width: 50%;'>
			<h2>Scouting Questions</h2>";

		$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
		$year = date('Y');
		$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
		$row = mysqli_fetch_array($result);
		if($row['game'] != '') {
			$game = $row['game'] . "_" . $year;
			$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
		

		echo "
			<table style='font-size: 10px'>
			<tr>
			<td>
			<a href='new_game_questions.php?game=" . $game . "'>Add questions</a>
			</td>
			</tr>
			<tr>
			<td>
			<form method='POST' name='edit_question' action='edit_question.php'>Edit Question:
			</td>
			<td> 
			<select name='question'>";

		$result = mysqli_query($conn2, "SELECT * FROM questions");
		while($row = mysqli_fetch_array($result)) {
			echo "<option value='" . $row['question'] . "'>
			" . str_replace("_", " ", $row['question']) . "
			</option>";
		}

		echo "
			</select>
			</td>
			<td>
			<input type='submit' value='Go'>
			</td>
			</tr>
			</form>
			<tr>
			<td>
			<form method='POST' name='delete_question' action='delete_question.php'>Delete Question: 
			</td>
			<td>
			<select name='question'>";

		$result = mysqli_query($conn2, "SELECT * FROM questions");
		while($row = mysqli_fetch_array($result)) {
			echo "<option value='" . $row['question'] . "'>
			" . str_replace("_", " ", $row['question']) . "
			</option>";
		}
		echo "
			</select>
			</td>
			<td>
			<input type='submit' value='Go'>
			</td>
			</tr>
			<tr>
			<td>
			<a href='question_order.php'>Order Questions</a>
			</td>
			</tr>
			</table>
			</form>
			</div>

			<div style='float: right; width:50%;'>
			<h2>Interview Questions</h2>
			
			<table  style='font-size: 10px'>
			<tr>
			<td>
			<a href='new_interview_questions.php?game=" . $game . "'>Add questions</a>
			</td>
			</tr>
			<tr>
			<td>
			<form method='POST' name='edit_interview_question' action='edit_interview_question.php'>Edit Question:
			</td> 
			<td> 
			<select name='question'>";

		$result = mysqli_query($conn2, "SELECT * FROM interview_questions");
		while($row = mysqli_fetch_array($result)) {
			echo "<option value='" . $row['question'] . "'>
			" . str_replace("_", " ", $row['question']) . "
			</option>";
		}

		echo "
			</select>
			</td>
			<td>
			<input type='submit' value='Go'>
			</td>
			</tr>
			</form>
			<tr>
			<td>
			<form method='POST' name='delete_interview_question' action='delete_interview_question.php'>Delete Question: 
			</td>
			<td>
			<select name='question'>";

		$result = mysqli_query($conn2, "SELECT * FROM interview_questions");
		while($row = mysqli_fetch_array($result)) {
			echo "<option value='" . $row['question'] . "'>
			" . str_replace("_", " ", $row['question']) . "
			</option>";
		}
		echo "
			</select>
			</td>
			<td>
			<input type='submit' value='Go'>
			</td>
			</tr>
			<tr>
			<td>
			<a href='iv_question_order.php'>Order Questions</a>
			</td>
			</tr>
			</table>
			</form>
			</div>

			<div style='float: left; width: 50%'>
				<h2> Game Actions </h2>
				<table style='font-size: 10px'>
				<tr>
				<td>
				<a href='create_game.php'>New game</a>
				</td>
				</tr>
				<tr>
				<td>
				<form method='POST' name='edit_game' action='edit_game.php'>Edit game:
				</td>
				<td>
				<select name='game'>";

				$result = mysqli_query($conn, "SELECT * FROM games");
				while($row = mysqli_fetch_array($result)) {
					echo "<option value='" . $row['game'] . "'>
					" . str_replace("_", " ", $row['game']) . "
					</option>";
				}

				echo "
				</select>
				</td>
				<td>
				<input type='submit' value='Go'>
				</form>
				</td>
				</tr>
				<tr>
				<td>
				<form method='POST' name='delete_game' action='delete_game.php'>Delete game:
				</td>
				<td>
				<select name='game'>";

				$result = mysqli_query($conn, "SELECT * FROM games");
				while($row = mysqli_fetch_array($result)) {
					echo "<option value='" . $row['game'] . "'>
					" . str_replace("_", " ", $row['game']) . "
					</option>";
				}

				echo "
				</select>
				</td>
				<td>
				<input type='submit' value='Go'>
				</form>
				</td>
				</tr>
				<tr>
				<td>
				<form method='POST' name='edit_match_data' action='edit_match.php'>Edit Match Data: 
				</td>
				<td>
				<select name='event'>";

				$result = mysqli_query($conn2, "SELECT * FROM events");
				while($row = mysqli_fetch_array($result)) {
					echo "<option value='" . $row['eventname'] . "'>
					" . $row['eventname'] . "
					</option>";
				}

				echo "
				</select>
				</td>
				<td>
				Match: <input type='text' name='matchnumber' size='2'>
				</td>
				<td>
				<input type='submit' value='Go'>
				</form>
				</td>
				</form>
				</tr>
				<tr>
				<td>
				<a href='edit_match_scouting_attributes.php'>Edit Match Scouting Attributes</a>
				</td>
				</tr>
				<tr>
				<td>
				<a href='edit_interview_attributes.php'>Edit Interview Attributes</a>
				</td>
				</tr>
				<tr>
				<td>
				<a href='new_event.php'>Add Event</a>
				</td>
				</tr>
				<tr>
				<td>
				<form method='POST' name='edit_event' action='edit_event.php'>Edit Event:
				</td>
				<td>
				<select name='event'>";

				$result = mysqli_query($conn2, "SELECT * FROM events");
				while($row = mysqli_fetch_array($result)) {
					echo "<option value='" . $row['eventname'] . "'>
					" . $row['eventname'] . "
					</option>";
				}

				echo "
				</select>
				</td>
				<td>
				<input type='submit' value='Go'>
				</form>
				</td>
				</tr>
				<tr>
				<td>
				<form method='POST' name='delete_event' action='delete_event.php'>Delete Event:
				</td>
				<td>
				<select name='event'>";

				$result = mysqli_query($conn2, "SELECT * FROM events");
				while($row = mysqli_fetch_array($result)) {
					echo "<option value='" . $row['eventname'] . "'>
					" . $row['eventname'] . "
					</option>";
				}

				echo "
				</select>
				</td>
				<td>
				<input type='submit' value='Go'>
				</form>
				</td>
				</tr>
				<tr>
				<td>
				<form method='POST' name='add_to_event' action='add_team.php'>Add Team to Event:
				</td>
				<td>
				<select name='event'>";

				$result = mysqli_query($conn2, "SELECT * FROM events");
				while($row = mysqli_fetch_array($result)) {
					echo "<option value='" . $row['eventname'] . "'>
					" . $row['eventname'] . "
					</option>";
				}

				echo "
				</select>
				</td>
				<td>
				<input type='submit' value='Go'>
				</form>
				</td>
				</tr>
				<tr>
				<td>
				<form method='POST' name='remove_from_event' action='remove_team.php'>Remove Team from Event:
				</td>
				<td>
				<select name='event'>";

				$result = mysqli_query($conn2, "SELECT * FROM events");
				while($row = mysqli_fetch_array($result)) {
					echo "<option value='" . $row['eventname'] . "'>
					" . $row['eventname'] . "
					</option>";
				}

				echo "
				</select>
				</td>
				<td>
				<input type='submit' value='Go'>
				</form>
				</td>
				</tr>
				</table>
			</div>
			
			<div style='float:right; width:50%'>
				<h2>General Actions</h2>
				<table style='font-size: 10px'>
				<tr>
				<td>
				<a href='new_team.php'>Add a new Team</a>
				</td>
				</tr>
				<tr>
				<td>
				Edit a team: 
				</td>
				<td>
				<form method='POST' name='edit_team' action='edit_team.php'>
				<input type='text' name='teamnumber'>
				</td>
				<td>
				<input type='submit' value='Go'>
				</form>
				</td>
				</tr>
				<tr>
				<td>
				Delete a team: 
				</td>
				<td>
				<form method='POST' name='delete_team' action='delete_team.php'>
				<input type='text' name='teamnumber'>
				</td>
				<td>
				<input type='submit' value='Go'>
				</form>
				</td>
				</tr>
				<tr>
				<td>
				<form method='POST' name='edit_rankings' action='edit_rankings.php'>Edit rankings for Event:
				</td>
				<td>
				<select name='event'>";

				$result = mysqli_query($conn2, "SELECT * FROM events");
				while($row = mysqli_fetch_array($result)) {
					echo "<option value='" . $row['eventname'] . "'>
					" . $row['eventname'] . "
					</option>";
				}

				echo "
				</select>
				</td>
				<td>
				<input type='submit' value='Go'>
				</form>
				</td>
				</tr>
				<tr>
				<td>
				<a href='new_scouter.php'>Add a new Scouter</a>
				</td>
				</tr>
				<tr>
				<td>
				<a href='scouters.php'>View current Scouters</a>
				</td>
				</tr>
				<tr>
				<td>
				<form method='POST' name='recalculate_scores' action='recalculate_scores.php'>Recalculate scores for Event:
				</td>
				<td>
				<select name='event'>";

				$result = mysqli_query($conn2, "SELECT * FROM events");
				while($row = mysqli_fetch_array($result)) {
					echo "<option value='" . $row['eventname'] . "'>
					" . $row['eventname'] . "
					</option>";
				}

				echo "
				</select>
				</td>
				<td>
				<input type='submit' value='Go'>
				</form>
				</td>
				</tr>
				
				</table>
			</div>

			</div>";
		}
		else {
			echo "There is no game for this year yet. <a href='create_game.php'>Create a new game?</a>
			</div>
			</div>";
		}
	}

?>

<?php include ('includes/footer.php'); ?>