<?php
session_start();
require_once('../includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if(strlen($_SESSION['userid']) != 0 && $_SESSION['usertype']=='University')
{
  if(isset($_POST['submit']))
  {
    $universityname=$_POST['universityname'];
    $universityemail=$_POST['universityemail'];
    $universityphone=$_POST['universityphone'];
    $universitycontact=$_POST['universitycontact'];
    $universitystreet1 = $_POST['universitystreet1'];
    $universitystreet2 = $_POST['universitystreet2'];
    $universitycity = $_POST['universitycity'];
    $universitystate = $_POST['universitystate'];
    $universitypincode = $_POST['universitypincode'];
    // $photo=$_FILES["photo"]["name"];
    $cgpa=$_POST['cgpa'];
    // move_uploaded_file($_FILES["photo"]["tmp_name"],"studentphoto/".$_FILES["photo"]["name"]);
    $ret=mysqli_query($con,"UPDATE universitytable SET UniversityName='$universityname',
                                                  UniversityEmail='$universityemail',
                                                  UniversityPhone='$universityphone',
                                                  UniversityContactPerson='$universitycontact',
                                                  UniversityStreet1='$universitystreet1',
                                                  UniversityStreet2='$universitystreet2',
                                                  UniversityCity='$universitycity',
                                                  UniversityState='$universitystate',
                                                  UniversityPincode='$universitypincode',
                                                  UniversityUpdationDate=curtime() WHERE UniversityId='".$_SESSION['userid']."'");
    if($ret)
      $_SESSION['msg']="Update success";
    else
      $_SESSION['msg']="Error : Details could not be updated";
    header("Location:http://$host$uri/university-details.php");
    exit();
  }

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>University Information</title>
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
                        <center><h1 class="page-head-line">Details</h1></center>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div class="panel panel-default">
                          <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
                          <?php $sql=mysqli_query($con, "SELECT * FROM universitytable WHERE UniversityId='".$_SESSION['userid']."'");
                          $cnt=1;
                          while($row=mysqli_fetch_array($sql))
                          {
                          ?>
                            <div class="panel-body">
                            <form name="dept" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="universityid">University ID   </label>
                                <input type="text" class="form-control" id="universityid" name="universityid" value="<?php echo htmlentities($row['UniversityId']);?>"  placeholder="University ID" readonly />
                              </div>

                              <div class="form-group">
                                <label for="universityname">University Name  </label>
                                <input type="text" class="form-control" id="universityname" name="universityname" value="<?php echo htmlentities($row['UniversityName']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="universityemail">University Email  </label>
                                <input type="text" class="form-control" id="universityemail" name="universityemail" value="<?php echo htmlentities($row['UniversityEmail']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="universitycontact">Contact Person Name  </label>
                                <input type="text" class="form-control" id="universitycontact" name="universitycontact" value="<?php echo htmlentities($row['UniversityContactPerson']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="universityphone">Contact Person Phone Number  </label>
                                <input type="text" class="form-control" id="universityphone" name="universityphone" value="<?php echo htmlentities($row['UniversityPhone']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="studentstreet1">Address Street 1  </label>
                                <input type="text" class="form-control" id="universitystreet1" name="studentstreet1" value="<?php echo htmlentities($row['UniversityStreet1']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="studentstreet2">Address Street 2  </label>
                                <input type="text" class="form-control" id="universitystreet2" name="studentstreet2" value="<?php echo htmlentities($row['UniversityStreet2']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="studentcity">City  </label>
                                <input type="text" class="form-control" id="universitycity" name="studentcity" value="<?php echo htmlentities($row['UniversityCity']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="studentstate">State  </label>
                                <input type="text" class="form-control" id="universitystate" name="studentstate" value="<?php echo htmlentities($row['UniversityState']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="studentpincode">Pincode  </label>
                                <input type="text" class="form-control" id="universitypincode" name="studentpincode" value="<?php echo htmlentities($row['UniversityPincode']);?>"/>
                              </div>

                          <?php } ?>

                             <button type="submit" name="submit" style="width:100%" id="submit" class="btn btn-default">Update</button>
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
    <script src="assets/js/bootstrap.js"></script>

</body>
</html>
<?php
}
else
{
  header("Location:http://$host/onlinecourse/index.php");
  exit();
}
?>
