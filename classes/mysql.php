<?php
	
	require_once 'includes/constants.php';
	class Mysql {
		private $conn;

	function __construct() {
		$this->conn = new mysqli (DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or 
			die('There was a problem connecting to the database.');
	}

	function verify_Username_and_Pass($firstname, $lastname) {


	$query = "SELECT *
		FROM scouter
		WHERE firstname = ? AND lastname = ?
		LIMIT 1";

		
	if($stmt = $this->conn->prepare($query)) {
		$stmt->bind_param('ss', $firstname, $lastname);
		$stmt->execute();
		$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
		$sql = "UPDATE scouter SET loggedin = 'yes' WHERE firstname='$firstname' AND lastname='$lastname'";
		if ($conn->query($sql) === TRUE) {
			echo "Data updated successfully<br/>";
		} else {
			echo "Error updating data: " . $conn->error . "\n" . $sql . "\n";
		}

		if($stmt->fetch()) {
			$stmt->close();
			return true;
			}
		}
	}
}