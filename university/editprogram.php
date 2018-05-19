<?php
session_start();
include('../includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
$progid = $_GET['progid'];
if(strlen($_SESSION['email'])==NULL)
{
  header("Location:http://$host$uri/index.php");
  exit();
}
else
{
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Edit Program</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
<?php include('../includes/header.php');
if($_SESSION['email']!="")
  include('../includes/menubar.php');
?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <center><h1 class="page-head-line">Edit Program</h1></center>
                    </div>
                </div>
                <div class="row" >

         		<div class="col-sm-4 col-sm-offset-1">
                 <div class="list-group" id="list1">
                 <a href="#" class="list-group-item active">Courses Available <input title="toggle all" type="checkbox" class="all pull-right"></a>
                 <?php
                 $sql = mysqli_query($con, "SELECT coursetable.CourseId, coursetable.CourseName, programofferedtable.ProgramId FROM coursetable LEFT JOIN programofferedtable ON coursetable.CourseId = programofferedtable.CourseId AND programofferedtable.ProgramId='$progid'");
                 while($row = mysqli_fetch_array($sql))
                 {
                     if ($row['ProgramId'] == NULL || $row['ProgramId'] == '')
                     {
                 ?>
                 <a href="#" class="list-group-item" data-courseid=<?php echo $row['CourseId'] ?>><?php echo $row['CourseName'] ?><input type="checkbox" class="pull-right"></a>
                 <?php
                     }
                 }
                 ?>
                 </div>
               </div>
               <div class="col-md-2 v-center">
                    <button title="Send to list 2" class="btn btn-default center-block add"><i class="glyphicon glyphicon-chevron-right"></i></button>&nbsp;
                   <button title="Send to list 1" class="btn btn-default center-block remove"><i class="glyphicon glyphicon-chevron-left"></i></button>&nbsp;
               </div>
               <div class="col-sm-4">
           	  <div class="list-group" id="list2">
                 <a href="#" class="list-group-item active">Courses Chosen <input title="toggle all" type="checkbox" class="all pull-right"></a>
                 <?php
                 $sql = mysqli_query($con, "SELECT coursetable.CourseId, coursetable.CourseName, programofferedtable.ProgramId FROM coursetable LEFT JOIN programofferedtable ON coursetable.CourseId = programofferedtable.CourseId AND programofferedtable.ProgramId='$progid'");
                 while($row = mysqli_fetch_array($sql))
                 {
                     if ($row['ProgramId'] != NULL || $row['ProgramId'] != '')
                     {
                 ?>
                 <a href="#" class="list-group-item" data-courseid=<?php echo $row['CourseId'] ?>><?php echo $row['CourseName'] ?> <input type="checkbox" class="pull-right"></a>
                 <?php
                     }
                    } 
                    ?>
                 </div>
               </div>
               <div class="col-md-2 col-md-offset-5">
                    <button type="submit" name="submit" id="submit" style="width:100%" class="btn btn-default">Save</button>
               </div>
        </div>
    </div>
</div>
  <?php include('../includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script>
    var courseids = [];
    $('#submit').on('click', function() {
       var programid = <?php echo $_GET['progid'] ?>;
       var listItems = $('#list2 a:not(:first)');
       $.each(listItems, function (index, item) {
           courseids.push($(item).data('courseid'));
       });
       var dataString='courseids='+JSON.stringify(courseids)+"&programid="+programid;
       $.ajax({
            type: 'post',
            url: 'updatecoursesinprogram.php',
            data: dataString,
            success: function () {
                alert("Successfully updated program");
            }
        });
    });
    $('.add').click(function(){
    $('.all').prop("checked",false);
    var items = $("#list1 input:checked:not('.all')");
    var n = items.length;
    if (n > 0) {
        items.each(function(idx,item){
            var choice = $(item);
            choice.prop("checked",false);
            choice.parent().appendTo("#list2");
        });
    }
    else {
        alert("Choose an item from list 1");
    }
    });

    $('.remove').click(function(){
    $('.all').prop("checked",false);
    var items = $("#list2 input:checked:not('.all')");
        items.each(function(idx,item){
    var choice = $(item);
    choice.prop("checked",false);
    choice.parent().appendTo("#list1");
    });
    });

    /* toggle all checkboxes in group */
    $('.all').click(function(e){
        e.stopPropagation();
        var $this = $(this);
    if($this.is(":checked")) {
        $this.parents('.list-group').find("[type=checkbox]").prop("checked",true);
    }
    else {
        $this.parents('.list-group').find("[type=checkbox]").prop("checked",false);
    $this.prop("checked",false);
    }
    });

    $('[type=checkbox]').click(function(e){
    e.stopPropagation();
    });

    /* toggle checkbox when list group item is clicked */
    $('.list-group a').click(function(e){

    e.stopPropagation();

        var $this = $(this).find("[type=checkbox]");
    if($this.is(":checked")) {
        $this.prop("checked",false);
    }
    else {
        $this.prop("checked",true);
    }

    if ($this.hasClass("all")) {
        $this.trigger('click');
    }
    });
    </script>
</body>
</html>
<?php
}
?>