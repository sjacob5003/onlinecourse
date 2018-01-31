<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Student Signup</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
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
            <p style="text-align:center;color:red;">Fields marked with (*) are compulsory</p>
            <form name="admin" method="post">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                     <label>Full Name * </label>
                        <input type="text" name="sname" class="form-control" required  />
                        <label>Email Id *  </label>
                        <input type="email" name="semail" class="form-control" required />
                        <label>Mobile Number * </label>
                        <input type="tel" name="smobile" class="form-control" maxlength="10" required />
                        <label>Address (Street 1) * </label>
                        <input type="text" name="sstreet1" class="form-control" required />
                        <label>Address (Street 2)  </label>
                        <input type="text" name="sstreet2" class="form-control"  />
                        <label>City * </label>
                        <input type="text" name="scity" class="form-control" required />
                        <label>State * </label>
                        <input type="text" name="sstate" class="form-control" required />
                        <label>Pincode * </label>
                        <input type="text" name="spincode" class="form-control" required />
                        <label>Date of Birth * </label>
                        <input type="date" name="sbirth" class="form-control" required />
                        <label>Gender * </label><br>
                        <input type="radio" name="sgender" value="male" checked /> Male &nbsp; &nbsp;
                        <input type="radio" name="sgender" value="female" /> Female <br>
                        <label>Password * </label>
                        <input type="password" name="spass" class="form-control" required />
                        <label>Confirm Password * </label>
                        <input type="password" name="sconfirmpass" class="form-control" required />
                        <hr />
                        <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> &nbsp;Register </button>&nbsp;
                        <button type="reset" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-remove-sign"></span> &nbsp;Reset </button>&nbsp;
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
