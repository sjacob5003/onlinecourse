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
              <li><a href="<?php $host ?>/onlinecourse/enrolhistory.php">Enroll History  </a></li>
              <li><a href="<?php $host ?>/onlinecourse/deregister.php">Deregister </a></li>
              <li><a href="<?php $host ?>/onlinecourse/applyprogram.php">Apply Program </a></li>
              <li><a href="<?php $host ?>/onlinecourse/my-profile.php">My Profile</a></li>
              <li><a href="<?php $host ?>/onlinecourse/viewdocuments.php">Documents</a></li>
              <li><a href="<?php $host ?>/onlinecourse/feedback.php">Feedback</a></li>
              <li><a href="<?php $host ?>/onlinecourse/change-password.php">Change Password</a></li>
              <li><a href="<?php $host ?>/onlinecourse/logout.php">Logout</a></li>
            </ul>
          <?php
          }
          elseif($_SESSION['usertype']=="Faculty")
          {
          ?>
            <ul id="menu-top" class="nav navbar-nav navbar-right">
              <li><a href="<?php $host ?>/onlinecourse/faculty/addcourse.php">Add Course </a></li>
              <li><a href="<?php $host ?>/onlinecourse/faculty/viewcourses.php">Your Courses</a></li>
              <li><a href="<?php $host ?>/onlinecourse/faculty/profile.php">My Profile</a></li>
              <li><a href="<?php $host ?>/onlinecourse/faculty/documents.php">Documents</a></li>
              <li><a href="<?php $host ?>/onlinecourse/faculty/reviews.php">View Feedback</a></li>
              <li><a href="<?php $host ?>/onlinecourse/change-password.php">Change Password</a></li>
              <li><a href="<?php $host ?>/onlinecourse/logout.php">Logout</a></li>
            </ul>
          <?php
          }
          elseif($_SESSION['usertype']=="University")
          {
          ?>
            <ul id="menu-top" class="nav navbar-nav navbar-right">
              <li><a href="<?php $host ?>/onlinecourse/university/validatefaculty.php">Validate Faculty </a></li>
              <li><a href="<?php $host ?>/onlinecourse/university/program.php">Manage Programs</a></li>
              <li><a href="<?php $host ?>/onlinecourse/university/university-details.php">Update Details</a></li>
              <li><a href="<?php $host ?>/onlinecourse/change-password.php">Change Password</a></li>
              <li><a href="<?php $host ?>/onlinecourse/logout.php">Logout</a></li>
            </ul>
          <?php
          }
          else
          {
          ?>
            <ul id="menu-top" class="nav navbar-nav navbar-right">
              <li><a href="<?php $host ?>/onlinecourse/admin/validateuniversity.php">Validate University </a></li>
              <li><a href="<?php $host ?>/onlinecourse/admin/reviews.php">View Feedback</a></li>
              <li><a href="<?php $host ?>/onlinecourse/change-password.php">Change Password</a></li>
              <li><a href="<?php $host ?>/onlinecourse/logout.php">Logout</a></li>
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
