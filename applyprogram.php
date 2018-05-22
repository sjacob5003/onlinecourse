<?php
session_start();
error_reporting(0);
include("includes/config.php");
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if ( $_SESSION['email'] != NULL && $_SESSION['email'] != '')
{
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Apply for program</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <?php include('includes/header.php');
    if($_SESSION['email']!="")
      include('includes/menubar.php');
      ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <center><h4 class="page-head-line">APPLY FOR PROGRAM </h4></center>
                </div>
            </div>
             <span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
            <form name="applyprogram" method="post">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <label>Choose A Program</label>
                        <select class="selectpicker" id="programselector" name="programlist" data-style="btn" data-width="100%" data-border="1px" title="Choose Program" required>
                        <?php
                        $sql = mysqli_query($con, "SELECT programtable.ProgramId, programtable.ProgramName, programtable.AbbreviatedProgName, universitytable.UniversityId, universitytable.UniversityName FROM programofferedtable JOIN programtable ON programofferedtable.ProgramId = programtable.ProgramId JOIN universitytable ON universitytable.UniversityId = programofferedtable.UniversityId GROUP BY programtable.ProgramId");
                        while ($row = mysqli_fetch_array($sql))
                        {
                        ?>
                            <option value=<?php echo $row['ProgramId'] ?> data-uni=<?php echo $row['UniversityId'] ?>><?php echo $row['ProgramName']." (".$row['AbbreviatedProgName'].")  -  ".$row['UniversityName']; ?></option>
                        <?php
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="message"></label>
                    </div>
                    <br>
                    <button type="submit" name="submit" id="submit" class="btn btn-primary displaynone" style="width:100%">Apply </button>

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
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script>
    $(document).ready(function() {
        var reqtype, progid, universityid;
        $('#programselector').on('change', function (){
            universityid = $(this).find(':selected').data('uni');           
            reqtype = 1;
            if ( ! $('.btn-primary').hasClass('displaynone') )
                $('.btn-primary').addClass('displaynone')
            progid = this.value;
            $.ajax({
                type: 'post',
                url: 'applyprogramajax.php',
                data: 'programid=' + progid + '&universityid=' + universityid + '&reqtype=' + reqtype,
                success: function (data) {
                    if (data == 'yes')
                    {                        
                        $('.message').html("You are eligible for this program");
                        $('.btn-primary').removeClass('displaynone')
                    }
                    else
                    {
                        $('.message').html("You do not meet the requirements for this program");
                    }
                }
            });
        });
        $('#submit').on('click', function() {
            reqtype = 2;
            $.ajax({
                type: 'post',
                url: 'applyprogramajax.php',
                data: 'programid=' + progid + '&universityid=' + universityid + '&reqtype=' + reqtype,
                success: function (data) {
                    alert(data);
                }
            });
        });
    });
    </script>
</body>
</html>
<?php
}
else
{
    header("Location:http://$host$uri/index.php");
    exit();
}