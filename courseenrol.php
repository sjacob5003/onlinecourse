<?php
session_start();
include('includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
$sql=mysqli_query($con, "SELECT CourseId, CourseCode, CourseName, CourseScope, CourseNoOfSeats, CourseLocation, FacultyName, CourseLevel FROM coursetable JOIN facultytable ON coursetable.CourseFacultyId = facultytable.FacultyId WHERE CourseId=".$_GET['courseid']);
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
                                        <b>Course Code:</b>
                                        <?php echo $row['CourseCode']; ?>
                              </p>
                              <p>
                                        <b>Scope:</b>
                                        <br>
                                        <?php echo htmlentities($row['CourseScope']); ?>
                              </p>
                              <p>
                                        <b>Level:</b>
                                        <?php if($row['CourseLevel']==1)
                                              echo "Beginner";
                                              elseif($row['CourseLevel']==2)
                                              echo "Intermediate";
                                              elseif($row['CourseLevel']==3)
                                              echo "Expert";
                                        ?>
                              </p>
                              <p>
                                        <b>Location:</b>
                                        <?php echo $row['CourseLocation']; ?>
                              </p>
                              <p>
                                        <b>Remaining Seats:</b>
                                        <?php echo $row['CourseNoOfSeats']; ?>
                              </p>
                              <p>
                                        <b>Start Date - End Date:</b>
                                        21/10/2018 - 20/12/2018
                              </p>
                              <p>
                                        <b>Faculty Name:</b>
                                        <?php echo $row['FacultyName']; ?>
                              </p>
                              <br>

                              <button class="btn btn-default" style="width:100%;height:60px" type="submit"><span class="glyphicon glyphicon-education"></span> &nbsp;Enrol</button>


                            </div>

                         <!--  End  Bordered Table  -->
                    </div>
                </div>
                </div>
        </div>
    </div>
  <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php
}
?>