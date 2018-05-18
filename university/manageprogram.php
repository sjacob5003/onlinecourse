<?php
session_start();
require_once('../includes/config.php');
$size = count($_POST['id']);
$progname = $_POST['progname'];
$progabbr = $_POST['progabbr'];
$universityid = $_SESSION['userid'];
$sql = mysqli_query($con, "SELECT * FROM programtable WHERE ProgramName = '$progname' AND AbbreviatedProgName = '$progabbr'");
if( $row = mysqli_fetch_array($sql) )
    $programid = $row['ProgramId'];
else
{
    if(mysqli_query($con,"INSERT INTO programtable (ProgramName, AbbreviatedProgName) VALUES ('$progname', '$progabbr')"))
        $programid = mysqli_insert_id($con);
    else
        echo "Could not create a program. Please try again";
}
unset($sql);
unset($row);
$i = 0;
while($i < $size)
{
    $courseid = $_POST['id'][$i];
    $sql = mysqli_query($con, "SELECT * FROM programofferedtable WHERE ProgramId = '$programid' AND UniversityId = '$universityid' AND CourseId = '$courseid'");
    if( !mysqli_fetch_array($sql) )
    {
        if(!mysqli_query($con,"INSERT INTO programofferedtable (ProgramId, UniversityId, CourseId) VALUES ('$programid', '$universityid', '$courseid')"))
            echo "Could Not create a program. Please try again!";
    }
    ++$i;
}
?> 