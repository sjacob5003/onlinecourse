<?php
session_start();
require_once('../includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Your Courses</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
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
                        <h1 class="page-head-line">Courses You Conduct</h1>
                    </div>
                    <div class="row" >

                    <div class="col-md-12">
                        <!--    Bordered Table  -->
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive table-bordered">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Course Code </th>
                                                <th>Course Name </th>
                                                <th>Course Level</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <?php
                                                if($_SESSION['email']!=NULL && $_SESSION['usertype']=='Faculty')
                                                    echo "<th>View Students</th>";
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
    <?php
    $sql=mysqli_query($con, "SELECT coursetable.CourseId, CourseCode, CourseName, CourseLevel, CourseStartDate, CourseEndDate FROM coursetable JOIN facultytable ON coursetable.CourseFacultyId=facultytable.FacultyId LEFT JOIN coursedurationtable ON coursetable.CourseId=coursedurationtable.CourseId WHERE facultytable.FacultyId=".$_SESSION['userid']);
    while($row=mysqli_fetch_array($sql))
    {
    ?>
        <tr>
            <td><?php echo htmlentities($row['CourseCode']);?></td>
            <td><?php echo htmlentities($row['CourseName']);?></td>
            <td><?php if($row['CourseLevel']==1)
                echo htmlentities("Beginner");
                elseif($row['CourseLevel']==2)
                    echo htmlentities("Intermediate");
                elseif($row['CourseLevel']==3)
                    echo htmlentities("Expert");?></td>
            <td><?php echo htmlentities($row['CourseStartDate']);?></td>
            <td><?php echo htmlentities($row['CourseEndDate']);?></td>
            <td> <a href="viewenrolment.php?courseid=<?php echo $row['CourseId']?>&coursename=<?php echo $row['CourseName']?>">
                <button class="btn btn-primary"><i class="fa fa-book "></i>&nbsp;&nbsp;View Students</button> </a></td>
        </tr>
    <?php
    } ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
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

</html>
