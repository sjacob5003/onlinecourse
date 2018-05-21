<?php
require_once('../includes/config.php');
if(isset($_POST['coursename']))
{
    $coursename=$_POST['coursename'];
    $sql = mysqli_query($con,"SELECT * FROM coursetable WHERE CourseName = '$coursename'");
}    
elseif(isset($_POST['coursecode']))
{
    $coursecode = $_POST['coursecode'];
    $sql = mysqli_query($con,"SELECT * FROM coursetable WHERE CourseCode = '$coursecode'");
}
if($row = mysqli_fetch_array($sql) > 0)
    echo 'no';
else
    echo 'yes';
?>
