<?php

require 'mysql.php';

class Membership {

	function validate_user($firstname, $lastname) {
		$mysql = New Mysql();
		$ensure_credentials = $mysql->verify_Username_and_Pass($firstname, $lastname);

	if($ensure_credentials) {
		$_SESSION['status'] = 'authorized';
		$_SESSION['first_name'] = $firstname;
		$_SESSION['last_name'] = $lastname;
		header('location: index.php');
		
		} else return "Sorry, that email/password combination was incorrect. Please enter a correct email and password. Remember, passwords are CaSe sEnSiTiVe.";

	}

	function log_User_Out() {
		$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
		$firstname = $_SESSION['first_name'];
		$lastname = $_SESSION['last_name'];
		$sql = "UPDATE scouter SET loggedin = 'no' WHERE firstname='$firstname' AND lastname='$lastname'";
		if ($conn->query($sql) === TRUE) {
			//echo "Data updated successfully<br/>";
		} else {
			echo "Error updating data: " . $conn->error . "\n" . $sql . "\n";
		}

	if(isset($_SESSION['status'])) {
		unset($_SESSION['status']);
		unset($_SESSION['first_name']);
		unset($_SESSION['last_name']);



		}
	}

}