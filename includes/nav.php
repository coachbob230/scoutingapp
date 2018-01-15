<div id='navbar'>
<img src='/scouting/pictures/230logo.png' width='20px' style='float: left; padding-top: 8px; padding-right: 10px; '>
<div style='width:50px'></div>
				<div id="menu">
					<a href="index.php"><span>Home</span></a>
					<a href="scouting"><span>Scouting</span></a>
					<a href="interview.php"><span>Interview </span></a>
					<a href="multiscouting.php"><span>Multi Scouting</span></a>
					<a href="search.php"><span>Search</span></a>
					<a href='admin.php'><span>Admin</span></a>
				</div>
	
		<?php
		if($_SESSION['status'] != 'authorized') {
			echo "<form action='' method='POST' style='float: right; padding-right: 20%; padding-top: 8px'>      
			<input type='text' class='inputtext' name='firstname' placeholder='First Name'>
			<input type='text' class='inputtext' name='lastname' placeholder='Last Name'>  
			<input type='submit' value='Sign In'>
			</form> ";
		}
		else echo "<div style='float:right; padding-right: 20%; color:white; padding-top: 10px;'>Signed in as: " . $_SESSION['first_name'] . " " . $_SESSION['last_name'] . " &nbsp;&nbsp;<a href='/scouting/index.php?status=loggedout'>Log Out</a></div>";
		?>


</div>
<div id='buffer'></div>