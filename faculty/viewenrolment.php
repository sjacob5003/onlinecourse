<?php
session_start();
require_once('../includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if($_SESSION['email']!=NULL && $_SESSION['usertype']=='Faculty')
{
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Students</title>
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
                        <h1 class="page-head-line"><?php echo $_GET['coursename']; ?></h1>
                    </div>
                    <div class="row" >

                    <div class="col-md-12">
                        <!--    Bordered Table  -->
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive table-bordered">
                                    <table id="example" class="table">
                                        <form>
                                        <thead>
                                            <tr>
                                                <th>Student ID </th>
                                                <th>Student Name </th>
                                                <th>Student Email</th>
                                                <th>Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
    <?php
    $sql=mysqli_query($con, "SELECT studenttable.StudentId, studenttable.StudentName, studenttable.StudentEmail, courseenrolmenttable.Marks                     FROM courseenrolmenttable
                            JOIN studenttable ON studenttable.StudentId=courseenrolmenttable.StudentId
                            JOIN coursetable ON coursetable.CourseId=courseenrolmenttable.CourseId
                            WHERE coursetable.CourseId=".$_GET['courseid']);
    while($row=mysqli_fetch_array($sql))
    {
    ?>
        <tr>
            <td><?php echo htmlentities($row['StudentId']);?><input type="hidden" name="studentid[]" value=<?php echo htmlentities($row['StudentId']);?>></td>
            <td><?php echo htmlentities($row['StudentName']);?></td>
            <td><?php echo htmlentities($row['StudentEmail']);?></td>
            <td><input type="text" name="marks[]" value="<?php echo $row['Marks'];?>"></td>
        </tr>
    <?php
    } ?>
        <tr><td colspan=4 align=center><input type="submit" class="btn btn-primary" name="Submit" value="Submit Marks"></td></tr>
                                        </tbody>
                                    </form>
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
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <!-- <script type="text/javascript">
    $(document).ready(function() {
              $('#example').DataTable();
   });
    </script> -->
    <script>
      $(function () {
        // $('#example').DataTable();
        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'updatemarks.php',
            data: $('form').serialize(),
            success: function () {
              alert('Marks Entered');
            }
          });

        });
      });
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
