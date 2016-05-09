<!DOCTYPE html>
<html>
<body>

<?php
$db_connection = mysqli_connect("localhost", "root", "" , "database_phase_2");

if (!$db_connection) {
  die("Connection failed: " . mysqli_connect_error());
}

$aCID = $_POST["aCID"];
$aName = $_POST["aName"];
$aCredit = $_POST["aCredit"];
$aGroupID = $_POST["aGroupID"];
$aSec = $_POST["aSec"];
$sIID = $_POST["sIID"];
$sSem = $_POST["sSem"];
$sYear = $_POST["sYear"];

if($aCID == NULL || $aName == NULL || $aCredit == NULL || $aGroupID == NULL || $aSec == NULL
   || $sIID == NULL || $sSem == NULL || $sYear == NULL) {
  echo "<br><strong>Failed to input information correctly!</strong>";
} else {
  $query = "INSERT INTO courses VALUES ($aCID, '$aName', $aCredit, $aGroupID)";
  $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
   
  echo "New Course Created Successfully!<br>";
  
  $sec = 201;
  for($i = 0; $i < $aSec; $i++) {
    $query1 = "INSERT INTO section VALUES ($aCID, $sec, $sIID, $sYear, '$sSem')";
    $result1 = mysqli_query($db_connection, $query1) or die ("Query failed: " . mysqli_error($db_connection));
    $sec++;
  }
  
  echo "<br>Sections Created!";
}

mysqli_close($db_connection);
?>

<br><br>
<input type=button onclick="location.href='addCourse.html'" value="Add Another Course">
<input type=button onclick="location.href='home.html'" value="Main Menu">

</body>
</html> 