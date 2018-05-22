<?php
session_start();
require_once('includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if(strlen($_SESSION['email']) != 0)
{
  if(isset($_POST['submit']))
  {
    $cpass = $_POST['cpass'];
    $cpass = md5($cpass);
    $newpass = $_POST['newpass'];
    $newpass = md5($newpass);
    if($_SESSION['usertype']=="Student")
    {
      $sql=mysqli_query($con, "SELECT StudentPassword FROM studenttable WHERE StudentPassword='$cpass' && StudentEmail='".$_SESSION['email']."'");
      $num=mysqli_fetch_array($sql);
      if($num>0)
      {
        $con=mysqli_query($con, "UPDATE studenttable SET StudentPassword='$newpass', StudentUpdationDate=curtime() WHERE StudentEmail='".$_SESSION['email']."'");
        $_SESSION['msg']="Password Changed Successfully";
      }
      else
        $_SESSION['msg']="Password is Incorrect";
    }
    elseif($_SESSION['usertype']=="Faculty")
    {
      $sql=mysqli_query($con, "SELECT FacultyPassword FROM facultytable WHERE FacultyPassword='$cpass' && FacultyEmail='".$_SESSION['email']."'");
      $num=mysqli_fetch_array($sql);
      if($num>0)
      {
        $con=mysqli_query($con, "UPDATE facultytable SET FacultyPassword='$newpass', FacultyUpdationDate=curtime() WHERE FacultyEmail='".$_SESSION['email']."'");
        $_SESSION['msg']="Password Changed Successfully";
      }
      else
        $_SESSION['msg']="Password is Incorrect";
    }
    elseif($_SESSION['usertype']=="University")
    {
      $sql=mysqli_query($con, "SELECT UniversityPassword FROM universitytable WHERE UniversityPassword='$cpass' && UniversityEmail='".$_SESSION['email']."'");
      $num=mysqli_fetch_array($sql);
      if($num>0)
      {
        $con=mysqli_query($con, "UPDATE universitytable SET UniversityPassword='$newpass', UniversityUpdationDate=curtime() WHERE UniversityEmail='".$_SESSION['email']."'");
        $_SESSION['msg']="Password Changed Successfully";
      }
      else
        $_SESSION['msg']="Password is Incorrect";
    }
    elseif($_SESSION['usertype']=="Admin")
    {
      $sql=mysqli_query($con, "SELECT AdminPassword FROM admintable WHERE AdminPassword='$cpass' && AdminEmail='".$_SESSION['email']."'");
      $num=mysqli_fetch_array($sql);
      if($num>0)
      {
        $con=mysqli_query($con, "UPDATE admintable SET AdminPassword='$newpass', AdminUpdationDate=curtime() WHERE AdminEmail='".$_SESSION['email']."'");
        $_SESSION['msg']="Password Changed Successfully";
      }
      else
        $_SESSION['msg']="Password is Incorrect";
    }
  }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Change Password</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<script type="text/javascript">
function valid()
{
  if(document.chngpwd.cpass.value=="")
  {
    alert("Current Password Field is Empty");
    document.chngpwd.cpass.focus();
    return false;
  }
  else if(document.chngpwd.newpass.value==document.chngpwd.cpass.value)
  {
    alert("Password Fields are The Same!");
    document.chngpwd.newpass.focus();
    return false;
  }
  else if(document.chngpwd.newpass.value=="")
  {
    alert("New Password Field is Empty!");
    document.chngpwd.newpass.focus();
    return false;
  }
  else if(document.chngpwd.cnfpass.value=="")
  {
    alert("Confirm Password Field is Empty!");
    document.chngpwd.cnfpass.focus();
    return false;
  }
  else if(document.chngpwd.newpass.value!= document.chngpwd.cnfpass.value)
  {
    alert("Password and Confirm Password Fields do not match!");
    document.chngpwd.cnfpass.focus();
    return false;
  }
  return true;
}
</script>
<body>
<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
<?php if($_SESSION['email']!="")
{
 include('includes/menubar.php');
}
 ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <center><h1 class="page-head-line">Change Password </h1></center>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="chngpwd" method="post" onSubmit="return valid();">
                         <div class="form-group">
                          <label for="exampleInputPassword1">Current Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" name="cpass" />
                        </div>
                         <div class="form-group">
                          <label for="exampleInputPassword1">New Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword2" name="newpass" />
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Confirm Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword3" name="cnfpass" />
                        </div>

                        <button type="submit" name="submit" style="width:100%" class="btn btn-default">Submit</button>
                         <hr />
                        </form>
                            </div>
                            </div>
                    </div>

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
<?php
}
else
{
  header("Location: http://$host$uri/login.php");
  exit();
}  
 ?>
