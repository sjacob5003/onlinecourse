<?php
session_start();
require_once("includes/config.php");
$_SESSION['email'] == "";
$_SESSION['userid'] == "";
$_SESSION['username'] == "";
$_SESSION['usertype'] == "";
session_unset();
?>
<script language="javascript">
document.location="index.php";
</script>
