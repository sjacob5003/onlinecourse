<?php
session_start();
require_once('../includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if($_SESSION['email'] != NULL && $_SESSION['email'] != '')
{
    if(isset($_POST['submit']))
    {
        $courseid = $_POST['courseidhidden'];
        $startdate = $_POST['start'];
        $enddate = $_POST['end'];
        if(mysqli_query($con, "INSERT IGNORE INTO coursedurationtable (CourseId, CourseStartDate, CourseEndDate) VALUES ('$courseid','$startdate','$enddate')"))
        {
            $_SESSION['errmsg']="Course Successfully Renewed";
            header("Location:http://$host$uri/viewcourses.php");
            exit();   
        }
        else
        {
            $_SESSION['errmsg']="Course Could Not Be Renewed";
            header("Location:http://$host$uri/viewcourses.php");
            exit();
        }
    }
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
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <style>
    .renewmodal {
        position: fixed;
        left: 10%;;
        top: 10%;
        right: 10%;
        bottom: 10%;
        z-index: 100;
        border: 2px solid black;
        background: #bbbddc;
    }
    </style>
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
                    <span style="color:red;">
                    <?php 
                    echo htmlentities($_SESSION['errmsg']); 
                    $_SESSION['errmsg']="";
                    ?>
                    </span>
                    <div class="row" >
                    <div class="modal">
                        <div class="renewmodal">                        
                        <div id="close" style="float: right; margin-right: 10px;" ><span class="glyphicon glyphicon-remove"></span></div>
                        <div style="text-align: center;">
                            <h2></h2>
                        </div>
                        <form name="courserenewalform" method="post">
                            <div class="form-group">                                
                                <label>Start Date</label>
                                <input id="start" name="start" type="date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <input id="end" name="end" type="date" class="form-control" required>
                            </div>
                            <input type="hidden" name="courseidhidden" id="courseidhidden">
                            <button type="submit" name="submit" style="width: 100%;" class="btn btn-primary">Renew </button>
                        </form>
                            
                        </div>                    
                    </div>
                    <div class="col-md-12">
                        <!--    Bordered Table  -->
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th class="displaynone"></th>
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
            <td class="displaynone"><?php echo htmlentities($row['CourseId']);?></td>
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
                <button class="btn btn-primary"><i class="fa fa-eye "></i></button> </a>
                <button class="btn btn-primary renew" id='renew'>Renew</button>
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
        });
        $('.renew').on('click', function() {
            var courseid = $(this).closest('tr').find('td').first().html();
            var coursename = $(this).closest('tr').find('td:nth-child(3)').html();
            $('.renewmodal h2').html(coursename);
            $('#courseidhidden').val(courseid);
            $('.modal').css('display', 'block');
        });
        $('#close').on('click', function() {
            $('.modal').css('display', 'none');
        });
    });
    var start = document.getElementById('start');
    var end = document.getElementById('end');
    end.disabled = true;
    start.min = new Date().toJSON().split('T')[0];
    start.addEventListener('change', function() {
        if (start.value)
        {
            end.min = start.value;
            end.disabled = false;
        }
    }, false);
    end.addEventListener('change', function() {
        if (end.value)
            start.max = end.value;
    }, false);
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