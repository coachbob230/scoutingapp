<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<h2 style='text-align:center'>Edit Event</h2>

<?php

$event = $_POST['event'];
$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
$year = date('Y');
$result = mysqli_query($conn, "SELECT * FROM games WHERE year='$year'");
$row = mysqli_fetch_array($result);
$game = $row['game'] . "_" . $year;
$conn2 = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', $game);
$result2 = mysqli_query($conn2, "SELECT * FROM events WHERE eventname='$event'");
$row2 = mysqli_fetch_array($result2);

if(!empty($_POST['submit']) && $_POST['submit'] == "Edit") {
	$location = $_POST['location'];
	$id = $_POST['id'];
	$smonth=$_POST['smonth'];
	$sday=$_POST['sday'];
	$syear=$_POST['syear'];
	$emonth=$_POST['emonth'];
	$eday=$_POST['eday'];
	$eyear=$_POST['eyear'];
	
	$sql = "UPDATE events SET eventname='$event', location='$location', smonth='$smonth', sday='$sday', syear='$syear', emonth='$emonth', eday='$eday', eyear='$eyear' WHERE id='$id'";
	if ($conn2->query($sql) === TRUE) {
		echo "<div align='center'>Team Added Successfully</div>";
	} else {
		echo "Error adding data: " . $conn->error;
	}
	header("Location: admin.php");
}

?>

<form name='edit_event' action='' method='POST'>
<input type='hidden' name='id' value='<?php echo $row2['id']; ?>'>

<table align='center'>
<tr>
<td>
Event Name: 
</td>
<td>
<input type='text' name='event' value='<?php echo $row2['eventname']; ?>'>
</td>
</tr>
<tr>
<td>
Location: 
</td>
<td>
<input type='text' name='location' value='<?php echo $row2['location']; ?>'>
</td>
</tr>
<tr>
<td>
Start Date
</td>
<td>
<select name='smonth'>
	<option value='1'<?php if($row2['smonth'] == '1') echo " selected"; ?>>January</option>
	<option value='2'<?php if($row2['smonth'] == '2') echo " selected"; ?>>February</option>
	<option value='3'<?php if($row2['smonth'] == '3') echo " selected"; ?>>March</option>
	<option value='4'<?php if($row2['smonth'] == '4') echo " selected"; ?>>April</option>
	<option value='5'<?php if($row2['smonth'] == '5') echo " selected"; ?>>May</option>
	<option value='6'<?php if($row2['smonth'] == '6') echo " selected"; ?>>June</option>
	<option value='7'<?php if($row2['smonth'] == '7') echo " selected"; ?>>July</option>
	<option value='8'<?php if($row2['smonth'] == '8') echo " selected"; ?>>August</option>
	<option value='9'<?php if($row2['smonth'] == '9') echo " selected"; ?>>September</option>
	<option value='10'<?php if($row2['smonth'] == '10') echo " selected"; ?>>October</option>
	<option value='11'<?php if($row2['smonth'] == '11') echo " selected"; ?>>November</option>
	<option value='12'<?php if($row2['smonth'] == '12') echo " selected"; ?>>December</option>
</select> 
<select name='sday'>
	<option value='1'<?php if($row2['sday'] == '1') echo " selected"; ?>>1</option>
	<option value='2'<?php if($row2['sday'] == '2') echo " selected"; ?>>2</option>
	<option value='3'<?php if($row2['sday'] == '3') echo " selected"; ?>>3</option>
	<option value='4'<?php if($row2['sday'] == '4') echo " selected"; ?>>4</option>
	<option value='5'<?php if($row2['sday'] == '5') echo " selected"; ?>>5</option>
	<option value='6'<?php if($row2['sday'] == '6') echo " selected"; ?>>6</option>
	<option value='7'<?php if($row2['sday'] == '7') echo " selected"; ?>>7</option>
	<option value='8'<?php if($row2['sday'] == '8') echo " selected"; ?>>8</option>
	<option value='9'<?php if($row2['sday'] == '9') echo " selected"; ?>>9</option>
	<option value='10'<?php if($row2['sday'] == '10') echo " selected"; ?>>10</option>
	<option value='11'<?php if($row2['sday'] == '11') echo " selected"; ?>>11</option>
	<option value='12'<?php if($row2['sday'] == '12') echo " selected"; ?>>12</option>
	<option value='13'<?php if($row2['sday'] == '13') echo " selected"; ?>>13</option>
	<option value='14'<?php if($row2['sday'] == '14') echo " selected"; ?>>14</option>
	<option value='15'<?php if($row2['sday'] == '15') echo " selected"; ?>>15</option>
	<option value='16'<?php if($row2['sday'] == '16') echo " selected"; ?>>16</option>
	<option value='17'<?php if($row2['sday'] == '17') echo " selected"; ?>>17</option>
	<option value='18'<?php if($row2['sday'] == '18') echo " selected"; ?>>18</option>
	<option value='19'<?php if($row2['sday'] == '19') echo " selected"; ?>>19</option>
	<option value='20'<?php if($row2['sday'] == '20') echo " selected"; ?>>20</option>
	<option value='21'<?php if($row2['sday'] == '21') echo " selected"; ?>>21</option>
	<option value='22'<?php if($row2['sday'] == '22') echo " selected"; ?>>22</option>
	<option value='23'<?php if($row2['sday'] == '23') echo " selected"; ?>>23</option>
	<option value='24'<?php if($row2['sday'] == '24') echo " selected"; ?>>24</option>
	<option value='25'<?php if($row2['sday'] == '25') echo " selected"; ?>>25</option>
	<option value='26'<?php if($row2['sday'] == '26') echo " selected"; ?>>26</option>
	<option value='27'<?php if($row2['sday'] == '27') echo " selected"; ?>>27</option>
	<option value='28'<?php if($row2['sday'] == '28') echo " selected"; ?>>28</option>
	<option value='29'<?php if($row2['sday'] == '29') echo " selected"; ?>>29</option>
	<option value='30'<?php if($row2['sday'] == '30') echo " selected"; ?>>30</option>
	<option value='31'<?php if($row2['sday'] == '31') echo " selected"; ?>>31</option>
