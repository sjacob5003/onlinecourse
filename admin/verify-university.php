<?php
require_once('../includes/config.php');
$universityid=$_POST['universityid'];
$adminid=$_POST['adminid'];
if(mysqli_query($con,"UPDATE universitytable SET UniversityIsActive=1, UniversityVerifiedBy='$adminid', UniversityUpdationDate=curtime() WHERE UniversityId='$universityid'"))
	echo "Successfuly Verified";
else
	echo "Could Not Verify";
?>