<?php

$game = $_POST['game'];
$year = $_POST['year'];
$gamelogo=$_FILES["gamelogo"]["name"];
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["gamelogo"]["name"]);
$extension = end($temp);
if ((($_FILES["gamelogo"]["type"] == "image/gif")
|| ($_FILES["gamelogo"]["type"] == "image/jpeg")
|| ($_FILES["gamelogo"]["type"] == "image/jpg")
|| ($_FILES["gamelogo"]["type"] == "image/pjpeg")
|| ($_FILES["gamelogo"]["type"] == "image/x-png")
|| ($_FILES["gamelogo"]["type"] == "image/png"))
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["gamelogo"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["gamelogo"]["error"] . "<br>";
    }
  else
    {
    if (file_exists("pictures/" . $_FILES["gamelogo"]["name"]))
      {
      echo $_FILES["gamelogo"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["gamelogo"]["tmp_name"],
      "pictures/" . $_FILES["gamelogo"]["name"]);
      }
    }
  }
else
  {
  echo "Invalid file";
  }

$conn = new mysqli('localhost', 'scouter', 'Ga3lh4wks', 'scouting');

if($conn->query("UPDATE games SET year='$year' WHERE game='$game'") === TRUE) {
	echo "Successfully inserted data!";
}
else {
	echo "Could not insert data into table: " . $conn->error;
}
if($gamelogo != '') {
	if($conn->query("UPDATE games SET gamelogo='$gamelogo' WHERE game='$game'") === TRUE) {
		echo "Successfully inserted data!";
	}
	else {
		echo "Could not insert data into table: " . $conn->error;
	}
}
header("Location:admin.php");