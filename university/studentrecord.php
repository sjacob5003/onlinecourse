<?php
session_start();
require_once('../includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if(strlen($_SESSION['userid'])!=NULL && $_SESSION['usertype']=="University")
{
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Deregister</title>
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
                        <h1 class="page-head-line">Available Courses</h1>
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
                                                <th>Course Code </th>
                                                <th>Course Name </th>
                                                <th>Start Date </th>
                                                <th>Course Level</th>
                                                <th>Deregister</th>
                                            </tr>
                                        </thead>
                                        <tbody>
    <?php
    $sql=mysqli_query($con, "SELECT DurationId, CourseCode, CourseName, CourseLevel, CourseStartDate, Marks FROM coursedurationtable JOIN coursetable ON coursetable.CourseId=coursedurationtable.CourseId JOIN courseenrolmenttable ON coursedurationtable.DurationId = courseenrolmenttable.CourseDurationId WHERE CourseStartDate>CURDATE() AND StudentId=".$_SESSION['userid']);
    while($row=mysqli_fetch_array($sql))
    {
    ?>
        <tr>
            <td><?php echo htmlentities($row['CourseCode']);?></td>
            <td><?php echo htmlentities($row['CourseName']);?></td>
            <td><?php echo htmlentities($row['CourseStartDate']);?></td>
            <td><?php if($row['CourseLevel']==1)
                echo htmlentities("Beginner");
                elseif($row['CourseLevel']==2)
                    echo htmlentities("Intermediate");
                elseif($row['CourseLevel']==3)
                    echo htmlentities("Expert");?></td>
          <td>
                <button id="deregbtn" name="deregbtn" onclick="dereg(<?php echo $row['DurationId']; ?>)" class="btn btn-primary"><i class="fa fa-user-times "></i>&nbsp;&nbsp;Deregister</button> </a>
                      </td>
        </tr>
    <?php
    } ?>


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
    <script type="text/javascript">
      function dereg(id) {
    var duration_id=parseInt(id);
    var student_id=parseInt(<?php echo $_SESSION['userid'];?>);
    var dataString='durationid='+duration_id+"&studentid="+student_id;

// AJAX code to send data to php file.
        $.ajax({
            type: "POST",
            url: "dereg-student.php",
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
        location.reload();
    }
    </script>
</body>
</html>
<?php
}
else
{
    header("Location:http://$host$uri/login.php");
    exit();
}
?>
