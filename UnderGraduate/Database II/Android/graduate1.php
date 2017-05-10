<?php
$db_connection = mysqli_connect("localhost", "root", "" , "database_phase_2");

if (!$db_connection) {
  die("Connection failed: " . mysqli_connect_error());
}

$gsid = intval($_GET["gsid"]);
$belowB = 0;
$totalCredits = 0;
$gradePoints = 0.0;
$gpa = 0.0;
$group1 = 0;
$group2 = 0;
$group3 = 0;
$group4 = 0;
$algorithmsTaken = false;
$result = array(NULL);

if($gsid == NULL) {
  $result = array("Failed to input student ID!");
  echo json_encode(array("result"=>$result));
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
    $result = array("Student not found!");
    echo json_encode(array("result"=>$result));
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
      $result = array("Congratuations!", "Student $gsid can graduate!", "$totalCredits Total Credits.", "GPA: $gpa", "Meets group, algorithms, and conditional requirements!");
      echo json_encode(array("result"=>$result));
    } else
      $result = array("Failed to meet graduation requirements.");
      echo json_encode(array("result"=>$result));
  }
}

mysqli_close($db_connection);
?>