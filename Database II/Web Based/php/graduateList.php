<!DOCTYPE html>
<html>
<body>
  
<h1>Student List to See Who is Able to Graduate</h1>

<strong><label style="float:left; width:88px">&nbsp;&nbsp;&nbsp;&nbsp;SID</label></strong>
<strong><label style="float:left; width:88px">Yes/No</label></strong><br><br>

<?php
$db_connection = mysqli_connect("localhost", "root", "" , "database_phase_2");

if (!$db_connection) {
  die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT SID FROM students";
$result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc ($result)) {
    $gsid = $row["SID"];
    $belowB = 0;
    $totalCredits = 0;
    $gradePoints = 0.0;
    $gpa = 0.0;
    $group1 = 0;
    $group2 = 0;
    $group3 = 0;
    $group4 = 0;
    $algorithmsTaken = false;

    $query1 = "SELECT * FROM enrollment WHERE SID = $gsid";
    $result1 = mysqli_query($db_connection, $query1) or die ("Query failed: " . mysqli_error($db_connection));
  
    if (mysqli_num_rows($result1) > 0) {
      while ($row1 = mysqli_fetch_assoc ($result1)) {
        $grade = $row1["grade"];
        $cid = $row1["CID"];
        if ($grade != "B" && $grade != "B+" && $grade != "A-" && $grade != "A") {
          $belowB++;
        }
        
        $query2 = "SELECT * FROM courses WHERE CID = $cid";
        $result2 = mysqli_query($db_connection, $query2) or die ("Query failed: " . mysqli_error($db_connection));
        while ($row2 = mysqli_fetch_assoc ($result2)) {
          $credit = $row2["credits"];
          
          if ($row2["groupID"] == 1)
            $group1++;
          elseif ($row2["groupID"] == 2)
            $group2++;
          elseif ($row2["groupID"] == 3)
            $group3++;
          elseif ($row2["groupID"] == 4)
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
    }
    
    $cond = array();
    $i = 0;
    $query3 = "SELECT * FROM conditions WHERE SID = $gsid";
    $result3 = mysqli_query($db_connection, $query3) or die ("Query failed: " . mysqli_error($db_connection));
    
    if (mysqli_num_rows($result3) > 0) {
      while ($row3 = mysqli_fetch_assoc ($result3)) {
        $cCID = $row3["CID"];
        
        $query4 = "SELECT * FROM enrollment WHERE SID = $gsid";
        $result4 = mysqli_query($db_connection, $query4) or die ("Query failed: " . mysqli_error($db_connection));
        
        if (mysqli_num_rows($result4) > 0) {
          $cond[$i] = false;
          while ($row4 = mysqli_fetch_assoc ($result4)) {
            if ($cCID == $row4["CID"])
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
    
    if (mysqli_num_rows($result1) > 0)
      $gpa = $gradePoints / $totalCredits;
    
    if ($belowB <= 2 && $group1 >= 0 && $group2 > 0 && $group3 > 0 && $group4 > 0 && $algorithmsTaken == true
        && $totalCredits >= 30 && $gpa >= 3.0 && $meet_cond == true) {
      echo "$gsid ";
      echo str_repeat('&nbsp;', 10);
      echo "<strong>Yes</strong><br>";
    } else {
      echo "$gsid ";
      echo str_repeat('&nbsp;', 10);
      echo "No<br>";
    }
  }
}

mysqli_close($db_connection);
?>

<br>
<input type=button onclick="location.href='home.html'" value="Main Menu">

</body>
</html> 