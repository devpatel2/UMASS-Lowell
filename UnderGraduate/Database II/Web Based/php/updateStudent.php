<!DOCTYPE html>
<html>
<body>

<?php
$db_connection = mysqli_connect("localhost", "root", "" , "database_phase_2");

if (!$db_connection) {
  die("Connection failed: " . mysqli_connect_error());
}

$USID = $_POST["USID"];
$sname = $_POST["sname"];
$SIID = $_POST["SIID"];
$smajor = $_POST["smajor"];
$sdh = $_POST["sdh"];
$scareer = $_POST["scareer"];

if($USID == NULL) {
    echo "<br><strong>Failed to input which student to update!</strong>";
} else {
    if($sname != NULL && $SIID == NULL && $smajor == NULL
       && $sdh == NULL && $scareer == NULL) {
        $query = "UPDATE students SET name = '$sname' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));  
        echo "<br>Update Successful!";
    }
    elseif($sname == NULL && $SIID != NULL && $smajor == NULL
       && $sdh == NULL && $scareer == NULL) {
        $query = "UPDATE students SET IID = $SIID WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname == NULL && $SIID == NULL && $smajor != NULL
       && $sdh == NULL && $scareer == NULL) {
        $query = "UPDATE students SET major = '$smajor' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));  
        echo "<br>Update Successful!";
    }
    elseif($sname == NULL && $SIID == NULL && $smajor == NULL
       && $sdh != NULL && $scareer == NULL) {
        $query = "UPDATE students SET degreeHeld = '$sdh' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname == NULL && $SIID == NULL && $smajor == NULL
       && $sdh == NULL && $scareer != NULL) {
        $query = "UPDATE students SET career = '$scareer' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname != NULL && $SIID != NULL && $smajor == NULL
       && $sdh == NULL && $scareer == NULL) {
        $query = "UPDATE students SET name = '$sname', IID = $SIID WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname != NULL && $SIID == NULL && $smajor != NULL
       && $sdh == NULL && $scareer == NULL) {
        $query = "UPDATE students SET name = '$sname', major = '$smajor' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname != NULL && $SIID == NULL && $smajor == NULL
       && $sdh != NULL && $scareer == NULL) {
        $query = "UPDATE students SET name = '$sname', degreeHeld = '$sdh' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname != NULL && $SIID == NULL && $smajor == NULL
       && $sdh == NULL && $scareer != NULL) {
        $query = "UPDATE students SET name = '$sname', career = '$scareer' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname == NULL && $SIID != NULL && $smajor != NULL
       && $sdh == NULL && $scareer == NULL) {
        $query = "UPDATE students SET IID = $SIID, major = '$smajor' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname == NULL && $SIID != NULL && $smajor == NULL
       && $sdh != NULL && $scareer == NULL) {
        $query = "UPDATE students SET IID = $SIID, degreeHeld = '$sdh' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname == NULL && $SIID != NULL && $smajor == NULL
       && $sdh == NULL && $scareer != NULL) {
        $query = "UPDATE students SET IID = $SIID, career = '$scareer' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname == NULL && $SIID == NULL && $smajor != NULL
       && $sdh != NULL && $scareer == NULL) {
        $query = "UPDATE students SET major = '$smajor', degreeHeld = '$sdh' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname == NULL && $SIID == NULL && $smajor != NULL
       && $sdh == NULL && $scareer != NULL) {
        $query = "UPDATE students SET major = '$smajor', career = '$scareer' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname == NULL && $SIID == NULL && $smajor == NULL
       && $sdh != NULL && $scareer != NULL) {
        $query = "UPDATE students SET degreeHeld = '$sdh', career = '$scareer' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname != NULL && $SIID != NULL && $smajor != NULL
       && $sdh == NULL && $scareer == NULL) {
        $query = "UPDATE students SET name = '$sname', IID = $SIID, major = '$smajor' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname != NULL && $SIID != NULL && $smajor == NULL
       && $sdh != NULL && $scareer == NULL) {
        $query = "UPDATE students SET name = '$sname', IID = $SIID, degreeHeld = '$sdh' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname != NULL && $SIID != NULL && $smajor == NULL
       && $sdh == NULL && $scareer != NULL) {
        $query = "UPDATE students SET name = '$sname', IID = $SIID, career = '$scareer' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname != NULL && $SIID == NULL && $smajor != NULL
       && $sdh != NULL && $scareer == NULL) {
        $query = "UPDATE students SET name = '$sname', major = '$smajor', degreeHeld = '$sdh' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname != NULL && $SIID == NULL && $smajor != NULL
       && $sdh == NULL && $scareer != NULL) {
        $query = "UPDATE students SET name = '$sname', major = '$smajor', career = '$scareer' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname != NULL && $SIID == NULL && $smajor == NULL
       && $sdh != NULL && $scareer != NULL) {
        $query = "UPDATE students SET name = '$sname', degreeHeld = '$sdh', career = '$scareer' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname == NULL && $SIID != NULL && $smajor != NULL
       && $sdh != NULL && $scareer == NULL) {
        $query = "UPDATE students SET IID = $SIID, major = '$smajor', degreeHeld = '$sdh' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname == NULL && $SIID != NULL && $smajor != NULL
       && $sdh == NULL && $scareer != NULL) {
        $query = "UPDATE students SET IID = $SIID, major = '$smajor', career = '$scareer' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname == NULL && $SIID != NULL && $smajor == NULL
       && $sdh != NULL && $scareer != NULL) {
        $query = "UPDATE students SET IID = $SIID, degreeHeld = '$sdh', career = '$scareer' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname == NULL && $SIID == NULL && $smajor != NULL
       && $sdh != NULL && $scareer != NULL) {
        $query = "UPDATE students SET major = '$smajor', degreeHeld = '$sdh', career = '$scareer' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname != NULL && $SIID != NULL && $smajor != NULL
       && $sdh != NULL && $scareer == NULL) {
        $query = "UPDATE students SET name = '$sname', IID = $SIID, major = '$smajor', degreeHeld = '$sdh' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname != NULL && $SIID != NULL && $smajor != NULL
       && $sdh == NULL && $scareer != NULL) {
        $query = "UPDATE students SET name = '$sname', IID = $SIID, major = '$smajor', career = '$scareer' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname == NULL && $SIID != NULL && $smajor != NULL
       && $sdh != NULL && $scareer != NULL) {
        $query = "UPDATE students SET IID = $SIID, major = '$smajor', degreeHeld = '$sdh', career = '$scareer' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    elseif($sname != NULL && $SIID != NULL && $smajor != NULL
       && $sdh != NULL && $scareer != NULL) {
        $query = "UPDATE students SET name = '$sname', IID = $SIID, major = '$smajor', degreeHeld = '$sdh', career = '$scareer' WHERE SID = $USID";
        $result = mysqli_query($db_connection, $query) or die ("Query failed: " . mysqli_error($db_connection));
        echo "<br>Update Successful!";
    }
    else {
        echo "<br><strong>Failed to process update for student $USID</strong>";
    }
} 

mysqli_close($db_connection);
?>

<br><br>
<input type=button onclick="location.href='updateStudent.html'" value="Update Another Student">
<input type=button onclick="location.href='home.html'" value="Main Menu">

</body>
</html> 