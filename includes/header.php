<?php
include("includes/config.php");
error_reporting(0);
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
?>
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                if($_SESSION['email']!="")
                {
                ?>
                    <strong>Welcome: </strong><?php echo htmlentities($_SESSION['username']);?>&nbsp;&nbsp;
                <?php
                }
                else
                {
                    ?>
                 <a href="studentsignup.php"><font color="ffffff" size="4px">Signup</font></a> | <a href="studentlogin.php"><font color="ffffff" size="4px">Login</font></a>
                <?php } ?>
            </div>
        </div>
    </div>
</header>

<!-- HEADER END-->
<div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="color:#fff; font-size:24px;4px; line-height:24px; ">

               Online Course Registration
            </a>

        </div>

        <div class="left-div">
            <i class="fa fa-user-plus login-icon" ></i>
        </div>
    </div>
</div>
