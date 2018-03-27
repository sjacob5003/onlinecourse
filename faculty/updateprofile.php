<?php
session_start();
require_once('../includes/config.php');
$formtype=$_POST['formtype'];
$facultyid=$_SESSION['userid'];
switch ($formtype)
{
	case 'personal':
		$facultyname=$_POST['facultyname'];
		$facultyemail=$_POST['facultyemail'];
		$facultyphone=$_POST['facultyphone'];
		$facultydob=$_POST['facultydob'];
		$facultystreet1=$_POST['facultystreet1'];
		$facultystreet2=$_POST['facultystreet2'];
		$facultycity=$_POST['facultycity'];
		$facultystate=$_POST['facultystate'];
		$facultypincode=$_POST['facultypincode'];
		mysqli_query($con,"UPDATE facultytable SET FacultyName='$facultyname', FacultyEmail='$facultyemail', FacultyPhone='$facultyphone', FacultyDOB='$facultydob', FacultyStreet1='$facultystreet1', FacultyStreet2='$facultystreet2', FacultyCity='$facultycity', FacultyState='$facultystate', FacultyPincode='$facultypincode', FacultyUpdationDate=CURTIME() WHERE FacultyId='$facultyid'");
		break;
	case 'educational':
		$degreename=$_POST['degreename'];
		$universityname=$_POST['universityname'];
		$passingyear=$_POST['passingyear'];
		$row=mysqli_query($con, "SELECT * FROM facultyeducationaltable WHERE FacultyId='$facultyid' AND FacultyDegreeName='$degreename' AND FacultyCollegeName='$universityname' AND FacultyPassingYear='$passingyear'");
		if (mysqli_num_rows($row)>0)
			echo "Data Already Exists";
		else
		{
			if(mysqli_query($con, "INSERT INTO facultyeducationaltable (FacultyId, FacultyDegreeName, FacultyCollegeName, FacultyPassingYear) VALUES ('$facultyid', '$degreename', '$universityname','$passingyear')"))
				echo "Data Added";
			else
				echo "Data could not be added";
		}		
		break;
	default: echo "Fuck off";		
		break;
}
?>