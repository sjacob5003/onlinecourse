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
  include('../includes/menubar.php');
?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line"><?php echo $_SESSION['username']; ?></h1>
                    </div>
                </div>
                <div class="container">

                      <ul class="nav nav-pills nav-justified">
                        <li class="active"><a data-toggle="pill" href="#personal">Personal Details</a></li>
                        <li><a data-toggle="pill" href="#educational">Educational Details</a></li>
                        <li><a data-toggle="pill" href="#professional">Professional Details</a></li>
                      </ul>

                      <div class="tab-content">

                        <div id="personal" class="tab-pane fade in active">
                          <center><h3>Personal Details</h3></center>
                          <div class="row" >
                            <div class="col-md-3"></div>
                              <div class="col-md-6">
                                <div class="panel panel-default">
                                  <?php $sql=mysqli_query($con, "SELECT * FROM facultytable WHERE FacultyId='".$_SESSION['userid']."'");
                                  while($row=mysqli_fetch_array($sql))
                                  {
                                  ?>
                                      <div class="panel-body">
                                      <form name="FacultyPersonal" id="FacultyPersonal" method="post" enctype="multipart/form-data">
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

                                       <button type="submit" name="submitPersonal" id="submitPersonal" class="btn btn-default" style="width:100%">Save</button>

                                      </form>
                                  </div>
                                  <?php } ?>
                                </div>
                              </div>
                          </div>
                        </div>

                        <div id="educational" class="tab-pane fade">
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
                                                        <?php 
                                                       $sql=mysqli_query($con, "SELECT FacultyEducationalId, FacultyDegreeName, FacultyCollegeName, FacultyPassingYear FROM facultyeducationaltable WHERE FacultyId=".$_SESSION['userid']);
                                                       while ($row=mysqli_fetch_array($sql))
                                                       {
                                                       ?>
                                                         <tr class="info">
                                                             <td><?php echo $row['FacultyDegreeName'] ?></td>
                                                             <td><?php echo $row['FacultyCollegeName'] ?> </td>
                                                             <td><?php echo $row['FacultyPassingYear'] ?> </td>
                                                             <td>
                                                              <button onclick="modifyEdu('<?php echo $row['FacultyEducationalId'].'\',\''.$row['FacultyDegreeName'].'\',\''.$row['FacultyCollegeName'].'\',\''.$row['FacultyPassingYear']; ?>')" id="modifyEdu" class="btn btn-primary">Modify</button>
                                                                 <button onclick="deleteEdu(<?php echo $row['FacultyEducationalId']; ?>)" class="btn btn-danger"><i class="fa fa-book "></i>&nbsp;&nbsp;Delete</button>
                                                             </td>
                                                         </tr>
                                                       <?php
                                                     }
                                                     ?>
                                                       </tbody>                                                       
                                                   </table>
                                         </div>
                                      <form name="FacultyEducational" id="FacultyEducational" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                          <label for="degreename">Degree Name </label>
                                          <input type="text" class="form-control" id="degreename" name="degreename" />
                                        </div>

                                        <div class="form-group">
                                          <label for="universityname">University Name </label>
                                          <input type="text" class="form-control" id="universityname" name="universityname" />
                                        </div>

                                        <div class="form-group">
                                          <label for="passingyear">Passing Year </label>
                                          <input type="number" class="form-control" id="passingyear" name="passingyear" min='1900' max='2018'/>
                                        </div>

                                        <input type="hidden" id="formeduid" name="formeduid" />
                                        <input type="hidden" id="toupdateedu" name="toupdateedu" value="0" />

                                       <button type="submit" name="submitEducational" formtarget="_self" id="submitEducational" class="btn btn-default" style="width:100%">Save</button>

                                      </form>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>

                        <div id="professional" class="tab-pane fade">
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
                                                       <?php 
                                                       $sql=mysqli_query($con, "SELECT FacultyProfessionalId, FacultyJobTitle, FacultyCompanyName, FacultyStartDate, FacultyEndDate FROM facultyprofessionaltable WHERE FacultyId=".$_SESSION['userid']);
                                                       while ($row=mysqli_fetch_array($sql))
                                                       {
                                                       ?>
                                                         <tr class="info">
                                                             <td><?php echo $row['FacultyJobTitle'] ?></td>
                                                             <td><?php echo $row['FacultyCompanyName'] ?></td>
                                                             <td><?php echo $row['FacultyStartDate'] ?></td>
                                                             <td><?php echo $row['FacultyEndDate'] ?></td>
                                                             <td><button onclick="modifyPro('<?php echo $row['FacultyProfessionalId'].'\',\''.$row['FacultyJobTitle'].'\',\''.$row['FacultyCompanyName'].'\',\''.$row['FacultyStartDate'].'\',\''.$row['FacultyEndDate']; ?>')" id="modifyPro" class="btn btn-primary">Modify</button> </a>
                                                                 <button onclick="deletePro(<?php echo $row['FacultyProfessionalId']; ?>)" class="btn btn-danger">Delete</button> </a>
                                                             </td>
                                                         </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                       </tbody>
                                                   </table>
                                         </div>
                                      <form name="FacultyProfessional" id="FacultyProfessional" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                          <label for="jobtitle">Job Title </label>
                                          <input type="text" class="form-control" id="jobtitle" name="jobtitle" />
                                        </div>

                                        <div class="form-group">
                                          <label for="companyname">University / Company </label>
                                          <input type="text" class="form-control" id="companyname" name="companyname" />
                                        </div>

                                        <div class="form-group col-xs-6">
                                          <label for="jobstartdate">Start Date </label>
                                          <input type="date" class="form-control" id="jobstartdate" name="jobstartdate" />
                                        </div>

                                        <div class="form-group col-xs-6">
                                          <label for="jobenddate">End Date </label>
                                          <input type="date" class="form-control" id="jobenddate" name="jobenddate" />
                                        </div>

                                        <input type="hidden" id="formproid" name="formproid" />
                                        <input type="hidden" id="toupdatepro" name="toupdatepro" value="0" />

                                       <button type="submit" name="submitProfessional" id="submitProfessional" class="btn btn-default" style="width:100%">Save</button>

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
    <script type="text/javascript">
      var formType;
      $(function () {        
        $('#FacultyPersonal').on('submit', function (e) {
          e.preventDefault();
          formType="personal";
          $.ajax({
            type: 'post',
            url: 'updateprofile.php',
            data: $('#FacultyPersonal').serialize()+ "&formtype=" + formType,
            success: function (data) {
              alert("data updated");
            },
            error: function(data)
            {
              console.log(data);
            } 
          });
        });
        $('#FacultyEducational').on('submit', function (e) {
          e.preventDefault();
          formType="educational";
          $.ajax({
            type: 'post',
            url: 'updateprofile.php',
            data: $('#FacultyEducational').serialize()+ "&formtype=" + formType,
            success: function (data) {
              alert(data);
            },
            error: function(data)
            {
              alert(data);
            } 
          });

        });
        $('#FacultyProfessional').on('submit', function (e) {
          e.preventDefault();
          formType="professional";
          $.ajax({
            type: 'post',
            url: 'updateprofile.php',
            data: $('#FacultyProfessional').serialize()+ "&formtype=" + formType,
            success: function (data) {
              alert(data);
            },
            error: function(data)
            {
              alert(data);
            } 
          });

        });

      });
      function modifyEdu(id, deg, uniname, passyear) {
        var facultyeduid=parseInt(id);
        var degname=deg;
        var uniname=uniname;
        var passyear=parseInt(passyear);
        document.getElementById("degreename").value=degname;
        document.getElementById("universityname").value=uniname;
        document.getElementById("passingyear").value=passyear;
        document.getElementById("toupdateedu").value="1";
        document.getElementById("formeduid").value=facultyeduid;
      }
      function modifyPro(id, jobname, collegename, jobstart, jobend) {
        var facultyproid=parseInt(id);
        var jobtitle=jobname;
        var companyname=collegename;
        var startdate=jobstart;
        var enddate=jobend;
        document.getElementById("jobtitle").value=jobtitle;
        document.getElementById("companyname").value=companyname;
        document.getElementById("jobstartdate").value=startdate;
        document.getElementById("jobenddate").value=enddate;
        document.getElementById("toupdatepro").value="1";
        document.getElementById("formproid").value=facultyproid;
      }
    </script>
    <script type="text/javascript">
      function deleteEdu(id) {
        var facultyeducationalid=parseInt(id);
        formType="deleteedu";
        var dataString='facultyeduid='+facultyeducationalid+'&formtype='+formType;
          $.ajax({
              type: "POST",
              url: "updateprofile.php",
              data: dataString,
              cache: false,
              success: function(data) {
                alert(data);
              },
              error: function(data) {
                alert(data);
              }
          });
      }
      function deletePro(id) {
        var facultyprofessionalid=parseInt(id);
        formType="deletepro";
        var dataString='facultyproid='+facultyprofessionalid+'&formtype='+formType;
          $.ajax({
              type: "POST",
              url: "updateprofile.php",
              data: dataString,
              cache: false,
              success: function(data) {
                alert(data);
              },
              error: function(data) {
                alert(data);
              }
          });
      }
    </script>
</body>
</html>