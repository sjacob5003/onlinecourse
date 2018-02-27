<?php
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
          <a href="<?php $host ?>/onlinecourse/login.php"><button class="btn btn-default"><span class="glyphicon glyphicon-log-in"></span> &nbsp;LOGIN</button></a>
          <a href="<?php $host ?>/onlinecourse/signup.php"><button class="btn btn-default"><span class="glyphicon glyphicon-user"></span> &nbsp;SIGNUP</button></a>
        <?php } ?>
          
   </div>
</header>

<!-- HEADER END-->
<div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand" href="<?php $host ?>/onlinecourse/index.php" style="color:#fff; font-size:24px;4px; line-height:30px; ">

               Course Registration
            </a>

        </div>

        <div class="left-div">
            <i class="fa fa-user-plus login-icon" ></i>
        </div>
    </div>
</div>