<?php
session_start();
require_once('../includes/config.php');
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
    $facultyname=$_POST['facultyname'];
    $facultyemail=$_POST['facultyemail'];
    $facultyphone=$_POST['facultyphone'];
    $facultydob=$_POST['facultydob'];
    $facultystreet1=$_POST['facultystreet1'];
    $facultystreet2=$_POST['facultystreet2'];
    $facultycity=$_POST['facultycity'];
    $facultystate=$_POST['facultystate'];
    $facultypincode=$_POST['facultypincode'];
    // $photo=$_FILES["photo"]["name"];
    $cgpa=$_POST['cgpa'];
    // move_uploaded_file($_FILES["photo"]["tmp_name"],"studentphoto/".$_FILES["photo"]["name"]);
    $ret=mysqli_query($con,"UPDATE facultytable SET FacultyName='$facultyname',
                                                  FacultyEmail='$facultyemail',
                                                  FacultyPhone='$facultyphone',
                                                  FacultyDOB='$facultydob',
                                                  FacultyStreet1='$facultystreet1',
                                                  FacultyStreet2='$facultystreet2',
                                                  FacultyCity='$facultycity',
                                                  FacultyState='$facultystate',
                                                  FacultyPinCode='$facultypincode',
                                                  UniversityUpdationDate=curtime() WHERE UniversityId='".$_SESSION['userid']."'");
    if($ret)
      $_SESSION['msg']="Profile Updated Successfully!";
    else
      $_SESSION['msg']="Error : Your Profile could not be updated";
    header("Location:http://$host$uri/faculty-profile.php");
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
    <title>Faculty Profile</title>
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
                    <div class="col-md-12">
                        <h1 class="page-head-line">My Profile</h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div class="panel panel-default">
                          <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
                          <?php $sql=mysqli_query($con, "SELECT * FROM facultytable WHERE FacultyId='".$_SESSION['userid']."'");
                          $cnt=1;
                          while($row=mysqli_fetch_array($sql))
                          {
                          ?>
                            <div class="panel-body">
                            <form name="dept" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="facultyid">Faculty ID   </label>
                                <input type="text" class="form-control" id="facultyid" name="facultyid" value="<?php echo htmlentities($row['FacultyId']);?>"  placeholder="Student Reg no" readonly />
                              </div>

                              <div class="form-group">
                                <label for="facultyname">Name  </label>
                                <input type="text" class="form-control" id="facultyname" name="facultyname" value="<?php echo htmlentities($row['FacultyName']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="facultyemail">Email  </label>
                                <input type="text" class="form-control" id="facultyemail" name="facultyemail" value="<?php echo htmlentities($row['FacultyEmail']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="facultyphone">Phone number  </label>
                                <input type="text" class="form-control" id="facultyphone" name="facultyphone" value="<?php echo htmlentities($row['FacultyPhone']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="facultydob">Date of Birth </label>
                                <input type="date" class="form-control" id="facultydob" name="facultydob" value="<?php echo htmlentities($row['FacultyDOB']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="facultystreet1">Address Street 1  </label>
                                <input type="text" class="form-control" id="facultystreet1" name="facultystreet1" value="<?php echo htmlentities($row['FacultyStreet1']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="facultystreet2">Address Street 2  </label>
                                <input type="text" class="form-control" id="facultystreet2" name="facultystreet2" value="<?php echo htmlentities($row['FacultyStreet2']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="facultycity">City  </label>
                                <input type="text" class="form-control" id="facultycity" name="facultycity" value="<?php echo htmlentities($row['FacultyCity']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="facultystate">State  </label>
                                <input type="text" class="form-control" id="facultystate" name="facultystate" value="<?php echo htmlentities($row['FacultyState']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="facultypincode">Pincode  </label>
                                <input type="text" class="form-control" id="facultypincode" name="facultypincode" value="<?php echo htmlentities($row['FacultyPincode']);?>" required />
                              </div>

                              <!-- <div class="form-group">
                                <label for="Pincode">Student Photo  </label>
                               <?php if($row['studentPhoto']==""){ ?>
                               <img src="studentphoto/noimage.png" width="200" height="200"><?php } else {?>
                               <img src="studentphoto/<?php echo htmlentities($row['studentPhoto']);?>" width="200" height="200">
                               <?php } ?>
                              </div>

                              <div class="form-group">
                                <label for="Pincode">Upload New Photo  </label>
                                <input type="file" class="form-control" id="photo" name="photo"  value="<?php echo htmlentities($row['studentPhoto']);?>" />
                              </div> -->

                          <?php } ?>

                             <button type="submit" name="submit" id="submit" class="btn btn-default">Update</button>
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
<?php } ?>
