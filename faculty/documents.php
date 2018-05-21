<?php
session_start();
include('../includes/config.php');
$sql = "select filename from tbl_files";
$result = mysqli_query($con, $sql);
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
//set target directory
$path = 'uploads/';
if(strlen($_SESSION['email'])==0)
{
  header("Location:http://$host$uri/index.php");
}
else
{
  if(isset($_POST['submit']))
  {
            $filename = $_FILES['file1']['name'];

     //upload file
     if($filename != '')
     {
         $ext = pathinfo($filename, PATHINFO_EXTENSION);
         $allowed = ['pdf', 'txt', 'doc', 'docx', 'png', 'jpg', 'jpeg',  'gif'];
         $maxsize = 2097152;

         //check if file type is valid
         if (in_array($ext, $allowed))
         {
             // get last record id
             $sql = 'select max(id) as id from tbl_files';
             $result = mysqli_query($con, $sql);
             if (count($result) > 0)
             {
                 $row = mysqli_fetch_array($result);
                 $filename = ($row['id']+1) . '-' . $filename;
             }
             else
                 $filename = '1' . '-' . $filename;

             $created = @date('Y-m-d H:i:s');
             move_uploaded_file($_FILES['file1']['tmp_name'],($path . $filename));

             // insert file details into database
             $sql = "INSERT INTO tbl_files(filename, created) VALUES('$filename', '$created')";
             mysqli_query($con, $sql);
             header("Location: documents.php?st=success");
         }
         else
         {
             header("Location: documents.php?st=error");
         }
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
                            <form action="#" method="post" enctype="multipart/form-data">

                                      <legend>Select File to Upload:</legend>
                   <div class="form-group">
                       <input type="file" name="file1" />
                   </div>

                   <legend>Select Cousre Name:</legend>

                   <div class="form-group">
                           <select class="selectpicker" name="usertype" data-style="btn" data-width="100%" data-border="1px" title="Choose Course" required>
                                     <option value="Coursename">Course Name</option>
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
