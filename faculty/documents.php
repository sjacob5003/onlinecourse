<?php
session_start();
include('../includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if(strlen($_SESSION['email'])==0)
{
  header("Location:http://$host$uri/index.php");
}
else
{
  if(isset($_POST['submit']))
  {
	//database config for feedback and will be sent to admin
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
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                              <!-- Button trigger modal -->


                              <table class="table" width="80%" border="1">
                                  <tr>
                                  <td>File Name</td>
                                  <td>File Type</td>
                                  <td>File Size(KB)</td>
                                  <td>View</td>
                                  </tr>
                                  <?php
                               $sql="SELECT * FROM uploadtable";
                               $result_set=mysql_query($sql);
                               while($row=mysql_fetch_array($result_set))
                               {
                                ?>
                                      <tr>
                                      <td><?php echo $row['file'] ?></td>
                                      <td><?php echo $row['type'] ?></td>
                                      <td><?php echo $row['size'] ?></td>
                                      <td><a href="uploads/<?php echo $row['file'] ?>" target="_blank">view file</a></td>
                                      </tr>
                                      <?php
                               }
                               ?>
                              </table>


<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="width:100%">
  Upload Document
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <span class="btn btn-primary">
                  <input type="file" class="form-control-file" name="file"/>
        </span>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="btn-upload">Upload</button>

      </div>
    </div>
  </div>
</div>

                          <?php } ?>

                            </form>
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

</body>
</html>
