<?php
require_once('includes/config.php');
$studentid=$_POST['student_id'];
$courseid=$_POST['course_id'];
$query=mysqli_query($con, "SELECT * FROM courseenrolmenttable WHERE CourseId='$courseid' AND studentid='$studentid'");
$row=mysqli_fetch_array($query);
if($row>0)
{
	$error="You have already been enroled";
	echo json_encode($error);
}	
else
{
	if(mysql_query($con,"INSERT INTO courseenrolmenttable (CourseId, StudentId, Marks) VALUES ('$courseid', '$studentid', NULL)"))
	{
		$res="Enrolment Successful";
  		echo json_encode($res);
	}
	else
	{
		$error="Could Not Insert";
		echo json_encode($error);
	}	

}

?>