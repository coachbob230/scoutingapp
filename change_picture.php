<?php
$team=$_POST['team'];
$event=$_POST['event'];
$robotpic=$_FILES["robotpic"]["name"];
$allowedExts = array("gif", "jpeg", "jpg", "png", "JPG");
$temp = explode(".", $_FILES["robotpic"]["name"]);
$extension = end($temp);
if ((($_FILES["robotpic"]["type"] == "image/gif")
|| ($_FILES["robotpic"]["type"] == "image/jpeg")
|| ($_FILES["robotpic"]["type"] == "image/jpg")
|| ($_FILES["robotpic"]["type"] == "image/pjpeg")
|| ($_FILES["robotpic"]["type"] == "image/x-png")
|| ($_FILES["robotpic"]["type"] == "image/png"))
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["robotpic"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["robotpic"]["error"] . "<br>";
    }
  else
    {
    if (file_exists("pictures/" . $_FILES["robotpic"]["name"]))
      {
      echo $_FILES["robotpic"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["robotpic"]["tmp_name"],
      "pictures/" . $_FILES["robotpic"]["name"]);
      }
    }
  }
else
  {
  echo "Invalid file";
  echo "<br/>" . $_FILES["robotpic"]["type"] . "<br/>";
  }
	$conn = mysqli_connect('localhost', 'scouter', 'Ga3lh4wks', 'scouting');
	$sql = "UPDATE teams SET robot_picture = '$robotpic' WHERE teamnumber='$team'";
	if ($conn->query($sql) === TRUE) {
		echo "Data updated successfully\n";
	} else {
		echo "Error updating data: " . $conn->error . "\n" . $sql . "\n";
	}
	//header("Location: team.php?team=" . $team . "&event=" . $event);
  ?>