</select>
<?php echo date('Y'); ?>
<input type='hidden' name='syear' value='<?php echo date('Y'); ?>'>
</td>
</tr>
<tr>
<td>
End Date: 
</td>
<td>
<select name='emonth'>
	<option value='1'<?php if($row2['emonth'] == '1') echo " selected"; ?>>January</option>
	<option value='2'<?php if($row2['emonth'] == '2') echo " selected"; ?>>February</option>
	<option value='3'<?php if($row2['emonth'] == '3') echo " selected"; ?>>March</option>
	<option value='4'<?php if($row2['emonth'] == '4') echo " selected"; ?>>April</option>
	<option value='5'<?php if($row2['emonth'] == '5') echo " selected"; ?>>May</option>
	<option value='6'<?php if($row2['emonth'] == '6') echo " selected"; ?>>June</option>
	<option value='7'<?php if($row2['emonth'] == '7') echo " selected"; ?>>July</option>
	<option value='8'<?php if($row2['emonth'] == '8') echo " selected"; ?>>August</option>
	<option value='9'<?php if($row2['emonth'] == '9') echo " selected"; ?>>September</option>
	<option value='10'<?php if($row2['emonth'] == '10') echo " selected"; ?>>October</option>
	<option value='11'<?php if($row2['emonth'] == '11') echo " selected"; ?>>November</option>
	<option value='12'<?php if($row2['emonth'] == '12') echo " selected"; ?>>December</option>
</select> 
<select name='eday'>
	<option value='1'<?php if($row2['eday'] == '1') echo " selected"; ?>>1</option>
	<option value='2'<?php if($row2['eday'] == '2') echo " selected"; ?>>2</option>
	<option value='3'<?php if($row2['eday'] == '3') echo " selected"; ?>>3</option>
	<option value='4'<?php if($row2['eday'] == '4') echo " selected"; ?>>4</option>
	<option value='5'<?php if($row2['eday'] == '5') echo " selected"; ?>>5</option>
	<option value='6'<?php if($row2['eday'] == '6') echo " selected"; ?>>6</option>
	<option value='7'<?php if($row2['eday'] == '7') echo " selected"; ?>>7</option>
	<option value='8'<?php if($row2['eday'] == '8') echo " selected"; ?>>8</option>
	<option value='9'<?php if($row2['eday'] == '9') echo " selected"; ?>>9</option>
	<option value='10'<?php if($row2['eday'] == '10') echo " selected"; ?>>10</option>
	<option value='11'<?php if($row2['eday'] == '11') echo " selected"; ?>>11</option>
	<option value='12'<?php if($row2['eday'] == '12') echo " selected"; ?>>12</option>
	<option value='13'<?php if($row2['eday'] == '13') echo " selected"; ?>>13</option>
	<option value='14'<?php if($row2['eday'] == '14') echo " selected"; ?>>14</option>
	<option value='15'<?php if($row2['eday'] == '15') echo " selected"; ?>>15</option>
	<option value='16'<?php if($row2['eday'] == '16') echo " selected"; ?>>16</option>
	<option value='17'<?php if($row2['eday'] == '17') echo " selected"; ?>>17</option>
	<option value='18'<?php if($row2['eday'] == '18') echo " selected"; ?>>18</option>
	<option value='19'<?php if($row2['eday'] == '19') echo " selected"; ?>>19</option>
	<option value='20'<?php if($row2['eday'] == '20') echo " selected"; ?>>20</option>
	<option value='21'<?php if($row2['eday'] == '21') echo " selected"; ?>>21</option>
	<option value='22'<?php if($row2['eday'] == '22') echo " selected"; ?>>22</option>
	<option value='23'<?php if($row2['eday'] == '23') echo " selected"; ?>>23</option>
	<option value='24'<?php if($row2['eday'] == '24') echo " selected"; ?>>24</option>
	<option value='25'<?php if($row2['eday'] == '25') echo " selected"; ?>>25</option>
	<option value='26'<?php if($row2['eday'] == '26') echo " selected"; ?>>26</option>
	<option value='27'<?php if($row2['eday'] == '27') echo " selected"; ?>>27</option>
	<option value='28'<?php if($row2['eday'] == '28') echo " selected"; ?>>28</option>
	<option value='29'<?php if($row2['eday'] == '29') echo " selected"; ?>>29</option>
	<option value='30'<?php if($row2['eday'] == '30') echo " selected"; ?>>30</option>
	<option value='31'<?php if($row2['eday'] == '31') echo " selected"; ?>>31</option>
</select>
<?php echo date('Y'); ?>
<input type='hidden' name='eyear' value='<?php echo date('Y'); ?>'>
</td>
</tr>
<tr>
<td>
</td>
<td>
<input type='submit' name='submit' value='Edit'>
</td>
</tr>
</table>

</form>

</div>

<?php include ("includes/footer.php"); ?>