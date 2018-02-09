<?php
session_start();
include('includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $street1=$_POST['street1'];
    $street2=$_POST['street2'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $pincode=$_POST['pincode'];
    $dob=date('y-m-d',strtotime($_POST['dob']));
    $gender=$_POST['gender'];
    $pass=$_POST['password'];
    $pass1=$_POST['confirmpassword'];
    $email=filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))    
    {
        $_SESSION['errmsg']="Please enter a valid Email ID";
        header("Location:http://$host$uri/signup.php");
        exit();
    }
    elseif($pass!=$pass1)
    {
        $_SESSION['errmsg']="Passwords do not match";
        header("Location:http://$host$uri/signup.php");
        exit();
    }
    else
    {
        $result=mysqli_query($con, "SELECT * FROM studenttable WHERE StudentEmail='$email'");
        if ($result->num_rows > 0)
        {
            $_SESSION['errmsg']="This email ID is already in use";
            header("Location:http://$host$uri/signup.php");
            exit();
        }
        else
        {                
            if(mysqli_query($con, "INSERT INTO studenttable (StudentName,StudentEmail,StudentPassword,StudentPhone,StudentStreet1,StudentStreet2,StudentCity, StudentState, StudentPinCode, StudentGender, StudentDOB) VALUES ('$name','$email','$pass','$phone','$street1','$street2','$city','$state','$pincode','$gender','$dob')"))
            {
                header("Location:http://$host$uri/change-password.php");
                exit();
            }
            else
            {
                $_SESSION['errmsg']="Unable to register";
                header("Location:http://$host$uri/signup.php");
                exit();
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
    <title>Student Signup</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/statestyle.css" rel="stylesheet" />
</head>
<body>
    <?php include('includes/header.php');?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <center><h4 class="page-head-line">Student Registration Form </h4></center>
                </div>
            </div>
            <span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
            <p style="text-align:center;"><strong>Note: Fields marked with (*) are compulsory</strong></p>
            <form name="admin" method="post">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <label for="name">Full Name * </label>
                    <input type="text" name="name" class="form-control" required  />

                    <label for="email">Email Id *  </label>
                    <input type="email" name="email" class="form-control" required />

                    <label for="phone">Mobile Number * </label>
                    <input type="tel" name="phone" class="form-control" maxlength="10" required />

                    <label for="street1">Address (Street 1) * </label>
                    <input type="text" name="street1" class="form-control" required />

                    <label for="street2">Address (Street 2)  </label>
                    <input type="text" name="street2" class="form-control"  />

                   <div id="selection" class="form-group">
                       <label for="state">State</label>
                       <select class="form-control" name="state" id="listBox" onchange='selct_district(this.value)'></select>

                       <label for="city">City</label>
                       <select class="form-control" name="city" id='secondlist'></select>
                   </div>

                    <label for="pincode">Pincode * </label>
                    <input type="text" name="pincode" class="form-control" maxlength="6" required />

                    <label for="dob">Date of Birth * </label>
                    <input type="date" name="dob" class="form-control" required />

                    <label for="gender">Gender * </label><br>
                    <input type="radio" name="gender" value="M" checked /> Male &nbsp; &nbsp;
                    <input type="radio" name="gender" value="F" /> Female <br>

                    <label for="password">Password * </label>
                    <input type="password" name="password" class="form-control" pattern=".{8,12}" required title="8 to 12 characters" />

                    <label for="confirmpassword">Confirm Password * </label>
                    <input type="password" name="confirmpassword" class="form-control" pattern=".{8,12}" required title="8 to 12 characters" />
                    
                    <hr />
                    <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> &nbsp;Register </button>&nbsp;
                    <button type="reset" name="reset" class="btn btn-info"><span class="glyphicon glyphicon-remove-sign"></span> &nbsp;Reset </button>&nbsp;

                    <p style="text-align:center;color:red;font-size:130%">Already registered? <a href="index.php"> <u>Log back in</u> </a></p>

                </div>
                </form>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- state dropdown scripts -->
    <script src="assets/js/state.js"></script>
    <script src="assets/js/statejquery.js"></script>
</body>
</html>