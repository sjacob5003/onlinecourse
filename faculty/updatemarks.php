<?php
session_start();
require_once('../includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
$size = count($_POST['studentid']); 

$i = 0; 
while ($i < $size)
{
	$studentid = $_POST['studentid'][$i];
	$marks=$_POST['marks'][$i];

	mysqli_query($con,"UPDATE courseenrolmenttable SET marks='$marks', EnrolmentUpdationTime=CURTIME() WHERE StudentId='$studentid'");
	++$i;
}
?> 