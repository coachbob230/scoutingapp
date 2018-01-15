<?php

	session_start();
	
	date_default_timezone_set('America/New_York');

	require'classes/membership.php';

	$membership = new Membership();

	if(isset($_GET['status']) && $_GET['status'] == 'loggedout') {
		$membership->log_User_Out();
	}

	if(!isset($_SESSION['status'])) {
		$_SESSION['status'] = '';
	}
	
	if(!isset($_SESSION['admin_status'])) {
		$_SESSION['admin_status'] = '';
	}
	
	if($_POST && !empty($_POST['firstname']) && !empty($_POST['lastname'])) {
		$response = $membership->validate_user($_POST['firstname'], $_POST['lastname']);	
	}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head> <title> FIRST Team 230 Gaelhawks </title> 
<link href='/scouting/gaelhawks.css' rel='stylesheet'>  
<script src="/scouting/jquery.js" ></script>
<script src='/scouting/scouting.js'></script>
<script>
function validateForm() {
	var x = document.forms["scouting"]["scouter"].value;
	if (x==null || x=="") {
	alert("You must input the name of the scouter");
	return false;
	}
}

</script> 
</head>
<body> 