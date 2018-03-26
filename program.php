<?php
session_start();
require_once('/includes/config.php');
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
    <title>Faculty Profile</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('/includes/header.php');
if($_SESSION['email']!="")
  include('/includes/menubar.php');
?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <center><h1 class="page-head-line">Program</h1></center>
                    </div>
                </div>

                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div class="panel panel-default">
                            <div class="panel-body">
                            <form name="dept" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="facultyid">Program Name </label>
                                <input type="text" class="form-control" id="facultyid" name="facultyid" value="" />
                              </div>

                              <div class="form-group">
                                <label for="facultyname">Abbreviated Name </label>
                                <input type="text" class="form-control" id="facultyname" name="facultyname" value=""  />
                              </div>

                              <div class="form-group col-xs-6">
                                <label for="facultyid">Start Date </label>
                                <input type="date" class="form-control" id="facultyid" name="facultyid" value="" />
                              </div>

                              <div class="form-group col-xs-6">
                                <label for="facultyname">End Date </label>
                                <input type="date" class="form-control" id="facultyname" name="facultyname" value=""  />
                              </div>

                             <button type="submit" name="submit" id="submit" class="btn btn-default" style="width:100%">Submit</button>

                            </form>
                        </div>
                      </div>
                    </div>
                </div>
      </div>
</div>
                <?php include('/includes/footer.php');?>
                  <script src="assets/js/jquery-1.11.1.js"></script>
                  <script src="assets/js/bootstrap.js"></script>

              </body>
              </html>
