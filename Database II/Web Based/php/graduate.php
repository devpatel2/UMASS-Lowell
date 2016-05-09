<!DOCTYPE html>
<html>
<body>

<?php
$db_connection = mysqli_connect("localhost", "root", "" , "database_phase_2");

if (!$db_connection) {
  die("Connection failed: " . mysqli_connect_error());
}

$gsid = $_POST["gsid"];
$belowB = 0;
$totalCredits = 0;
$gradePoints = 0.0;
$gpa = 0.0;
$group1 = 0;
$group2 = 0;
$group3 = 0;
$group4 = 0;
$algorithmsTaken = false;

if($gsid == NULL) {
  echo "<br><strong>Failed to input student ID!</strong>";
} else {
  $query = "SELECT * FROM enrollment WHERE SID = $gsid";
  $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc ($result)) {
      $grade = $row["grade"];
      $cid = $row["CID"];
      if ($grade != "B" && $grade != "B+" && $grade != "A-" && $grade != "A") {
        $belowB++;
      }
      
      $query1 = "SELECT * FROM courses WHERE CID = $cid";
      $result1 = mysqli_query($db_connection, $query1) or die ("Query failed: " . mysqli_error($db_connection));
      while ($row1 = mysqli_fetch_assoc ($result1)) {
        $credit = $row1["credits"];
        
        if ($row1["groupID"] == 1)
          $group1++;
        elseif ($row1["groupID"] == 2)
          $group2++;
        elseif ($row1["groupID"] == 3)
          $group3++;
        elseif ($row1["groupID"] == 4)
          $group4++;
        else { $credit = 0; }
        
        if ($cid == 915030)
          $algorithmsTaken = true;
        
        if ($grade == "A") { $gradePoints = $gradePoints + (4.0 * $credit); }
        elseif ($grade == "A-") { $gradePoints = $gradePoints + (3.7 * $credit); }
        elseif ($grade == "B+") { $gradePoints = $gradePoints + (3.3 * $credit); }
        elseif ($grade == "B") { $gradePoints = $gradePoints + (3.0 * $credit); }
        elseif ($grade == "B-") { $gradePoints = $gradePoints + (2.7 * $credit); }
        elseif ($grade == "C+") { $gradePoints = $gradePoints + (2.3 * $credit); }
        elseif ($grade == "C") { $gradePoints = $gradePoints + (2.0 * $credit); }
        elseif ($grade == "C-") { $gradePoints = $gradePoints + (1.7 * $credit); }
        elseif ($grade == "D+") { $gradePoints = $gradePoints + (1.3 * $credit); }
        elseif ($grade == "D") { $gradePoints = $gradePoints + (1.0 * $credit); }
        elseif ($grade == "D-") { $gradePoints = $gradePoints + (0.7 * $credit); }
        else { $gradePoints = $gradePoints + (0.0 * $credit); }
  
        $totalCredits = $totalCredits + $credit;
      }
    }
  } else {
    echo "<br><strong>Student not found!</strong>";
  }
  
  $cond = array();
  $i = 0;
  $query2 = "SELECT * FROM conditions WHERE SID = $gsid";
  $result2 = mysqli_query($db_connection, $query2) or die ("Query failed: " . mysqli_error($db_connection));
  
  if (mysqli_num_rows($result2) > 0) {
    while ($row2 = mysqli_fetch_assoc ($result2)) {
      $cCID = $row2["CID"];
      
      $query3 = "SELECT * FROM enrollment WHERE SID = $gsid";
      $result3 = mysqli_query($db_connection, $query3) or die ("Query failed: " . mysqli_error($db_connection));
      
      if (mysqli_num_rows($result3) > 0) {
        $cond[$i] = false;
        while ($row3 = mysqli_fetch_assoc ($result3)) {
          if ($cCID == $row3["CID"])
            $cond[$i] = true;
        }
      }
      $i++;
    }
  }
  
  $meet_cond = false;
  $count = 0;
  
  for($i = 0; $i < count($cond); $i++) {
    if ($cond[$i] == true)
      $count++;
  }
  
  if ($count == count($cond))
    $meet_cond = true;
  if (mysqli_num_rows($result) > 0) {
    $gpa = $gradePoints / $totalCredits;
    if ($belowB <= 2 && $group1 >= 0 && $group2 > 0 && $group3 > 0 && $group4 > 0 && $algorithmsTaken == true
      && $totalCredits >= 30 && $gpa >= 3.0 && $meet_cond == true) {
      echo "<br><strong><h3>Congratuations</h3></strong>Student $gsid can graduate!<br>";
      echo "$totalCredits Total Credits.<br>";
      echo "GPA: $gpa";
      echo "<br>Meets group, algorithms, and conditional requirements!";
    } else
      echo "<br>Failed to meet graduation requirements.";
  }
}

mysqli_close($db_connection);
?>

<br><br>
<input type=button onclick="location.href='home.html'" value="Main Menu">

</body>
</html> 