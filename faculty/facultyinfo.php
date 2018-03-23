<?php
session_start();
require_once('../includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if(strlen($_SESSION['userid'])!=NULL && $_SESSION['usertype']=="Student")
{
  $sql=mysqli_query($con, "SELECT coursetable.CourseId, CourseCode, CourseName, CourseScope, CourseNoOfSeats-count(StudentId) AS RemainingSeats, CourseLocation, FacultyName, CourseLevel, CourseStartDate, CourseEndDate FROM coursetable JOIN facultytable ON coursetable.CourseFacultyId = facultytable.FacultyId JOIN coursedurationtable ON CourseDurationId=DurationId JOIN courseenrolmenttable ON coursetable.CourseId = courseenrolmenttable.CourseId WHERE coursetable.CourseId=".$_GET['courseid']);
  while($row=mysqli_fetch_array($sql))
  {
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Enrol</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');
  include('includes/menubar.php');
?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line"><?php echo $row['CourseName']; ?></h1>
                    </div>
                    <div class="row" >

                    <div class="col-md-12">
                        <!--    Bordered Table  -->

                            <!-- /.panel-heading -->
                            <div class="panel-body">

                              <p>
                                        <b>Lecturer:</b>

                              </p>
                              <p>
                                        <b>Educational Information:</b>
                                        <br>

                              </p>
                              <p>
                                        <b>Academic Experience:</b>

                              </p>
                              <p>
                                        <b>Contact Information:</b>

                              </p>
                            </div>

                         <!--  End  Bordered Table  -->
                    </div>
                </div>
                </div>
        </div>
    </div>
    <script type="text/javascript">
      function enrolStudent() {
    var course_id=parseInt(<?php echo $_GET['courseid'];?>);
    var student_id=parseInt(<?php echo $_SESSION['userid'];?>);
    var dataString='courseid='+course_id+"&studentid="+student_id;

// AJAX code to send data to php file.
        $.ajax({
            type: "POST",
            url: "enrol-student.php",
            data: dataString,
            cache: false,
            // data: {course_id:course_id,student_id:student_id},
            // dataType: "JSON",
            success: function(html) {
              alert(html);
            },
            error: function(html) {
              alert(html);
            }
        });
        window.location.href="enrolhistory.php";
}
</script>
  <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php
  }
}
else
{
  header("Location:http://$host$uri/login.php");
  exit();
}
?>
