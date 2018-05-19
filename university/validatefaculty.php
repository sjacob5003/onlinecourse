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
    <title>University - Verify Faculty</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php
    include('../includes/header.php');
    include('../includes/menubar.php');
?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Faculty Members</h1>
                    </div>
                    <div class="row" >

                    <div class="col-md-12">
                        <!--    Bordered Table  -->
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th>Faculty Name </th>
                                                <th>Faculty Email </th>
                                                <th>Phone Number </th>
                                                <th>Verification Status </th>
                                            </tr>
                                        </thead>
                                        <tbody>
    <?php
    $sql=mysqli_query($con, "SELECT facultytable.FacultyId, facultytable.FacultyName, facultytable.FacultyEmail, facultytable.FacultyPhone, facultytable.FacultyIsActive, universitytable.UniversityName FROM facultyverificationtable JOIN universitytable ON facultyverificationtable.UniversityId = universitytable.UniversityId RIGHT JOIN facultytable ON facultyverificationtable.FacultyId = facultytable.FacultyId");
    while($row=mysqli_fetch_array($sql))
    {
    ?>
        <tr>
            <td><?php echo htmlentities($row['FacultyName']);?></td>
            <td><?php echo htmlentities($row['FacultyEmail']);?></td>
            <td><?php echo htmlentities($row['FacultyPhone']);?></td>
            <td><?php
            if($row['FacultyIsActive']==1)
                echo "Verified by ".$row['UniversityName'];
            else
            {
            ?>
                <button class="btn btn-primary" onclick=verifyFac(<?php echo $row['FacultyId']; ?>)><i class="fa fa-book "></i>&nbsp;&nbsp;Validate</button></td>
            <?php } ?>
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
  <?php include('../includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>

    <script type="text/javascript">
    function verifyFac(id) {
    var facultyid=parseInt(id);
    var universityid=parseInt(<?php echo $_SESSION['userid'];?>);
    var dataString='facultyid='+facultyid+"&universityid="+universityid;
        $.ajax({
            type: "POST",
            url: "verify-faculty.php",
            data: dataString,
            cache: false,
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
