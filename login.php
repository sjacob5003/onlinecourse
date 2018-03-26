<?php
session_start();
error_reporting(0);
include("includes/config.php");
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if(isset($_POST['submit']))
{
    $usertype=$_POST['usertype'];
    $email=$_POST['email'];
    $email=filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $_SESSION['errmsg']="Invalid Email";
        header("Location:http://$host$uri/studentlogin.php");
        exit();
    }
    else
    {
        $password=$_POST['password'];
        if($usertype=="Student")
        {
            $query=mysqli_query($con, "SELECT * FROM studenttable WHERE StudentEmail='$email' AND StudentPassword='$password'");
            $num=mysqli_fetch_array($query);
            if($num>0)
            {
                $_SESSION['email']=$email;
                $_SESSION['userid']=$num['StudentId'];
                $_SESSION['username']=$num['StudentName'];
                $_SESSION['usertype']="Student";
                header("Location:http://$host$uri/index.php");
                exit();
            }
            else
            {
                $_SESSION['errmsg']="Invalid Email/Password Combination";
                header("Location:http://$host$uri/login.php");
                exit();
            }
        }
        elseif($usertype=="Faculty")
        {
            $query=mysqli_query($con, "SELECT * FROM facultytable WHERE FacultyEmail='$email' AND FacultyPassword='$password'");
            $num=mysqli_fetch_array($query);
            if($num>0)
            {
                $_SESSION['email']=$email;
                $_SESSION['userid']=$num['FacultyId'];
                $_SESSION['username']=$num['FacultyName'];
                $_SESSION['usertype']="Faculty";
                header("Location:http://$host$uri/index.php");
                exit();
            }
            else
            {
                $_SESSION['errmsg']="Invalid Email/Password Combination";
                header("Location:http://$host$uri/login.php");
                exit();
            }
        }
        elseif($usertype=="Admin")
        {
            $query=mysqli_query($con, "SELECT * FROM admintable WHERE AdminEmail='$email' AND AdminPassword='$password'");
            $num=mysqli_fetch_array($query);
            if($num>0)
            {
                $_SESSION['email']=$email;
                $_SESSION['userid']=$num['AdminId'];
                $_SESSION['username']=$num['AdminName'];
                $_SESSION['usertype']="Admin";
                header("Location:http://$host$uri/index.php");
                exit();
            }
            else
            {
                $_SESSION['errmsg']="Invalid Email/Password Combination";
                header("Location:http://$host$uri/login.php");
                exit();
            }
        }
        elseif($usertype=="University")
        {
            $query=mysqli_query($con, "SELECT * FROM universitytable WHERE UniversityEmail='$email' AND UniversityPassword='$password'");
            $num=mysqli_fetch_array($query);
            if($num>0)
            {
                $_SESSION['email']=$email;
                $_SESSION['userid']=$num['UniversityId'];
                $_SESSION['username']=$num['UniversityName'];
                $_SESSION['usertype']="University";
                header("Location:http://$host$uri/index.php");
                exit();
            }
            else
            {
                $_SESSION['errmsg']="Invalid Email/Password Combination";
                header("Location:http://$host$uri/login.php");
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
    <title>Login</title>
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
                    <center><h4 class="page-head-line"><span class="glyphicon glyphicon-log-in"></span> &nbsp;Login To Enter </h4></center>
                </div>
            </div>
             <span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
            <form name="admin" method="post">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                          <div class="form-group">
                          <label>Email</label>
                                    <input id="email" type="text" class="form-control" name="email" placeholder="Email">
                          </div>

                              <div class="form-group">
                               <label>Password</label>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                          </div>

                          <div class="form-group">
                           <label>Login type</label>
                               <select class="selectpicker" name="usertype" data-style="btn" data-width="100%" data-border="1px" title="Choose Your Login Type" required>
                                         <option value="Student">Student</option>
                                         <option value="Faculty">Faculty</option>
                                         <option value="University">University</option>
                                         <option value="Admin">Admin</option>
                              </select>
                           </div>

                     <br>
                     <button type="submit" name="submit" class="btn btn-primary" style="width:100%"><span class="glyphicon glyphicon-log-in"></span> &nbsp;Log In </button>&nbsp;

                        <p style="text-align:center;color:grey;font-size:130%">New here? <a href="signup.php"> <u>Register now</u> </a></p>
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
