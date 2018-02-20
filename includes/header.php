<?php
include("includes/config.php");
error_reporting(0);
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
?>
<header>
    <div class="container">

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

                    <div class="dropdown" style="float:right">
       <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Signup
       <span class="caret"></span></button>
       <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="menu1">
         <li role="presentation"><a role="menuitem" tabindex="-1" href="studentsignup.php">Student Signup</a></li>
         <li role="presentation"><a role="menuitem" tabindex="-1" href="facultysignup.php">Faculty Signup</a></li>
         <li role="presentation"><a role="menuitem" tabindex="-1" href="universitysignup.php">University Signup</a></li>
                    </ul></div>

                <?php } ?>
                <div class="dropdown" style="float:right">
         <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Login
         <span class="caret"></span></button>
         <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="menu1">
           <li role="presentation"><a role="menuitem" tabindex="-1" href="studentlogin.php">Student Login</a></li>
           <li role="presentation"><a role="menuitem" tabindex="-1" href="facultylogin.php">Faulty Login</a></li>
           <li role="presentation"><a role="menuitem" tabindex="-1" href="universitylogin.php">University Login</a></li>
           <li role="presentation"><a role="menuitem" tabindex="-1" href="admin/adminlogin.php">Admin Login</a></li>
         </ul>
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
