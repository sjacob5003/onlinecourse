<?php
session_start();
include('includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if(strlen($_SESSION['email']) == 0)
{
  header("Location:http://$host$uri/login.php");
}
else
{
  if(isset($_POST['submit']))
  {
    $feedbacksubject = $_POST['feedbacksubject'];
    $feedbackdescription = $_POST['feedbackdescription'];
    $feedbackcourseid = $_POST['feedbackcourseid'];
    $studentid = $_SESSION['userid'];
    if(mysqli_query($con,"INSERT INTO feedbacktable (CourseDurationId, FeedbackStudentId, FeedbackSubject, FeedbackDescription) VALUES ('$feedbackcourseid', '$studentid', '$feedbacksubject', '$feedbackdescription') "))
      $_SESSION['msg'] = "Thank you for your feedback";
    else
      $_SESSION['msg'] = "Could not submit your feedback. Please try again";
  }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Feedback / Complaint</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
<?php include('includes/header.php');
if($_SESSION['email']!="")
  include('includes/menubar.php');
?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <center><h1 class="page-head-line">Feedback Form</h1></center>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div class="panel panel-default">
                          <font color="green" align="center">
                          <?php echo htmlentities($_SESSION['msg']);  
                                $_SESSION['msg']="";?></font>

                            <div class="panel-body">
                            <form name="dept" method="post" enctype="multipart/form-data">

                              <div class="form-group">
                                <label>Select Course</label>
                                  <select class="selectpicker" data-live-search="true" name="feedbackcourseid" data-style="btn" data-width="100%" data-border="1px" title="Select the Course" required>
                                  <?php
                                    $sql=mysqli_query($con, "SELECT coursedurationtable.DurationId, CourseName FROM coursedurationtable JOIN coursetable ON coursedurationtable.CourseId=coursetable.CourseId JOIN courseenrolmenttable ON courseenrolmenttable.CourseDurationId = coursedurationtable.DurationId WHERE StudentId=".$_SESSION['userid']);
                                    while($row = mysqli_fetch_array($sql))
                                    {
                                    ?>
                                      <option value=<?php echo $row['DurationId']; ?>><?php echo $row['CourseName']; ?></option>
                                  <?php
                                    }
                                  ?>
                                  </select>
                                </div>

                              <div class="form-group">
                                <label for="studentid">Subject </label>
                                <input type="text" class="form-control" placeholder="Your subject" name="feedbacksubject" value=""/>
                              </div>

                              <div class="form-group">
                                <label for="studentname">Description </label>
                                <textarea class="form-control rounded-0" rows="10" placeholder="Feedback / Complaint" name="feedbackdescription"></textarea>
                              </div>

                          <?php } ?>

                             <button type="submit" name="submit" id="submit" style="width:100%" class="btn btn-default">Submit</button>
                            </form>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>

</body>
</html>
