<?php include ('includes/top.php'); ?>
<?php include ('includes/nav.php'); ?>
<?php include ('includes/header.php'); ?>

<div id='contentmodule'>

<form action='create_db.php' method='POST' name='createDB' onsubmit='return validateForm()' enctype="multipart/form-data">
<table style='text-align: left' align='center'>
<tr>
<td>
Game Name: 
</td>
<td>
<input type='text' name='game'>
</td>
</tr>
<tr>
<td>
Year: 
</td>
<td>
<input type='text' name='year'>
</td>
</tr>
<tr>
<td>
Logo: 
</td>
<td>
<input type='file' name='gamelogo' id='gamelogo'>
</td>
</tr>
</table>
<table style='text-align: left' align='center'>
<tr>
<td>
Game Attribute 1: 
</td>
<td>
<input type='text' name='attribute1'>
</td>
</tr>
<tr>
<td>
Game Attribute 2: 
</td>
<td>
<input type='text' name='attribute2'>
</td>
</tr>
</table>
<input type='hidden' name='num_attributes' value='2'>
<div id='attributes'>
</div>
<table style='text-align: center' align='center'>
<tr>
<td>
<button type='button' onclick='return addAttribute()'>Add Attribute</button>
</td>
</tr>
</table>
<table style='text-align: left' align='center'>
<tr>
<td>
Interview Attribute 1: 
</td>
<td>
<input type='text' name='iattribute1'>
</td>
</tr>
<tr>
<td>
Interview Attribute 2: 
</td>
<td>
<input type='text' name='iattribute2'>
</td>
</tr>
</table>
<input type='hidden' name='num_iattributes' value='2'>
<div id='iattributes'>
</div>
<table style='text-align: center' align='center'>
<tr>
<td>
<button type='button' onclick='return addAttribute2()'>Add Attribute</button>
</td>
</tr>
<tr>
<td>
<input type='submit' value='Create'>
</td>
</tr>
</table>
</form>

</form>


</body>
</html>