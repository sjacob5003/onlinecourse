<?php
session_start();
require_once('../includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if($_SESSION['userid']!=NULL && $_SESSION['usertype']=='Faculty')
{
    if(isset($_POST['add']))
    {
        if(isset($_POST['coursename']))
            $name=$_POST['coursename'];
        else
            echo "No Course Name";
        if(isset($_POST['coursecode']))
            $code=$_POST['coursecode'];
        else
            echo "No CourseCode";
        if(isset($_POST['coursescope']))
            $scope=$_POST['coursescope'];
        else
            echo "No CourseScope";
        if(isset($_POST['courseseats']))
            $noofseats=$_POST['courseseats'];
        else
            echo "No Seats";
        if(isset($_POST['courselocation']))
            $location=$_POST['courselocation'];
        else
            echo "No Location";
        if(isset($_POST['courselevel']))
            $level=$_POST['courselevel'];
        else
            echo "No CourseLEVEL";
        $facultyid=$_SESSION['userid'];
        echo $facultyid;
        if(mysqli_query($con, "INSERT INTO coursetable (CourseName, CourseCode, CourseNoOfSeats, CourseScope, CourseLevel, CourseFacultyId, CourseLocation) VALUES ('$name','$code','$noofseats', '$scope','$level','$facultyid','$location')"))
        {
            $_SESSION['errmsg']="Course Successfully Added";
            header("Location:http://$host$uri/addcourse.php");
            exit();
        }
        else
        {
            $_SESSION['errmsg']="Course Could Not Be Added";
            header("Location:http://$host$uri/addcourse.php");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Add Course</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <?php include('../includes/header.php');
    include('../includes/menubar.php');?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <center><h4 class="page-head-line"><span class="glyphicon glyphicon-envelope"></span> &nbsp;Add course </h4></center>
                </div>
            </div>
             <span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
            <form name="addcourse" method="post">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">

        	   <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <input id="coursename" type="text" class="form-control" name="coursename" placeholder="Course Name" required>
                </div>
                <br>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
                <input id="coursecode" type="text" class="form-control" name="coursecode" maxlength="5" placeholder="Course Code" required>
              </div>

<br>

		      <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                <input id="courseseats" type="number" min="0" max="50" class="form-control" name="courseseats" maxlength=10 placeholder="Course Seats" required>
              </div>

<br>

              <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
                    <textarea class="form-control" name="coursescope" rows="11" id="scope" placeholder="Course Scope..." required></textarea>
              </div>

<br>

              <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                    <input id="courselocation" type="text" class="form-control" name="courselocation" placeholder="Course Location" required>
              </div>

<br>

              <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                   <select class="selectpicker" name="courselevel" data-style="btn" data-width="100%" data-border="1px" title="Choose Course Level" required>
                             <option value=1>Beginner</option>
                             <option value=2>Intermediate</option>
                             <option value=3>Expert</option>
                  </select>
               </div>

                           <br>

                    <button type="submit" name="add" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> &nbsp;Add </button>&nbsp;
		            <button type="reset" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-remove"></span> &nbsp;Reset </button>&nbsp;

                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('../includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
</body>
</html>
<?php
}
else
{
    $_SESSION['errmsg']="Please Login";
    header("Location:http://$host/onlinecourse/login.php");
    exit();
}
?>
