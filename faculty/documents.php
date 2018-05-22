<?php
session_start();
include('../includes/config.php');
$sql = "select filename from tbl_files";
$result = mysqli_query($con, $sql);
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
//set target directory
$path = 'uploads/';
$facultyid = $_SESSION['userid'];
if(strlen($_SESSION['userid']) != 0 && $_SESSION['usertype']=='Faculty')
{
    if(isset($_POST['submit']))
    {
        $filename = $_FILES['file1']['name'];
        $courseid = $_POST['coursename'];
        //upload file
        if($filename != '')
        {
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $allowed = ['pdf', 'txt', 'doc', 'docx', 'png', 'jpg', 'jpeg',  'gif'];

            //check if file type is valid
            if (in_array($ext, $allowed))
            {
                // get auto increment id
                $sql = mysqli_query($con, "SHOW TABLE STATUS LIKE 'tbl_files'");
                if ($row = mysqli_fetch_array($sql))
                $filename = $row['Auto_increment'] . '-' . $filename;

                $created = @date('Y-m-d H:i:s');
                move_uploaded_file($_FILES['file1']['tmp_name'],($path . $filename));

                // insert file details into database            
                if (mysqli_query($con, "INSERT INTO tbl_files (CourseDurationId, filename, created) VALUES('$courseid', '$filename', '$created')") )
                    header("Location: documents.php?st=success");
            }
            else
            {
                header("Location: documents.php?st=error");
            }
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
    <title>Upload Document</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('../includes/header.php');
if($_SESSION['email']!="")
  include('../includes/menubar.php');
?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <center><h1 class="page-head-line">Documents</h1></center>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div class="panel panel-default">

                        <div class="panel-body">
                        <form method="post" enctype="multipart/form-data">

                            <legend>Select File to Upload:</legend>
                            <div class="form-group">
                                <input type="file" name="file1" />
                            </div>

                           <legend>Select Course:</legend>
                            <div class="form-group">
                                <select class="selectpicker" name="coursename" data-style="btn" data-width="100%" data-border="1px" title="Choose Course" required>
                                <?php
                                $sql = mysqli_query($con, "SELECT coursedurationtable.DurationId, CourseName FROM coursetable JOIN facultytable ON coursetable.CourseFacultyId=facultytable.FacultyId LEFT JOIN coursedurationtable ON coursetable.CourseId=coursedurationtable.CourseId WHERE facultytable.FacultyId='$facultyid'");
                                while ($row = mysqli_fetch_array($sql))
                                {
                                ?>
                                    <option value=<?php echo $row['DurationId'] ?>><?php echo $row['CourseName'] ?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="submit" value="Upload" class="btn btn-primary"/>
                            </div>

  <?php if(isset($_GET['st'])) { ?>
        <div class="alert alert-danger text-center">
        <?php if ($_GET['st'] == 'success') {
                echo "File Uploaded Successfully!";
            }
            else
            {
                echo 'Invalid File Extension!';
            } ?>

</div>

                          <?php } ?>

                            </form>
                        </div>

                      <div class="row">
                              <div class="col-xs-12">
                                        <div class="table-responsive">
                                  <table class="table table-striped table-hover">
                                      <thead>
                                          <tr class="bg-primary">
                                              <th>#</th>
                                              <th>File Name</th>
                                              <th>View</th>
                                              <th>Download</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                      $i = 1;
                                      while($row = mysqli_fetch_array($result)) { ?>
                                      <tr>
                                          <td><?php echo $i++; ?></td>
                                          <td><?php echo $row['filename']; ?></td>
                                          <td><a href="<?php echo $path.$row['filename']; ?>" target="_blank">View</a></td>
                                          <td><a href="uploads/<?php echo $row['filename']; ?>" download>Download</td>
                                      </tr>
                                      <?php } ?>
                                      </tbody>
                                  </table>
                        </div>
                              </div>
                          </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php include('../includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
</body>
</html>
<?php
}
else
{
    $_SESSION['errmsg']="Please Login";
    header("Location:http://$host/onlinecourse/index.php");
    exit();
}
?>