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
    <title>Feedback Reviews</title>
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
                        <h1 class="page-head-line">Your Feedback Reviews</h1>
                    </div>
                    <div class="row" >

                    <div class="col-md-12">
                        <!--    Bordered Table  -->
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->

                            <div class="list-group">
                               <a href="#" class="list-group-item">
                                 <h4 class="list-group-item-heading">Review 1</h4>
                                 <label>student Name:</label>
                                           <p class="list-group-item-text">student name</p>
                                 <label>Course Name:</label>
                                           <p class="list-group-item-text">Course name</p>
                                 <label>Subject:</label>
                                           <p class="list-group-item-text">Subject name</p>
                                 <label>Description:</label>
                                           <p class="list-group-item-text">Description name</p>
                               </a>
                               <a href="#" class="list-group-item">
                                 <h4 class="list-group-item-heading">Review 2</h4>
                                 <label>student Name:</label>
                                           <p class="list-group-item-text">student name</p>
                                 <label>Course Name:</label>
                                           <p class="list-group-item-text">Course name</p>
                                 <label>Subject:</label>
                                           <p class="list-group-item-text">Subject name</p>
                                 <label>Description:</label>
                                           <p class="list-group-item-text">Description name</p>
                               </a>
                               <a href="#" class="list-group-item">
                                 <h4 class="list-group-item-heading">Review 3</h4>
                                 <label>student Name:</label>
                                           <p class="list-group-item-text">student name</p>
                                 <label>Course Name:</label>
                                           <p class="list-group-item-text">Course name</p>
                                 <label>Subject:</label>
                                           <p class="list-group-item-text">Subject name</p>
                                 <label>Description:</label>
                                           <p class="list-group-item-text">Description name</p>
                               </a>
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
