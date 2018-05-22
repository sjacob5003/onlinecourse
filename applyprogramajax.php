<?php
session_start();
require_once('includes/config.php');
$progid = $_POST['programid'];
$universityid = $_POST['universityid'];
$reqtype = $_POST['reqtype'];
$studentid = $_SESSION['userid'];
if ($reqtype == 1)
{
    $sql = mysqli_query($con, "SELECT CourseId FROM courseenrolmenttable JOIN coursedurationtable ON coursedurationtable.DurationId = courseenrolmenttable.CourseDurationId WHERE courseenrolmenttable.StudentId='$studentid' AND Marks>=40");
    $arr1=array();
    while ($row = mysqli_fetch_array($sql))
        $arr1[] = $row['CourseId'];
    $sql = mysqli_query($con, "SELECT CourseId FROM programofferedtable WHERE programofferedtable.ProgramId = '$progid' AND programofferedtable.UniversityId = '$universityid'");
    $arr2=array();
    while ($row = mysqli_fetch_array($sql))
        $arr2[] = $row['CourseId'];
    if( array_diff($arr2, $arr1) == [])
        echo 'yes';
    else
        echo 'no';
}
elseif ($reqtype == 2)
{
    $sql = mysqli_query($con, "SELECT programtable.ProgramId, programtable.ProgramName, programtable.AbbreviatedProgName, universitytable.UniversityId, universitytable.UniversityName, universitytable.UniversityEmail FROM programofferedtable LEFT JOIN programtable ON programofferedtable.ProgramId = programtable.ProgramId JOIN universitytable ON universitytable.UniversityId = programofferedtable.UniversityId WHERE universitytable.UniversityId = '$universityid' AND programtable.ProgramId = '$progid' GROUP BY programtable.ProgramId");
    while ($row = mysqli_fetch_array($sql))
    {
        try
        {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 0; //SMTP Debug
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = 'donotreplytothis02@gmail.com';
            $mail->Password = 'dummyaccount1';
            $mail->SMTPSecure = 'tls';
            $mail->Port = '587';
            /**
             * SMTPOptions work-around by @author : Synchro
             * This setting should removed on server and
             * mailing should be working on the server
             */
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            //Recipients
            $mail->setFrom('no-reply@confirmation.com', 'Do Not Reply');
            $mail->addAddress($row['UniversityEmail'],'The Open School');     // Add a recipient
            $mail->addReplyTo('no-reply@confirmation.com');

            //Content
            $mail->isHTML(true);                    // Set email format to HTML
            $mail->Subject = 'Application For Degree';
            $mail->Body    = 'To '.$row['UniversityName'].'<br><br>
                                This student';
            if($mail->send())
                echo "Check email for activation";
            else
                echo "Not sent";
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
}
?>