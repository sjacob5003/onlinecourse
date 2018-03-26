<?php
session_start();
include('includes/config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if(isset($_POST['submit']))
{
    $name=ucwords(strtolower($_POST['name']));
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $pass=$_POST['password'];
    $pass1=$_POST['confirmpassword'];
    $usertype=$_POST['usertype'];
    $email=filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $_SESSION['errmsg']="Please enter a valid Email ID";
        header("Location:http://$host$uri/signup.php");
        exit();
    }
    elseif($pass!=$pass1)
    {
        $_SESSION['errmsg']="Passwords do not match";
        header("Location:http://$host$uri/signup.php");
        exit();
    }
    elseif($usertype=="Student")
    {
        $result=mysqli_query($con, "SELECT * FROM studenttable WHERE StudentEmail='$email'");
        if ($result->num_rows > 0)
        {
            $_SESSION['errmsg']="This email ID is already in use";
            header("Location:http://$host$uri/signup.php");
            exit();
        }
        else
        {
            $token="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            $token=str_shuffle($token);
            $token=substr($token, 0, 10);
            if(mysqli_query($con, "INSERT INTO studenttable (StudentName,StudentEmail,StudentPassword,StudentPhone, StudentTokenString) VALUES ('$name','$email','$pass','$phone','$token')"))
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
                    $mail->addAddress($email,'CourseManagement@NUV');     // Add a recipient
                    $mail->addReplyTo('no-reply@confirmation.com');

                     //Content
                     $mail->isHTML(true);                                  // Set email format to HTML
                     $mail->Subject = 'Email Verification';
                     $mail->Body    = 'Please click on the link below to verify email<BR><BR>
                                        <a href="http://'.$host.''.$uri.'/emailverify.php?email='.$email.'&token='.$token.'">Click Here</a>';
                    if($mail->send())
                        echo "Check email for activation";
                    else
                        echo "Not s ent";
                }
                catch (Exception $e)
                {
                    echo $e->getMessage();
                }
                // header("Location:http://$host$uri/emailverify.php");
                // exit();
            }
            else
            {
                $_SESSION['errmsg']="Unable to register";
                header("Location:http://$host$uri/signup.php");
                exit();
            }
        }
    }
    elseif($usertype=="Faculty")
    {
        $result=mysqli_query($con, "SELECT * FROM facultytable WHERE FacultyEmail='$email'");
        if ($result->num_rows > 0)
        {
            $_SESSION['errmsg']="This email ID is already in use";
            header("Location:http://$host$uri/signup.php");
            exit();
        }
        else
        {
            if(mysqli_query($con, "INSERT INTO facultytable (FacultyName,FacultyEmail,FacultyPassword,FacultyPhone) VALUES ('$name','$email','$pass','$phone')"))
            {
                header("Location:http://$host$uri/index.php");
                exit();
            }
            else
            {
                $_SESSION['errmsg']="Unable to register";
                header("Location:http://$host$uri/signup.php");
                exit();
            }
        }
    }
    elseif($usertype=="University")
    {
        $result=mysqli_query($con, "SELECT * FROM universitytable WHERE UniversityEmail='$email'");
        if ($result->num_rows > 0)
        {
            $_SESSION['errmsg']="This email ID is already in use";
            header("Location:http://$host$uri/signup.php");
            exit();
        }
        else
        {
            $token="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            $token=str_shuffle($token);
            $token=substr($token, 0, 10);
            if(mysqli_query($con, "INSERT INTO universitytable (UniversityName,UniversityEmail,UniversityPassword,UniversityPhone) VALUES ('$name','$email','$pass','$phone')"))
            {
                header("Location:http://$host$uri/index.php");
                exit();
            }
            else
            {
                $_SESSION['errmsg']="Unable to register";
                header("Location:http://$host$uri/signup.php");
                exit();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Signup</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <?php include('includes/header.php');?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <center><h4 class="page-head-line"><span class="glyphicon glyphicon-envelope"></span> &nbsp;Registration Form </h4></center>
                </div>
            </div>
             <span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
            <form name="signup" method="post">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">

        	   <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <input id="name" type="text" class="form-control" name="name" placeholder="Full Name" required>
                </div>
                <br>
              <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="email" type="text" class="form-control" name="email" placeholder="Email" required>
              </div>

<br>

		      <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                <input id="phone" type="text" class="form-control" name="phone" maxlength=10 placeholder="Mobile Number" required>
            </div>

<br>

                          <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                          </div>

<br>

						  <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="confirmpassword" type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required>
                          </div>

<br>

                          <div class="input-group">
                         <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                               <select class="selectpicker" name="usertype" data-style="btn" data-width="100%" data-border="1px" title="Choose Your Registration Type">
                                         <option value="Student">Student</option>
                                         <option value="Faculty">Faculty</option>
                                         <option value="University">University</option>
                              </select>
                           </div>
<br>
                    <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-ok"></span> &nbsp;Submit </button>&nbsp;
		<button type="reset" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-remove"></span> &nbsp;Reset </button>&nbsp;

                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
</body>
</html>
