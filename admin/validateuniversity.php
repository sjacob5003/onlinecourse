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
    <title>Admin - Verify University</title>
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
                        <h1 class="page-head-line">Universities</h1>
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
                                                <th>University Name </th>
                                                <th>University Email </th>
                                                <th>Contact Person </th>
                                                <th>Phone Number </th>
                                                <th>Verify </th>
                                            </tr>
                                        </thead>
                                        <tbody>
    <?php
    $sql=mysqli_query($con, "SELECT UniversityName, UniversityEmail, UniversityContactPerson, UniversityPhone FROM universitytable where UniversityIsActive=0");
    while($row=mysqli_fetch_array($sql))
    {
    ?>
        <tr>
            <td><?php echo htmlentities($row['UniversityName']);?></td>
            <td><?php echo htmlentities($row['UniversityEmail']);?></td>
            <td><?php echo htmlentities($row['UniversityContactPerson']);?></td>
            <td><?php echo htmlentities($row['UniversityPhone']);?></td>
            <td>A</td>
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
</body>
</html>