<?php
session_start();
require_once('../includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if(isset($_GET['studentid']))
{
    if(strlen($_SESSION['userid']) != 0 && $_SESSION['usertype']=='Faculty')
    {
        $studentid = $_GET['studentid'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Student Record</title>
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
                        <h1 class="page-head-line">Student Record</h1>
                    </div>
                    <div class="row" >

                    <div class="col-md-12">
                        <!--    Bordered Table  -->
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th>Student Name </th>
                                                <th>Course Name </th>
                                                <th>Marks </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sql = mysqli_query($con, "SELECT studenttable.StudentName, coursetable.CourseName, courseenrolmenttable.Marks FROM courseenrolmenttable JOIN coursedurationtable ON courseenrolmenttable.CourseDurationId = coursedurationtable.DurationId JOIN coursetable ON coursetable.CourseId = coursedurationtable.CourseId JOIN studenttable ON studenttable.StudentId = courseenrolmenttable.StudentId WHERE studenttable.StudentId = '$studentid'");
                                        while ($row = mysqli_fetch_array($sql))
                                        {
                                            $studentname = $row['StudentName'];
                                        ?>
                                        <tr>
                                            <td><?php echo $row['StudentName'] ?></td>
                                            <td><?php echo $row['CourseName'] ?></td>
                                            <td><?php echo $row['Marks'] ?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
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
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
              $('#example').DataTable();
   });
    </script>
</body>
</html>
<?php
    }
    else
    {
        header("Location:http://$host/onlinecourse/login.php");
        exit();
    }
}
else
{
    header("Location:http://$host/onlinecourse/login.php");
    exit();
}
?>
