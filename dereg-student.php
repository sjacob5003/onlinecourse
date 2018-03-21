<?php
require_once('includes/config.php');
$studentid=$_POST['studentid'];
$courseid=$_POST['courseid'];
if(mysqli_query($con,"DELETE FROM courseenrolmenttable WHERE CourseId='$courseid' AND StudentId='$studentid'"))
{
	// $res="Enrolment Successful";
	echo "Successfuly Deregistered";
}
else
{
	// $error="Could Not Insert";
	echo "Could Not Deregister";
}
?>