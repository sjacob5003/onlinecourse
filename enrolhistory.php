<?php
session_start();
require_once('includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if(strlen($_SESSION['userid'])!=NULL && $_SESSION['usertype']=="Student")
{
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Enrol History</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" />
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
                        <h1 class="page-head-line">Enrol History  </h1>
                    </div>
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
                                            <th>Course Code</th>
                                            <th>Course Name </th>
                                            <th>Duration </th>
                                             <th>Level</th>
                                             <th>Marks/Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    <?php
    $sql=mysqli_query($con, "SELECT CourseCode, CourseName, CourseLevel, CourseStartDate, CourseEndDate, Marks FROM coursedurationtable JOIN coursetable ON coursedurationtable.CourseId=coursetable.CourseId JOIN courseenrolmenttable ON courseenrolmenttable.CourseDurationId = coursedurationtable.DurationId WHERE StudentId=".$_SESSION['userid']);
    while($row=mysqli_fetch_array($sql))
    {
    ?>


                                        <tr>
                                            <td><?php echo $row['CourseCode'];?></td>
                                            <td><?php echo $row['CourseName'];?></td>
                                            <td><?php echo $row['CourseStartDate']." - ".$row['CourseEndDate'];?></td>
                                            <td><?php if($row['CourseLevel']==1)
                                              echo "Beginner";
                                              elseif($row['CourseLevel']==2)
                                              echo "Intermediate";
                                              elseif($row['CourseLevel']==3)
                                              echo "Expert";
                                                ?></td>
                                            <td><?php echo $row['Marks'];?></td>
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
    <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );
} );
    </script>
</body>
</html>
<?php }
else
{
    header("Location:http://$host$uri/login.php");
    exit();
}
?>
