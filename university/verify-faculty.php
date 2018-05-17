<?php
require_once('../includes/config.php');
$facultyid=$_POST['facultyid'];
$universityid=$_POST['universityid'];
if(mysqli_query($con,"UPDATE facultytable SET FacultyIsActive=1, FacultyVerifiedBy='$universityid', FacultyUpdationDate=curtime() WHERE FacultyId='$facultyid'"))
	echo "Successfuly Verified";
else
	echo "Could Not Verify";
?>
