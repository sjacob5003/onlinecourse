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
            <p style="text-align:center;color:red;">Note: Fields marked with (*) are compulsory</p>
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

                       <div id="selection" class="form-group">
                           <label>State</label>
                           <select class="form-control" id="listBox" onchange='selct_district(this.value)'></select>

                           <label>City</label>
                           <select class="form-control" id='secondlist'></select>
                       </div>

                        <label>Pincode * </label>
                        <input type="text" name="spincode" class="form-control" required />

                        <label>Date of Birth * </label>
                        <input type="date" name="sbirth" class="form-control" required />

                        <label>Gender * </label><br>
                        <input type="radio" name="sgender" value="male" checked /> Male &nbsp; &nbsp;
                        <input type="radio" name="sgender" value="female" /> Female <br>

                        <label>Password * </label>
                        <input type="password" name="spass" class="form-control" pattern=".{8,12}" required title="8 to 12 characters" />

                        <label>Confirm Password * </label>
                        <input type="password" name="sconfirmpass" class="form-control" pattern=".{8,12}" required title="8 to 12 characters" />
                        
                        <hr />
                        <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> &nbsp;Register </button>&nbsp;
                        <button type="reset" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-remove-sign"></span> &nbsp;Reset </button>&nbsp;

                        <p style="text-align:center;color:red;font-size:130%">Already registered? <a href="index.php"> <u>Log back in</u> </a></p>

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
    <!-- state dropdown scripts -->
    <script src="assets/js/state.js"></script>
    <script src="assets/js/statejquery.js"></script>

</body>
</html>
