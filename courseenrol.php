<?php
session_start();
include('includes/config.php');
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
                        <h1 class="page-head-line">Java Core</h1>
                    </div>
                    <div class="row" >

                    <div class="col-md-12">
                        <!--    Bordered Table  -->

                            <!-- /.panel-heading -->
                            <div class="panel-body">

                                      <p>
                                                <b>Course Code:</b>

                                                Java101
                                      </p>
                                      <p>
                                                <b>Scope:</b>
                                                <br>
                                                Teaching is not only talking about topics, terms but also teaching the logic and attract the student's psychology. I have 6 years experience as a Java Developer with a lot of projects and 3 years experience as a Java Trainer. Love to share my knowledge with someone and be happy to see someone got a job with my training. My teaching style is not like "memorizing some rules", I teach the reasons and logic! Hope this tutorial set will be the best in Java Udemy Courses. Let me introduce what you will learn at the end of course. In this course you will learn
                                      </p>
                                      <p>
                                                <b>Level:</b>

                                                Level 1
                                      </p>
                                      <p>
                                                <b>Location:</b>

                                                Nizampura
                                      </p>
                                      <p>
                                                <b>Remaining Seats:</b>

                                                30
                                      </p>
                                      <p>
                                                <b>Start Date - End Date:</b>

                                                21/10/2018 - 20/12/2018
                                      </p>
                                      <p>
                                                <b>Faculty Name:</b>

                                                Mr. Sourabh Jacob
                                      </p>

                                      <br>

                                      <button class="btn btn-default" style="width:100%;height:60px" type="submit"><span class="glyphicon glyphicon-education"></span> &nbsp;Enrol</button>


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
</body>
</html>
