<?php

	if($matchnumber != '' && $event != '' && $teamnumber != '' && $scouter != '')
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE matchnumber='$matchnumber' AND event='$event' AND teamnumber='$teamnumber' AND scouter='$scouter'");
	else if($matchnumber == '' && $event != '' && $teamnumber != '' && $scouter != '')
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE event='$event' AND teamnumber='$teamnumber' AND scouter='$scouter'");
	else if($matchnumber != '' && $event != '' && $teamnumber == '' && $scouter != '')
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE matchnumber='$matchnumber' AND event='$event' AND scouter='$scouter'");
	else if($matchnumber != '' && $event == '' && $teamnumber != '' && $scouter != '')
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE matchnumber='$matchnumber' AND teamnumber='$teamnumber' AND scouter='$scouter'");
	else if($matchnumber == '' && $event == '' && $teamnumber != '' && $scouter != '')
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE teamnumber='$teamnumber' AND scouter='$scouter'");
	else if($matchnumber == '' && $event != '' && $teamnumber == '' && $scouter != '')
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE event='$event' AND scouter='$scouter'");
	else if($matchnumber != '' && $event == '' && $teamnumber == '' && $scouter != '')
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE matchnumber='$matchnumber' AND scouter='$scouter'");
	else if($matchnumber == '' && $event == '' && $teamnumber == '' && $scouter != '')
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE scouter='$scouter'");
	else if($matchnumber != '' && $event != '' && $teamnumber != '' && $scouter == '')
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE matchnumber='$matchnumber' AND event='$event' AND teamnumber='$teamnumber'");
	else if($matchnumber == '' && $event != '' && $teamnumber != '' && $scouter == '')
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE event='$event' AND teamnumber='$teamnumber'");
	else if($matchnumber != '' && $event != '' && $teamnumber == '' && $scouter == '')
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE matchnumber='$matchnumber' AND event='$event'");
	else if($matchnumber != '' && $event == '' && $teamnumber != '' && $scouter == '')
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE matchnumber='$matchnumber' AND teamnumber='$teamnumber'");
	else if($matchnumber == '' && $event == '' && $teamnumber != '' && $scouter == '')
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE teamnumber='$teamnumber'");
	else if($matchnumber == '' && $event != '' && $teamnumber == '' && $scouter == '')
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE event='$event'");
	else if($matchnumber != '' && $event == '' && $teamnumber == '' && $scouter == '')
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting WHERE matchnumber='$matchnumber'");
	else
		$result3 = mysqli_query($conn2, "SELECT * FROM scouting");
	
?>