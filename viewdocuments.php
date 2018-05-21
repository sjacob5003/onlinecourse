<?php
session_start();
include('includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if(strlen($_SESSION['email']) == '' || $_SESSION['email'] == NULL)
  header("Location:http://$host$uri/index.php");
else
{
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Documents</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
<?php include('includes/header.php');
if($_SESSION['email']!="")
  include('includes/menubar.php');
?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <center><h1 class="page-head-line">DOCUMENTS FOR YOUR COURSES</h1></center>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div class="panel panel-default">
                          <font color="green" align="center">
                          <?php echo htmlentities($_SESSION['msg']);
                                $_SESSION['msg']="";?></font>

                            <div class="panel-body">
                              <div class="row">
                              <div class="col-xs-12">
                                        <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr class="bg-primary">
                                      <th>#</th>
                                      <th>Course Name</th>
                                      <th>File Name</th>
                                      <th>View</th>
                                      <th>Download</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                  $i = 1;
                                  $sql = mysqli_query($con, "SELECT id, coursetable.CourseId, coursetable.CourseName, filename, created FROM tbl_files JOIN coursetable JOIN coursedurationtable ON coursedurationtable.DurationId = tbl_files.CourseDurationId AND coursetable.CourseId = coursedurationtable.CourseId JOIN courseenrolmenttable ON courseenrolmenttable.CourseDurationId = coursedurationtable.DurationId WHERE courseenrolmenttable.StudentId = ".$_SESSION['userid']);
                                  while($row = mysqli_fetch_array($sql)) { ?>
                                  <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['CourseName']; ?></td>
                                    <td><?php echo $row['filename']; ?></td>
                                    <td><a href="faculty/uploads/<?php echo $row['filename']; ?>" target="_blank">View</a></td>
                                    <td><a href="faculty/uploads/<?php echo $row['filename']; ?>" download>Download</td>
                                  </tr>
                                  <?php } ?>
                                  </tbody>
                                </table>
                      </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php
}
?>
