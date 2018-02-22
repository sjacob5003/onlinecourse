<?php
session_start();
error_reporting(0);
include("includes/config.php");
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if(isset($_POST['submit']))
{
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
        $query=mysqli_query($con, "SELECT * FROM studenttable WHERE StudentEmail='$email' AND StudentPassword='$password'");
        $num=mysqli_fetch_array($query);
        if($num>0)
        {
            $_SESSION['email']=$email;
            $_SESSION['userid']=$num['StudentId'];
            $_SESSION['username']=$num['StudentName'];
            $_SESSION['usertype']="Student";
            $uip=$_SERVER['REMOTE_ADDR'];
            header("Location:http://$host$uri/change-password.php");
            exit();
        }
        else
        {
            $_SESSION['errmsg']="Invalid Email/Password Combination";
            header("Location:http://$host$uri/studentlogin.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Student Login</title>
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
                    <center><h4 class="page-head-line"><span class="glyphicon glyphicon-user"></span> &nbsp;Registration Form </h4></center>
                </div>
            </div>
             <span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
            <form name="admin" method="post">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">

		      <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                    <input id="email" type="text" class="form-control" name="email" placeholder="Full Name">
                          </div>

<br>

                          <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input id="email" type="text" class="form-control" name="email" placeholder="Email">
                          </div>

<br>

		      <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                    <input id="email" type="text" class="form-control" name="email" placeholder="Mobile Number">
                          </div>

<br>

                          <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                          </div>

<br>

						  <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Confirm Password">
                          </div>

<br>

                          <div class="input-group">
                         <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                               <select class="selectpicker" data-style="btn" data-width="100%" data-border="1px" title="Choose Your Registration Type">
                                         <option>Student</option>
                                         <option>Faculty</option>
                                         <option>University</option>
                              </select>
                           </div>

                     <br>
                     <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> &nbsp;Register </button>&nbsp;

                        <p style="text-align:center;color:grey;font-size:130%">Already registered? <a href="login.php"> <u>Log back in</u> </a></p>
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
