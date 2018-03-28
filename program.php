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
    <title>Program Page</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/statestyle.css" rel="stylesheet" />
    <style type="text/css">
  #regiration_form fieldset:not(:first-of-type) {
    display: none;
  }
  </style>

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
                                      <div class="progress" style="height:40px">
    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <form id="regiration_form" novalidate action="action.php"  method="post">
  <fieldset>
    <h3>Step 1: Program Name</h3>
    <div id="selection" class="form-group">
              <select class="selectpicker" name="programname" data-style="btn" data-width="100%" data-border="1px"  title="Choose Your Program" required >
                    <option>Bachelors in computer applications</option>
                    <option>Bachelors in business administration</option>
                    <option>Bachelors in mass communication</option>
          </select>
</div>
<div id="selection" class="form-group">
         <select class="selectpicker" name="shortname" data-style="btn" data-width="100%" data-border="1px" title="Choose Your Program" required >
                <option>BCA</option>
                <option>BBA</option>
                <option>BMC</option>
      </select>
</div>

    <input type="button" name="password" style="width:100%" class="next btn btn-default" value="Next" />
  </fieldset>
  <fieldset>
    <h3> Step 2: Select Courses</h3>
    <div id="selection" class="form-group">
              <select class="selectpicker" name="course" data-style="btn" data-width="100%" data-border="1px" multiple title="Choose Courses" multiple data-actions-box="true" data-live-search="true" required >
                    <option>Java</option>
                    <option>Ruby</option>
                    <option>Php</option>
          </select>
</div>
    <input type="button" name="previous" style="width:49%" class="previous btn btn-warning" value="Previous" />
    <input type="button" name="submit" style="width:49%" class="next btn btn-default" value="Submit" />

  </fieldset>
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
                  <script src="assets/js/bootstrap-select.min.js"></script>
                  <script src="assets/js/state.js"></script>
                  <script src="assets/js/statejquery.js"></script>
                  <script>
                  $(document).ready(function(){
  var current = 1,current_step,next_step,steps;
  steps = $("fieldset").length;
  $(".next").click(function(){
    current_step = $(this).parent();
    next_step = $(this).parent().next();
    next_step.show();
    current_step.hide();
    setProgressBar(++current);
  });
  $(".previous").click(function(){
    current_step = $(this).parent();
    next_step = $(this).parent().prev();
    next_step.show();
    current_step.hide();
    setProgressBar(--current);
  });
  setProgressBar(current);
  // Change progress bar action
  function setProgressBar(curStep){
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
      .css("width",percent+"%")
      .html(percent+"%");
  }
});
</script>
              </body>
              </html>
