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
		$facultyeducationalid=$_POST['formeduid'];
		$toupdateedu=$_POST['toupdateedu'];
		if($toupdateedu=="1")
		{
			if($row=mysqli_query($con, "UPDATE facultyeducationaltable SET FacultyDegreeName='$degreename', FacultyCollegeName='$universityname', FacultyPassingYear='$passingyear', FacultyEducationalUpdationTime=CURTIME() WHERE FacultyEducationalId='$facultyeducationalid'"))
				echo "Data Updated";
			else
				echo "Data could not be updated";
		}
		else
		{
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
		}				
		break;
	case 'deleteedu':
		$facultyeducationalid=$_POST['facultyeduid'];
		if(mysqli_query($con, "DELETE FROM facultyeducationaltable WHERE FacultyEducationalId='$facultyeducationalid'"))
			echo "Data deleted";
		else
			echo "Data could not be deleted";
		break;
	case 'professional':
		$jobtitle=$_POST['jobtitle'];
		$companyname=$_POST['companyname'];
		$jobstartdate=$_POST['jobstartdate'];
		$jobenddate=$_POST['jobenddate'];
		$facultyprofessionalid=$_POST['formproid'];
		$toupdatepro=$_POST['toupdatepro'];
		if($toupdatepro=="1")
		{
			if($row=mysqli_query($con, "UPDATE facultyprofessionaltable SET FacultyJobTitle='$jobtitle', FacultyCompanyName='$companyname', FacultyStartDate='$jobstartdate', FacultyEndDate='$jobenddate', FacultyProfessionalUpdationTime=CURTIME() WHERE FacultyProfessionalId='$facultyprofessionalid'"))
				echo "Data Updated";
			else
				echo "Data could not be updated";
		}
		else
		{
			$row=mysqli_query($con, "SELECT * FROM facultyprofessionaltable WHERE FacultyId='$facultyid' AND FacultyJobTitle='$jobtitle' AND FacultyCompanyName='$companyname' AND FacultyStartDate='$jobstartdate' AND FacultyEndDate='$jobenddate'");
			if (mysqli_num_rows($row)>0)
				echo "Data Already Exists";
			else
			{
				if(mysqli_query($con, "INSERT INTO facultyprofessionaltable (FacultyId, FacultyJobTitle, FacultyCompanyName, FacultyStartDate, FacultyEndDate) VALUES ('$facultyid', '$jobtitle', '$companyname','$jobstartdate','$jobenddate')"))
					echo "Data Added";
				else
					echo "Data could not be added";
			}
		}				
		break;
	case 'deletepro':
		$facultyprofessionalid=$_POST['facultyproid'];
		if(mysqli_query($con, "DELETE FROM facultyprofessionaltable WHERE FacultyProfessionalId='$facultyprofessionalid'"))
			echo "Data deleted";
		else
			echo "Data could not be deleted";
		break;
	default: echo "Operation Failed";		
		break;
}
?>