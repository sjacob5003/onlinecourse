<?php
session_start();
require_once('../includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
$facultyid = $_SESSION['userid'];
if(strlen($_SESSION['userid']) != 0 && $_SESSION['usertype'] == "Admin")
{
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Feedback</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" />
</head>

<body>
<?php include('../includes/header.php');
  include('../includes/menubar.php');
?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Feedback About Your Courses</h1>
                    </div>
                    <div class="row" >

                    <div class="col-md-12">
                        <!--    Bordered Table  -->
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->

                            <div class="list-group">
                                <?php
                                $sql = mysqli_query($con, "SELECT FeedbackStudentId, FeedbackSubject, FeedbackDescription, coursetable.CourseName, studenttable.StudentName FROM feedbacktable JOIN coursedurationtable ON coursedurationtable.DurationId = feedbacktable.CourseDurationId JOIN coursetable ON coursedurationtable.CourseId = coursetable.CourseId JOIN facultytable ON facultytable.FacultyId = coursetable.CourseFacultyId JOIN studenttable ON feedbacktable.FeedbackStudentId = studenttable.StudentId WHERE facultytable.FacultyId = '$facultyid'");
                                while ($row = mysqli_fetch_array($sql))
                                {
                                ?>
                                <a href="#" class="list-group-item" style="cursor: default;">                                
                                    <h4 class="list-group-item-heading" style="text-align: center; margin-top: 25px; margin-bottom: 25px;"><?php echo $row['CourseName']?></h4>
                                    <label>Student Name:</label>
                                    <p class="list-group-item-text"><?php echo $row['StudentName']?></p>
                                    <label>Subject:</label>
                                    <p class="list-group-item-text"><?php echo $row['FeedbackSubject']?></p>
                                    <label>Description:</label>
                                    <p class="list-group-item-text"><?php echo $row['FeedbackDescription']?></p>
                                </a>
                                <?php
                                }
                                ?>
                            </div>

                        </div>
                         <!--  End  Bordered Table  -->
                    </div>
                </div>
                </div>
        </div>
    </div>
  <?php include('../includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script>
    $('.list-group').on('click', function(e){
        e.preventDefault();
    });
    </script>
</body>
</html>
<?php
}
else
{
    $_SESSION['errmsg']="Please Login";
    header("Location:http://$host/onlinecourse/index.php");
    exit();
}
?>