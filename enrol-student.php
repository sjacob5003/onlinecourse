<?php
require_once('includes/config.php');
$con = mysqli_connect("localhost","root","","coursemanagement") or die ("could not connect database");
$studentid=$_POST['studentid'];
$courseid=$_POST['courseid'];
$query=mysqli_query($con, "SELECT * FROM courseenrolmenttable WHERE CourseId='$courseid' AND studentid='$studentid'");
$row=mysqli_fetch_array($query);
if($row>0)
{
	// $error="You have already been enroled";
	echo "You have already been enroled";
}	
else
{
	if(mysqli_query($con,"INSERT INTO courseenrolmenttable (CourseId, StudentId, Marks) VALUES ('$courseid', '$studentid', NULL);"))
	{
		// $res="Enrolment Successful";
  		echo "Enrolment Successful";
	}
	else
	{
		// $error="Could Not Insert";
		echo "Could Not Insert";
	}	

}

?>