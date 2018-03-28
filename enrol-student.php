<?php
require_once('includes/config.php');
$studentid=$_POST['studentid'];
$durationid=$_POST['durationid'];
$query=mysqli_query($con, "SELECT * FROM courseenrolmenttable WHERE CourseDurationId='$durationid' AND StudentId='$studentid'");
$row=mysqli_fetch_array($query);
if($row>0)
	echo "You have already been enroled";
else
{
	if(mysqli_query($con,"INSERT INTO courseenrolmenttable (CourseDurationId, StudentId, Marks) VALUES ('$durationid', '$studentid', NULL);"))
  		echo "Enrolment Successful";
	else
		echo "Could Not Insert";
}
?>