<?php
session_start();
require_once('../includes/config.php');
$courseids = json_decode($_POST['courseids']);
$size = count($courseids); 
$universityid = $_SESSION['userid'];
$programid = $_POST['programid'];
$i = 0;
mysqli_query($con,"DELETE FROM programofferedtable WHERE ProgramId='$programid'");
$queryvals = "";
while ($i < $size)
{
    $courseid = $courseids[$i];
	mysqli_query($con,"INSERT INTO programofferedtable (ProgramId, UniversityId, CourseId) VALUES ('$programid', '$universityid', '$courseid' )" );
	++$i;
}
?>