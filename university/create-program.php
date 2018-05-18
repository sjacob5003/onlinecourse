<?php
session_start();
require_once('../includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if(strlen($_SESSION['email']) == 0)
{
  header("Location:http://$host$uri/index.php");
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
	<title>Program Page</title>
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.css" rel="stylesheet" />
	<link href="assets/css/style.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<style type="text/css">
	#regiration_form fieldset:not(:first-of-type) {
		display: none;
	}
  </style>
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
			<div class="col-md-12">
				<center><h1 class="page-head-line">Program</h1></center>
			</div>
		</div>
		<div class="row" >
			<div class="col-md-3"></div>
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="progress" style="height:20px">
	<div class="progress-bar progress-bar-success active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
  <form id="regiration_form" action="action.php"  method="post">
  <fieldset>
	<h3>Step 1: Program Name</h3>
	<div id="selection" class="form-group">
		<select class="selectpicker" name="programselector" id="programselector" data-style="btn" data-width="100%" data-border="1px"  title="Choose Your Program" required >
		<?php
		$sql = mysqli_query($con, "SELECT ProgramName, AbbreviatedProgName FROM programtable");
		while($row = mysqli_fetch_array($sql))
		{
		?>
			<option value=<?php echo $row['AbbreviatedProgName'] ?>><?php echo $row['ProgramName'] ?></option>
		<?php } ?>
		<option value="other">Other</option>
		</select>
	</div>
	<div class="form-group displaynone" id="programinputbox">
		<label for="progname">Specify Degree Name </label>
		<input type="text" class="form-control" placeholder="Your subject" name="progname" value=""/>
	</div>
	<div class="form-group displaynone" id="programabbrinputbox">
		<label for="progabbr">Specify Degree Name </label>
		<input type="text" class="form-control" placeholder="Your subject" name="progabbr" value=""/>
	</div>

	<input type="button" name="nextBtn" style="width:100%" class="next btn btn-default" value="Next" />
  </fieldset>
  <fieldset>
	<h3> Step 2: Select Courses</h3>

<div class="row" >
	<div class="col-md-12">
		<!--    Bordered Table  -->
		<div class="panel panel-default">
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="table-responsive">
					<table id="example" class="table table-striped">
						<thead>
							<tr class="bg-primary">
								<th><input name="select_all" value="1" type="checkbox"></th>
								<th>Course Name </th>
								<th>Faculty Name </th>
							</tr>
						</thead>
						<tbody>
						<?php
						$sql=mysqli_query($con, "SELECT FacultyName, CourseName, CourseId FROM coursetable JOIN facultytable ON coursetable.CourseFacultyId = facultytable.FacultyId");
						while($row=mysqli_fetch_array($sql))
						{
						?>
							<tr>
								<td><?php echo $row['CourseId'] ?></td>
								<td><?php echo $row['CourseName'] ?></td>
								<td><?php echo $row['FacultyName'] ?></td>
							</tr>							
						<?php
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!--  End  Bordered Table  -->
	</div>
</div>

	<input type="button" name="previous" style="width:49%" class="previous btn btn-default" value="Previous" />
	<input type="button" name="submit" style="width:49%" class="btn btn-default sub-ajax" value="Submit" />

  </fieldset>
  </form>
						</div>
					  </div>
					</div>
				</div>
	  </div>
</div>

				<?php include('../includes/footer.php');?>
				  <script src="assets/js/jquery-1.11.1.js"></script>
				  <script src="assets/js/bootstrap.js"></script>
				  <script src="assets/js/bootstrap-select.min.js"></script>
				  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
				  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
				  
				  <script>
				  $(document).ready(function(){
	var current = 1,current_step,next_step,steps;
	steps = $("fieldset").length;
	$(".next").click(function(){
		if( $('#programinputbox').children('input').val() != "" && $('#programabbrinputbox').children('input').val() != "")
		{
			current_step = $(this).parent();
			next_step = $(this).parent().next();
			next_step.show();
			current_step.hide();
			setProgressBar(++current);
		}		
	});
	$(".previous").click(function(){
		current_step = $(this).parent();
		next_step = $(this).parent().prev();
		next_step.show();
		current_step.hide();
		setProgressBar(--current);
	});
	setProgressBar(current);
	// Change progress bar action
	function setProgressBar(curStep){
		var percent = parseFloat(100 / steps) * curStep;
		percent = percent.toFixed();
		$(".progress-bar")
		.css("width",percent+"%")
		.html(percent+"%");
	}
	$('#programselector').on('change', function () {
		var thisElement = $(this);
		var proginput = $('#programinputbox');
		var progabbrinput = $('#programabbrinputbox');
		if ( thisElement.val() == 'other')
		{
			progabbrinput.children('input').val("");
			proginput.children('input').val("");
			proginput.removeClass('displaynone');
			progabbrinput.removeClass('displaynone');
		}
		else
		{
			progabbrinput.children('input').val(thisElement.val());
			proginput.children('input').val(thisElement.find("option:selected").html());
			if(!proginput.hasClass('displaynone') || !progabbrinput.hasClass('displaynone'))
			{
				proginput.addClass('displaynone');
				progabbrinput.addClass('displaynone');
			}
		}
	});
	$('.sub-ajax').on('click', function (e) {
        //   e.preventDefault();
		// console.log($('form').serialize());
        //   $.ajax({
        //     type: 'post',
        //     url: 'manageprogram.php',
        //     data: $('form').serialize(),
        //     success: function () {
        //       alert('Program Created');
        //     }
        //   });
        // });
	});

	function updateDataTableSelectAllCtrl(table)
	{
		var $table             = table.table().node();
		var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
		var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
		var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

		// If none of the checkboxes are checked
		if($chkbox_checked.length === 0)
		{
			chkbox_select_all.checked = false;
			if('indeterminate' in chkbox_select_all)
				chkbox_select_all.indeterminate = false;
		}
		// If all of the checkboxes are checked
		else if ($chkbox_checked.length === $chkbox_all.length)
		{
			chkbox_select_all.checked = true;
			if('indeterminate' in chkbox_select_all)
				chkbox_select_all.indeterminate = false;
		}
		// If some of the checkboxes are checked
		else
		{
			chkbox_select_all.checked = true;
			if('indeterminate' in chkbox_select_all)
				chkbox_select_all.indeterminate = true;
		}
	}

	$(document).ready(function (){
	// Array holding selected row IDs
	
	var rows_selected = [];
	var table = $('#example').DataTable({

		dom: 'Bfrtip',
		buttons: [
		'excel', 'pdf', 'print'
	],

	'columnDefs': [{
		'targets': 0,
		'searchable':false,
		'orderable':false,
		'className': 'dt-body-center',
		'render': function (data, type, full, meta){
			return '<input type="checkbox">';
		}
	}],


	'rowCallback': function(row, data, dataIndex){
		// Get row ID
		var rowId = data[0];

		// If row ID is in the list of selected row IDs
		if($.inArray(rowId, rows_selected) !== -1){
		$(row).find('input[type="checkbox"]').prop('checked', true);
		$(row).addClass('selected');
		}
	}
	});

	// Handle click on checkbox
	$('#example tbody').on('click', 'input[type="checkbox"]', function(e){
	var $row = $(this).closest('tr');
	
	// Get row data
	var data = table.row($row).data();

	// Get row ID
	var rowId = data[0];
	// Determine whether row ID is in the list of selected row IDs
	var index = $.inArray(rowId, rows_selected);

	// If checkbox is checked and row ID is not in list of selected row IDs
	if(this.checked && index === -1){
		rows_selected.push(rowId);

	// Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
	} else if (!this.checked && index !== -1){
		rows_selected.splice(index, 1);
	}

	if(this.checked){
		$row.addClass('selected');
	} else {
		$row.removeClass('selected');
	}

	// Update state of "Select all" control
	updateDataTableSelectAllCtrl(table);

	// Prevent click event from propagating to parent
	e.stopPropagation();
	});

	// Handle click on table cells with checkboxes
$('#example').on('click', 'tbody td, thead th:first-child', function(e){
 $(this).parent().find('input[type="checkbox"]').trigger('click');
});
// Handle click on "Select all" control
$('thead input[name="select_all"]', table.table().container()).on('click', function(e){
 if(this.checked){
     $('tbody input[type="checkbox"]:not(:checked)', table.table().container()).trigger('click');
 } else {
     $('tbody input[type="checkbox"]:checked', table.table().container()).trigger('click');
 }
 // Prevent click event from propagating to parent
 e.stopPropagation();
});
// Handle table draw event
table.on('draw', function(){
 // Update state of "Select all" control
 updateDataTableSelectAllCtrl(table);
});
// Handle form submission event
$('.sub-ajax').on('click', function (e) {
 var form = this;
 // Iterate over all selected checkboxes
 $.each(rows_selected, function(index, rowId){
     // Create a hidden element
     $(form).append(
         $('<input>')
            .attr('type', 'hidden')
            .attr('name', 'id[]')
            .val(rowId)
     );
 });
 console.log($('form').serialize());
          $.ajax({
            type: 'post',
            url: 'manageprogram.php',
            data: $('form').serialize(),
            success: function () {
              alert('Program Created');
            }
          });
        });
 // FOR DEMONSTRATION ONLY
 // Output form data to a console
 $('#example-console').text($(form).serialize());
 console.log("Form submission", $(form).serialize());
 // Remove added elements
 $('input[name="id\[\]"]', form).remove();
});
});
</script>
</body>
</html>
<?php
}
?>