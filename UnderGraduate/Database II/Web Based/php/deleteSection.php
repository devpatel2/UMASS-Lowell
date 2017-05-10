<!DOCTYPE html>
<html>
<body>

<?php
$db_connection = mysqli_connect("localhost", "root", "" , "database_phase_2");

if (!$db_connection) {
  die("Connection failed: " . mysqli_connect_error());
}

$CID = $_POST["CID"];
$sec = $_POST["sec"];

if($CID) {
  $query = "DELETE FROM section WHERE CID = $CID AND SecID = $sec";
  $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
  
  echo "<br>Removed section $sec of course $CID";
} else {
  echo "<br><strong>Failed to input information correctly!</strong>";
}

mysqli_close($db_connection);
?>

<br><br>
<input type=button onclick="location.href='deleteSection.html'" value="Delete Another Section">
<input type=button onclick="location.href='home.html'" value="Main Menu">

</body>
</html>