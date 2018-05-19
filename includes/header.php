<head>
          <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
          <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
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
            <strong>Welcome: <?php echo htmlentities($_SESSION['username']);?>&nbsp;&nbsp;</strong>
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

                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            <a class="navbar-brand" href="<?php $host ?>/onlinecourse/index.php" style="color:#fff; font-size:24px;4px; line-height:30px; ">
               THE OPEN - SCHOOL
            </a>

        </div>

        <div class="left-div">
            <IMG SRC="logo.png" ALT="some error" WIDTH=80 HEIGHT=80>
        </div>
    </div>
</div>
