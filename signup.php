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
                     <label>FULL NAME * </label>
                        <input type="text" name="sname" class="form-control" placeholder="ENTER YOUR NAME" required  />

                        <label>EMAIL ID *  </label>
                        <input type="email" name="semail" class="form-control" placeholder="ENTER YOUR EMAIL ID" required />

                        <label>MOBILE NUMBER * </label>
                        <input type="tel" name="smobile" class="form-control" maxlength="10" placeholder="ENTER YOUR MOBILE NO" required />

                        <label>ADDRESS 1 * </label>
                        <input type="text" name="sstreet1" class="form-control" placeholder="ENTER YOUR STREET ADDRESS 1" required />

                        <label>ADDRESS 2 </label>
                        <input type="text" name="sstreet2" class="form-control" placeholder="ENTER YOUR STREET ADDRESS 2" />

                       <div id="selection" class="form-group">
                           <label>STATE</label>
                           <select class="form-control" id="listBox" onchange='selct_district(this.value)'></select>

                           <label>CITY</label>
                           <select class="form-control" id='secondlist'></select>
                       </div>

                        <label>PINCODE * </label>
                        <input type="text" name="spincode" class="form-control" maxlength="6" placeholder="ENTER YOUR PINCODE" required />

                        <label>DATE OF BIRTH * </label>
                        <input type="date" name="sbirth" class="form-control" required />

                        <label>GENDER * </label><br>
                        <input type="radio" name="sgender" value="male" checked /> Male &nbsp; &nbsp;
                        <input type="radio" name="sgender" value="female" /> Female <br>

                        <label>PASSWORD * </label>
                        <input type="password" name="spass" class="form-control" pattern=".{8,12}" placeholder="ENTER PASSWORD" required title="8 to 12 characters" />

                        <label>CONFIRM PASSSWORD * </label>
                        <input type="password" name="sconfirmpass" class="form-control" pattern=".{8,12}" placeholder="CONFIRM PASSWORD" required title="8 to 12 characters" />

                        <hr />
                        <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> &nbsp;Register </button>&nbsp;
                        <button type="reset" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-remove-sign"></span> &nbsp;Reset </button>&nbsp;

                        <p style="text-align:center;color:red;font-size:130%">Already registered? <a href="index.php"> <u>Log in here</u> </a></p>

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
