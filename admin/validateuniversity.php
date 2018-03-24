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
                                                <th>Verification Status </th>
                                            </tr>
                                        </thead>
                                        <tbody>
    <?php
    $sql=mysqli_query($con, "SELECT UniversityId, UniversityName, UniversityEmail, UniversityContactPerson, UniversityPhone, UniversityIsActive, AdminName FROM universitytable LEFT JOIN admintable ON UniversityVerifiedBy=AdminId");
    while($row=mysqli_fetch_array($sql))
    {
    ?>
        <tr>
            <td><?php echo htmlentities($row['UniversityName']);?></td>
            <td><?php echo htmlentities($row['UniversityEmail']);?></td>
            <td><?php echo htmlentities($row['UniversityContactPerson']);?></td>
            <td><?php echo htmlentities($row['UniversityPhone']);?></td>
            <td><?php
            if($row['UniversityIsActive']==1)
                echo "Verified by ".$row['AdminName'];
            else
            {
            ?>
                <button class="btn btn-primary" onclick=verifyUni(<?php echo $row['UniversityId'] ?>)><i class="fa fa-book "></i>&nbsp;&nbsp;Validate</button></td>
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
    function verifyUni(id) {
    var universityid=parseInt(id);
    var adminid=parseInt(<?php echo $_SESSION['userid'];?>);
    var dataString='universityid='+universityid+"&adminid="+adminid; 
        $.ajax({
            type: "POST",
            url: "verify-university.php",
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