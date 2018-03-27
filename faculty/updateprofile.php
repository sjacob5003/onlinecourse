<?php
session_start();
require_once('../includes/config.php');
$formtype=$_POST['formtype'];
switch ($formtype)
{
	case 'personal':
		$facultyid = $_POST['facultyid'];
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

		break;
	default: echo "Fuck off";		
		break;
}
?>