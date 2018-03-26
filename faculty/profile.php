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
                        <h1 class="page-head-line">Faculty Name</h1>
                    </div>
                </div>
                <div class="container">

                      <ul class="nav nav-pills nav-justified">
                        <li class="active"><a data-toggle="pill" href="#home">Personal Details</a></li>
                        <li><a data-toggle="pill" href="#menu1">Educational Details</a></li>
                        <li><a data-toggle="pill" href="#menu2">Professional Details</a></li>
                      </ul>

                      <div class="tab-content">

                        <div id="home" class="tab-pane fade in active">
                          <center><h3>Personal Details</h3></center>
                          <div class="row" >
                            <div class="col-md-3"></div>
                              <div class="col-md-6">
                                <div class="panel panel-default">
                                      <div class="panel-body">
                                      <form name="dept" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                          <label for="facultyid">Faculty ID   </label>
                                          <input type="text" class="form-control" id="facultyid" name="facultyid" value="<?php echo htmlentities($row['FacultyId']);?>" readonly />
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

                                       <button type="submit" name="submit" id="submit" class="btn btn-default" style="width:100%">Save</button>

                                      </form>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>

                        <div id="menu1" class="tab-pane fade">
                          <center><h3>Educational Details</h3></center>
                          <div class="row" >
                            <div class="col-md-3"></div>
                              <div class="col-md-12">
                                <div class="panel panel-default">
                                      <div class="panel-body">
                                                <div class="table-responsive">
                                                   <table class="table">
                                                       <thead>
                                                           <tr class="bg-danger">
                                                               <th>Degree Name </th>
                                                               <th>University Name </th>
                                                               <th>Passing Year </th>
                                                               <th>Action </th>
                                                           </tr>
                                                       </thead>
                                                       <tbody>
                                                               <tr class="info">
                                                                   <td>value here </td>
                                                                   <td>value here </td>
                                                                   <td>value here </td>
                                                                   <td><button class="btn btn-primary"><i class="fa fa-book "></i>&nbsp;&nbsp;Modify</button> </a>
                                                                       <button class="btn btn-danger"><i class="fa fa-book "></i>&nbsp;&nbsp;Delete</button> </a>
                                                                   </td>
                                                               </tr>
                                                       </tbody>
                                                   </table>
                                         </div>
                                      <form name="dept" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                          <label for="bachelorsdegree">Degree Name </label>
                                          <input type="text" class="form-control" id="facultyid" name="facultyid" value="<?php echo htmlentities($row['FacultyId']);?>" />
                                        </div>

                                        <div class="form-group">
                                          <label for="passing year">University Name </label>
                                          <input type="text" class="form-control" id="facultyname" name="facultyname" value="<?php echo htmlentities($row['FacultyName']);?>"  />
                                        </div>

                                        <div class="form-group">
                                          <label for="mastersdegree">Passing Year </label>
                                          <input type="date" class="form-control" id="facultyname" name="facultyname" value="<?php echo htmlentities($row['FacultyName']);?>"  />
                                        </div>

                                       <button type="submit" name="submit" formtarget="_self" id="submit" class="btn btn-default" style="width:100%">Save</button>

                                      </form>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>

                        <div id="menu2" class="tab-pane fade">
                          <center><h3>Professional Details</h3></center>
                          <div class="row" >
                            <div class="col-md-3"></div>
                              <div class="col-md-12">
                                <div class="panel panel-default">
                                      <div class="panel-body">
                                                <div class="table-responsive table-bordered">
                                                   <table class="table">
                                                       <thead>
                                                           <tr class="bg-danger">
                                                               <th>Job Title </th>
                                                               <th>University/ Company </th>
                                                               <th>Start Date </th>
                                                               <th>End Date </th>
                                                               <th>Action </th>
                                                           </tr>
                                                       </thead>
                                                       <tbody>
                                                               <tr class="info">
                                                                   <td>value here </td>
                                                                   <td>value here </td>
                                                                   <td>value here </td>
                                                                   <td>value here </td>
                                                                   <td><button class="btn btn-primary"><i class="fa fa-book "></i>&nbsp;&nbsp;Modify</button> </a>
                                                                       <button class="btn btn-danger"><i class="fa fa-book "></i>&nbsp;&nbsp;Delete</button> </a>
                                                                   </td>
                                                               </tr>
                                                       </tbody>
                                                   </table>
                                         </div>
                                      <form name="dept" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                          <label for="facultyid">Job Title </label>
                                          <input type="text" class="form-control" id="facultyid" name="facultyid" value="<?php echo htmlentities($row['FacultyId']);?>" />
                                        </div>

                                        <div class="form-group">
                                          <label for="facultyname">University / Company </label>
                                          <input type="text" class="form-control" id="facultyname" name="facultyname" value="<?php echo htmlentities($row['FacultyName']);?>"  />
                                        </div>

                                        <div class="form-group col-xs-6">
                                          <label for="passing year">Start Date </label>
                                          <input type="date" class="form-control" id="facultyname" name="facultyname" value="<?php echo htmlentities($row['FacultyName']);?>"  />
                                        </div>

                                        <div class="form-group col-xs-6">
                                          <label for="passing year">End Date </label>
                                          <input type="date" class="form-control" id="facultyname" name="facultyname" value="<?php echo htmlentities($row['FacultyName']);?>"  />
                                        </div>

                                       <button type="submit" name="submit" id="submit" class="btn btn-default" style="width:100%">Save</button>

                                      </form>
                                  </div>
                                </div>
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

</body>
</html>
