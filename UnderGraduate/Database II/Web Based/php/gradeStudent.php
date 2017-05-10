<!DOCTYPE html>
<html>
<body>

<?php
$db_connection = mysqli_connect("localhost", "root", "" , "database_phase_2");

if (!$db_connection) {
  die("Connection failed: " . mysqli_connect_error());
}

$eSID = $_POST["eSID"];
$eCID = $_POST["eCID"];
$eSec = $_POST["eSec"];
$eYear = $_POST["eYear"];
$eSem = $_POST["eSem"];
$eGrade = $_POST["eGrade"];

if($eSID == NULL || $eCID == NULL || $eSec == NULL || $eYear == NULL || $eSem == NULL || $eGrade == NULL) {
  echo "<br><strong>Failed to input information correctly!</strong>";
} else {
  $query = "INSERT INTO enrollment VALUES ($eSID, $eCID, $eSec, $eYear, '$eSem', '$eGrade')";
  $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
   
  echo "<br>Grade Submitted!";
}

mysqli_close($db_connection);
?>

<br><br>
<input type=button onclick="location.href='gradeStudent.html'" value="Grade Another Student">
<input type=button onclick="location.href='home.html'" value="Main Menu">

</body>
</html> 