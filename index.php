<?php
session_start();
require_once('includes/config.php');
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
    <title>Home</title>
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

                        <center><h3>AFFILIATED UNIVERSITIES</h3></center>
                        <br>
 <section class="customer-logos slider">
    <div class="slide"><img src="images/nuv.jpg"></div>
    <div class="slide"><img src="images/msu.jpg"></div>
    <div class="slide"><img src="images/parul.jpg"></div>
    <div class="slide"><img src="images/itm.jpg"></div>
    <div class="slide"><img src="images/nirma.jpg"></div>
    <div class="slide"><img src="images/bits.jpg"></div>
    <div class="slide"><img src="images/suman.jpg"></div>
    <div class="slide"><img src="images/amity.jpeg"></div>
 </section>

<br>


                    <div class="col-md-12">
                        <h1 class="page-head-line">Upcoming Courses</h1>
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
                                                <th>Faculty Name </th>
                                                <th>Course Level</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <?php
                                                if($_SESSION['email']!=NULL && $_SESSION['usertype']=='Student')
                                                    echo "<th>Enrol</th>";
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
    <?php
    $sql=mysqli_query($con, "SELECT DurationId, CourseCode, CourseName, FacultyName, CourseLevel, CourseStartDate, CourseEndDate FROM coursetable JOIN facultytable ON coursetable.CourseFacultyId = facultytable.FacultyId JOIN coursedurationtable ON coursedurationtable.CourseId=coursetable.CourseId WHERE coursedurationtable.CourseStartDate>CURRENT_DATE");
    while($row=mysqli_fetch_array($sql))
    {
    ?>
        <tr>
            <td><?php echo htmlentities($row['CourseCode']);?></td>
            <td><?php echo htmlentities($row['CourseName']);?></td>
            <td><?php echo htmlentities($row['FacultyName']);?></td>
            <td><?php if($row['CourseLevel']==1)
                echo htmlentities("Beginner");
                elseif($row['CourseLevel']==2)
                    echo htmlentities("Intermediate");
                elseif($row['CourseLevel']==3)
                    echo htmlentities("Expert");?></td>
                <td><?php echo htmlentities($row['CourseStartDate']);?></td>
                <td><?php echo htmlentities($row['CourseEndDate']);?></td>
            <?php
            if($_SESSION['email']!=NULL && $_SESSION['usertype']=='Student')
                {
          ?>
          <td> <a href="courseenrol.php?durationid=<?php echo $row['DurationId']?>">
                <button class="btn btn-primary"><i class="fa fa-book "></i>&nbsp;&nbsp;Enrol</button> </a>
                      </td>
            <?php } ?>
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
  <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
              $('#example').DataTable();
   });
    </script>
<script>
$(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
});
</script>
</body>
</html>
