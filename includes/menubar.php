<?php
error_reporting(0);
if($_SESSION['email']!="")
{
?>
<section class="menu-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="navbar-collapse collapse ">
          <?php 
          if($_SESSION['usertype']=="Student")
          {
          ?>
            <ul id="menu-top" class="nav navbar-nav navbar-right">
              <li><a href="pincode-verification.php">Enroll for Course </a></li>
              <li><a href="enroll-history.php">Enroll History  </a></li>
              <li><a href="my-profile.php">My Profile</a></li>
              <li><a href="change-password.php">Change Password</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          <?php
          }
          elseif($_SESSION['usertype']=="Faculty")
          {
          ?>
            <ul id="menu-top" class="nav navbar-nav navbar-right">
              <li><a href="<?php $host ?>/onlinecourse/addcourse.php">Add Course </a></li>
              <li><a href="enroll-history.php">View Enrolment</a></li>
              <li><a href="my-profile.php">My Profile</a></li>
              <li><a href="change-password.php">Change Password</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          <?php
          }
          elseif($_SESSION['usertype']=="University")
          {
          ?>
            <ul id="menu-top" class="nav navbar-nav navbar-right">
              <li><a href="pincode-verification.php">Validate Faculty </a></li>
              <li><a href="enroll-history.php">Validate Course</a></li>
              <li><a href="my-profile.php">Update Details</a></li>
              <li><a href="change-password.php">Change Password</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          <?php
          }
          else
          {            
          ?>
            <ul id="menu-top" class="nav navbar-nav navbar-right">
              <li><a href="<?php $host ?>/onlinecourse/admin/index.php">Validate University </a></li>
              <li><a href="enroll-history.php">View Enrolment</a></li>
              <li><a href="change-password.php">Change Password</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>