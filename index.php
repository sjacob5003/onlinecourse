<?php
session_start();
error_reporting(0);
include("includes/config.php");
if(isset($_POST['submit']))
{
    $regno=$_POST['regno'];
    $regno=filter_var($regno, FILTER_SANITIZE_NUMBER_INT);
    $password=md5($_POST['password']);
    $query=mysqli_query($con, "SELECT * FROM students WHERE StudentRegno='$regno' AND password='$password'");
    $num=mysqli_fetch_array($query);
    if($num>0)
    {
        $_SESSION['login']=$regno;
        $_SESSION['id']=$num['studentRegno'];
        $_SESSION['sname']=$num['studentName'];
        $uip=$_SERVER['REMOTE_ADDR'];
        mysqli_query($con, "INSERT INTO userlog(studentRegno,userip,status) VALUES('$regno','$uip',1)");
        $host=$_SERVER['HTTP_HOST'];
        $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("Location:http://$host$uri/my-profile.php");
        exit();
    }
    else
    {
        $_SESSION['errmsg']="Invalid Reg no or Password";    
        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("Location:http://$host$uri/index.php");
        exit();
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
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <?php include('includes/header.php');?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <center><h4 class="page-head-line">Login To Enter </h4></center>
                </div>
            </div>
             <span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
            <form name="admin" method="post">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                     <label>Enter Reg no : </label>
                        <input type="text" name="regno" class="form-control"  />
                        <label>Enter Password :  </label>
                        <input type="password" name="password" class="form-control"  />
                        <hr />
                        <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> &nbsp;Log Me In </button>&nbsp;
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
</body>
</html>
