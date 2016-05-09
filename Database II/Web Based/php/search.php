<!DOCTYPE html>
<html>
<body>

<?php
$db_connection = mysqli_connect("localhost", "root", "" , "database_phase_2");

if (!$db_connection) {
  die("Connection failed: " . mysqli_connect_error());
}

$group = $_POST["group"];
$sSID = $_POST["sSID"];
$sName = $_POST["sName"];
$sCID = $_POST["sCID"];
$sSec = $_POST["sSec"];
$sIID = $_POST["sIID"];
$sI_Name = $_POST["sI_Name"];

if ($group == NULL && $sSID != NULL && $sName == NULL && $sCID == NULL && $sIID == NULL && $sI_Name == NULL && $sSec == NULL) {
    echo "<strong>Search results for $sSID</strong>";
    $query = "SELECT * FROM students WHERE SID = $sSID";
    $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
    
    echo "<br><br>";
    
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc ($result)) {
        $sid = $row["SID"];
        $name = $row["name"];
        $iid = $row["IID"];
        $major = $row["major"];
        $degreeHeld = $row["degreeHeld"];
        $career = $row["career"];
        print "$sid $name $iid $major $degreeHeld $career<br>";
      }
    } else {
      echo "0 results<br>";
    }
    mysqli_free_result($result);
}

if ($group == NULL && $sSID == NULL && $sName != NULL && $sCID == NULL && $sIID == NULL && $sI_Name == NULL && $sSec == NULL) {
    echo "<strong>Search results for $sName</strong>";
    $query = "SELECT * FROM students WHERE name = '$sName'";
    $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
    
    echo "<br><br>";
    
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc ($result)) {
        $sid = $row["SID"];
        $name = $row["name"];
        $iid = $row["IID"];
        $major = $row["major"];
        $degreeHeld = $row["degreeHeld"];
        $career = $row["career"];
        print "$name $sid $iid $major $degreeHeld $career<br>";
      }
    } else {
      echo "0 results<br>";
    }
    mysqli_free_result($result);
}

if ($group == NULL && $sSID == NULL && $sName == NULL && $sCID != NULL && $sIID == NULL && $sI_Name == NULL && $sSec == NULL) {
    echo "<strong>Search results for $sCID</strong>";
    $query = "SELECT * FROM courses WHERE CID = '$sCID'";
    $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
    
    echo "<br><br>";
    
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc ($result)) {
        $cid = $row["CID"];
        $name = $row["name"];
        $credits = $row["credits"];
        $groupID = $row["groupID"];
        print "$cid $name $credits $groupID<br>";
      }
    } else {
      echo "0 results<br>";
    }
    mysqli_free_result($result);
}

if ($group == NULL && $sSID == NULL && $sName == NULL && $sCID != NULL && $sIID == NULL && $sI_Name == NULL && $sSec != NULL) {
    if($sCID != NULL && ($sSec == "yes" || $sSec == "Yes")) {
      echo "<strong>Search results for $sCID sections</strong>";
      $query = "SELECT * FROM section WHERE CID = $sCID";
      $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
      
      echo "<br><br>";
      
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc ($result)) {
          $cid = $row["CID"];
          $SecID = $row["SecID"];
          $iid = $row["IID"];
          $yearID = $row["yearID"];
          $semesterID = $row["semesterID"];
          print "$cid $SecID $iid $yearID $semesterID<br>";
        }
      } else {
        echo "0 results<br>";
      }
    }
    mysqli_free_result($result);
}

if ($group == NULL && $sSID == NULL && $sName == NULL && $sCID == NULL && $sIID != NULL && $sI_Name == NULL && $sSec == NULL) {
    echo "<strong>Search results for $sIID</strong>";
    $query = "SELECT * FROM instructors WHERE IID = $sIID";
    $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
    
    echo "<br><br>";
    
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc ($result)) {
        $iid = $row["IID"];
        $name = $row["name"];
        $rank = $row["rank"];
        print "$iid $name $rank<br>";
      }
    } else {
      echo "0 results<br>";
    }
    mysqli_free_result($result);
}

if ($group == NULL && $sSID == NULL && $sName == NULL && $sCID == NULL && $sIID == NULL && $sI_Name != NULL && $sSec == NULL) {
    echo "<strong>Search results for $sI_Name</strong>";
    $query = "SELECT * FROM instructors WHERE name = '$sI_Name'";
    $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
    
    echo "<br><br>";
    
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc ($result)) {
        $iid = $row["IID"];
        $name = $row["name"];
        $rank = $row["rank"];
        print "$name $iid $rank<br>";
      }
    } else {
      echo "0 results<br>";
    }
    mysqli_free_result($result);
}

if ($group != NULL && $sSID == NULL && $sName == NULL && $sCID == NULL && $sIID == NULL && $sI_Name == NULL && $sSec == NULL) {
    if ($group == "Students") {
        echo "<strong>Search results for all Students</strong>";
        $query = "SELECT * FROM students";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        
        echo "<br><br>";
        
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc ($result)) {
            $sid = $row["SID"];
            $name = $row["name"];
            $iid = $row["IID"];
            $major = $row["major"];
            $degreeHeld = $row["degreeHeld"];
            $career = $row["career"];
            print "$sid $name $iid $major $degreeHeld $career<br>";
          }
        } else {
          echo "0 results<br>";
        }
    } elseif ($group == "Instructors") {
        echo "<strong>Search results for all Instructors</strong>";
        $query = "SELECT * FROM instructors";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        
        echo "<br><br>";
      
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc ($result)) {
            $iid = $row["IID"];
            $name = $row["name"];
            $rank = $row["rank"];
            print "$name $iid $rank<br>";
          }
        } else {
          echo "0 results<br>";
        }
    } else {
        echo "<strong>Search results for all Courses</strong>";
        $query = "SELECT * FROM courses";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        
        echo "<br><br>";
        
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc ($result)) {
            $cid = $row["CID"];
            $name = $row["name"];
            $credits = $row["credits"];
            $groupID = $row["groupID"];
            print "$cid $name $credits $groupID<br>";
          }
        } else {
          echo "0 results<br>";
        }
    }
    mysqli_free_result($result);
}

if ($group == NULL && $sSID == NULL && $sName == NULL && $sCID == NULL && $sIID == NULL && $sI_Name == NULL && $sSec == NULL) {
    echo "<br><strong>Failed to input information correctly!</strong><br>";
}

mysqli_close($db_connection);
?>

<br>
<input type=button onclick="location.href='home.html'" value="Main Menu">

</body>
</html>