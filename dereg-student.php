<?php
require_once('includes/config.php');
$studentid=$_POST['studentid'];
$durationid=$_POST['durationid'];
if(mysqli_query($con,"DELETE FROM courseenrolmenttable WHERE CourseDurationId='$durationid' AND StudentId='$studentid'"))
	echo "Successfuly Deregistered";
else
	echo "Could Not Deregister";
?>