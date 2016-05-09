<!DOCTYPE html>
<html>
<body>

<?php
$db_connection = mysqli_connect("localhost", "root", "" , "database_phase_2");

if (!$db_connection) {
  die("Connection failed: " . mysqli_connect_error());
}

$SSID = $_POST["SSID"];
$sname = $_POST["sname"];
$SIID = $_POST["SIID"];
$smajor = $_POST["smajor"];
$sdh = $_POST["sdh"];
$scareer = $_POST["scareer"];

if($SSID == NULL || $sname == NULL || $SIID == NULL || $smajor == NULL || $sdh == NULL || $scareer == NULL) {
  echo "<br><strong>Failed to input information correctly!</strong>";
} else {
  $query = "INSERT INTO students VALUES ($SSID, '$sname', $SIID, '$smajor', '$sdh', '$scareer')";
  $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
   
  echo "<br>New Record Created Successfully!";
}

mysqli_close($db_connection);
?>

<br><br>
<input type=button onclick="location.href='addStudent.html'" value="Add Another Student">
<input type=button onclick="location.href='home.html'" value="Main Menu">

</body>
</html> 