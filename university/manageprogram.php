<?php
session_start();
require_once('../includes/config.php');
$progname = $_POST['progname'];
$progabbr = $_POST['progabbr'];
$sql = mysqli_query($con, "SELECT * FROM programtable WHERE ProgramName = '$progname' AND AbbreviatedProgName = '$progabbr'");
if( !mysqli_fetch_array($sql) )
{
    if(mysqli_query($con,"INSERT INTO programtable (ProgramName, AbbreviatedProgName) VALUES ('$progname', '$progabbr')"))
        echo "Thank you for your feedback";
    else
        echo "Could not submit your feedback. Please try again";
}
?> 