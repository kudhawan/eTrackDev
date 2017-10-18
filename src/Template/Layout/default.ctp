<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <link rel="shortcut icon" href="<?php echo HTTP_ROOT.'images/shortcut-icon.png'?>">	
		<title>eTrack</title>
		<?php echo $this->Html->css([
									'bootstrap.css',
									'bootstrap-datepicker',
									'font-awesome.css',
									'toastr.min.css', 
									'jquery.datetimepicker.css',
									'style.css','chosen.css','jquery.jqChart.css','jquery.jqRangeSlider.css','jquery-ui-1.10.4.css','jquerysctipttop.css','TableBarChart.css','visualize.css','custom.css'
								]);
				if(($this->request->controller == 'Projects' || $this->request->controller == 'Dashboard') && ($this->request->action == 'view')):
					echo $this->Html->css([
											'amchart/export.css'
										]);
		 		endif; 
				
				if(($this->request->controller == 'Activity') && ($this->request->action == 'screenshotCreate')):
					echo $this->Html->css([
											'dropzone.css'
										]);
		 		endif; 
		?>
	<script>var ajax_url = '<?php echo HTTP_ROOT; ?>',currentUserId = '<?php echo (isset($authUser)) ? $authUser['id'] : ''; ?>'</script>
	<?php 
	 	echo $this->Html->script([
								'jquery-1.11.1.min.js','jquery.min.js',
								'bootstrap.min.js',
								'editor.js', 'bootstrap-datepicker.js',
								'jquery.form.js',
								'jquery.validate.min.js',
								'toastr.min.js',
								'jquery.datetimepicker.js',
								'custom.js?v=1',
								'chosen.jquery.js',
								'jquery.canvasjs.min.js','jquery.mousewheel.js','jquery.jqChart.min.js','jquery.jqRangeSlider.min.js','prettify.js','excanvas.js','pie-chart.js','donut-pie-chart','TableBarChart.js','jquery.highchartTable-min.js','visualize.jQuery.js'

							]);
	?>
	</head>
	<?php echo $this->fetch('content');
	
	if($this->request->controller == 'Users' && $this->request->action == 'login'):
	?>

		
	<!-- Forgot Password Modal -->
	<div class="modal fade-scale" id="forgotPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Forgot password</h4>
		  </div>
		  <?= $this->Form->create(null, array('id'=>'forget-form', 'action'=>'forgotPassword.json')) ?>
		  <div class="modal-body">
			<div class="input-text-box">
				<input type="email" required name="email" placeholder="E-mail Address">
			</div>
			<div class="input-text-box">
				<input type="submit" value="Submit" class="pbtn l-width">
			</div>
		  </div>
		  <?= $this->Form->end()?>
		  <div class="modal-footer">
			<div class="login-link">enter your email address to reset your password, <a href="<?php echo HTTP_ROOT?>" >Already Member click here</a></div>
		  </div>
		</div>
	  </div>
	</div>
	
	<!-- Create an account Modal -->
		<?php   
		  		$token = $email = $designation = $projects = $employer_id = '';
				
		  			if(@$_REQUEST['email']):
						$email = convert_uudecode(base64_decode($_REQUEST['email']));
					endif;
		  			if(@$_REQUEST['token']):
						$token = convert_uudecode(base64_decode($_REQUEST['token']));
					endif;
			?>

	<div class="modal fade-scale" id="createAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Create New Account</h4>
		  </div>
		  <?= $this->Form->create(null, array('id'=>'register-form', 'action'=>'register.json')) ?>
		  <div class="modal-body">
		  <input type="hidden" name="employer_id" value="<?php echo $employer_id ? $employer_id : '' ?>">
		  <input type="hidden" name="designation_id" value="<?php echo $designation ? $designation : '' ?>">
		  <input type="hidden" name="position" value="<?php echo $position ? $position : '' ?>">
		  <input type="hidden" name="projects" value="<?php echo $projects ? $projects : ''?>">
		  <input type="hidden" name="is_employer" value="<?php echo $email ? 0 : 1 ?>">
			<div class="input-text-box">
				<input required type="text" name="name" value="" placeholder="Name">
			</div>
			<div class="input-text-box">
				<input required  type="email" name="email" value="<?php echo !empty($email) ? $email :'' ?>" <?php echo !empty($email) ? 'readonly' : ''?> placeholder="E-mail Address">
			</div>
			<div class="input-text-box">
				<input required type="text" name="phone" placeholder="Phone">
			</div>
			<div class="input-text-box">
				<input required type="password" name="password" placeholder="Password">
			</div>
			<div class="input-text-box">
				<input required type="password" name="confirm" placeholder="Repeat Password">
			</div>
			<div class="input-text-box">
				<input name="token" type="hidden" value="<?php echo !empty($token) ? $token :'' ?>">
				<input type="submit" value="Signup" class="pbtn l-width" >
			</div>
		  </div>
		  <?= $this->Form->end() ?>
		  <div class="modal-footer">
			<div class="login-link">Already have an account? <a href="<?php echo HTTP_ROOT.'Users/login'?>">Log into Account </a></div>
		  </div>
		</div>
	  </div>
	</div>

	<?php else:
		echo $this->element('chatTemplate');
	endif;
	if($this->request->controller == 'Employers' && $this->request->action == 'view'):
	?>
	<!-- Invite Members Modal -->
	<div class="modal fade-scale" id="invite-members" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="overflow:hidden;">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Invite Members</h4>
		  </div>
           <?= $this->Form->create(null, array('id'=>'inviteMem', 'action'=>'inviteMembers.json')) ?>
           
		<!--<form  id="inviteMem" action="<?php //echo HTTP_ROOT.'Employers/inviteMembers.json'?>">-->
		  <div class="modal-body">
			<div class="ui-form">
				<label>Email</label>
					<input type="email" name="email" placeholder="e.g: admin@albertatechworks.com" class="required">
				<!-- <label>Email</label><textarea> e.g: admin@albertatechworks.com, </textarea> -->
			</div>
			<div class="ui-form"><label>Role</label>
				<select  name="designation_id" class="required designation_id">
					<option value="">-- Select --</option>
					<?php foreach($getDesignations as $designation => $value):?>
						<option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
					<?php endforeach;?>
				</select>
			</div>
			<div class="ui-form">
				<label>Projects</label>
				<select class="chosen  projectList required" multiple="true">
						<!-- <option value="">Choose...</option> -->
					<?php foreach($userProjects as $key => $val):?>
						<option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
					<?php endforeach;?>
				</select>
				<input type="hidden" value="" name="projects" class="projects">
				<!-- <div class="textarea-box"><span>CWBanks</span> <span>ETrack</span></div> -->
			</div>
		  </div>
		
		  <div class="modal-footer">
			<div class="login-link">
				<!--<a class="btn corner blue" style="color:white" onclick="window.location.href = 'members'"><span class="fa fa-trash"></span> Cancel</a>-->
				<button type="button" class="btn corner" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cancel</span></button>
				<button type="submit" class="btn corner blue getProjects"><span class="fa fa-send"></span> Send</button>
			</div>
		  </div>
		 <!-- </form>-->
          <?= $this->Form->end() ?>
		</div>
	  </div>
	</div>


	<?php endif;
	if($this->request->controller == 'Projects' && $this->request->action == 'view'):
	?>
	<!-- Project Details Modal -->
	<div class="modal fade" id="project-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Project Details</h4>
		  </div>
		  <div class="modal-body">
			<div id="chart-view">
				<center> Please select any one project to view chart. </center>
			</div>
		  </div>
		
		  <div class="modal-footer">
			<div class="login-link">
				<!--<a class="btn corner blue" style="color:white" onclick="window.location.href = 'members'"><span class="fa fa-trash"></span> Cancel</a>-->
				<button type="button" class="btn corner" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span></button>
			</div>
		  </div>
		</div>
	  </div>
	</div>


	<?php endif; ?>
    
    <!--create  accounts/clients-->
    <div class="modal fade-scale" id="createclientAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Create New Account</h4>
		  </div>
		  <?= $this->Form->create(null, array('id'=>'register-form', 'action'=>'register.json')) ?>
		  <div class="modal-body">
		  <input type="hidden" name="employer_id" value="<?php echo $employer_id ? $employer_id : '' ?>">
		  <input type="hidden" name="designation_id" value="<?php echo $designation ? $designation : '' ?>">
		  <input type="hidden" name="position" value="<?php echo $position ? $position : '' ?>">
		  <input type="hidden" name="projects" value="<?php echo $projects ? $projects : ''?>">
		  <input type="hidden" name="is_employer" value="<?php echo $email ? 0 : 1 ?>">
			<div class="input-text-box">
				<input required type="text" name="name" value="" placeholder="Name">
			</div>
			<div class="input-text-box">
				<input required  type="email" name="email" value="<?php echo !empty($email) ? $email :'' ?>" <?php echo !empty($email) ? 'readonly' : ''?> placeholder="E-mail Address">
			</div>
			<div class="input-text-box">
				<input required type="text" name="phone" placeholder="Phone">
			</div>
			<div class="input-text-box">
				<input required type="password" name="password" placeholder="Password">
			</div>
			<div class="input-text-box">
				<input required type="password" name="confirm" placeholder="Repeat Password">
			</div>
			<div class="input-text-box">
				<input name="token" type="hidden" value="<?php echo !empty($token) ? $token :'' ?>">
				<input type="submit" value="Signup" class="pbtn l-width" >
			</div>
		  </div>
		  <?= $this->Form->end() ?>
		 
		</div>
	  </div>
	</div>
    
    
    
    <div class="modal fade" id="screenshot-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			
		  </div>
		  <div class="modal-body">
			<div id="screenshot-view">
				<center> Please select any one project to view chart. </center>
			</div>
		  </div>
		
		  
		</div>
	  </div>
	</div>
	
	
	<!-- Common Modal -->
	<div class="modal fade" id="common-modal-detail" tabindex="-1" role="dialog" aria-labelledby="common-modalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="common-modalLabel">Project Details</h4>
		  </div>
		  <div class="modal-body">
			<div id="common-modal-view">
				<center> Loading... </center>
			</div>
		  </div>
		
		  <div class="modal-footer">
				<button type="button" class="btn corner" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span></button>
		  </div>
		</div>
	  </div>
	</div>

<!-- Change Password Modal -->
	<div class="modal fade-scale" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="overflow:hidden;">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Change Password</h4>
		  </div>
		<form method="POST" id="change-password" action="<?php echo HTTP_ROOT.'Users/changePassword.json'?>">
		  <div class="modal-body">
			<div class="ui-form">
				<label>Old password</label>

					<input class="required" type="password" name="old_password" placeholder="Old Password">
			</div>
			<div class="ui-form">
				<label>New password</label>
					<input class="required" type="password" name="new_password" placeholder="New Password">
			</div>
			<div class="ui-form">
				<label>Confirm password</label>
					<input class="required" type="password" name="confirm_password"placeholder="Confirm Password">
			</div>
		  </div>
		
		  <div class="modal-footer">
			<div class="login-link">
				<a class="btn corner blue" style="color:white" href = 'dashboard'><span class="fa fa-trash"></span> Cancel</a>
				<button type="submit" class="btn corner blue"><span class="fa fa-send"></span> Update</button>
			</div>
		  </div>
		  </form>
		</div>
	  </div>
	</div>

	
	
	<?php 
	?>
	 <?php if(($this->request->controller == 'Projects' || $this->request->controller == 'Dashboard') && ($this->request->action == 'view')):
				echo $this->Html->script([
										'amchart/amcharts.js',
										'amchart/serial.js',
										'amchart/export.min.js',
										'amchart/light.js'
									]);
	 endif;
	 	
	if(($this->request->controller == 'Activity') && ($this->request->action == 'screenshotCreate')):
		echo $this->Html->script([
								'dropzone.js'
							]); ?>
		
        <script>
		Dropzone.options.dropzoneFileForm = {
			addRemoveLinks: true,
			dictRemoveFileConfirmation: 'Do you want to remove this file..?',
			autoProcessQueue: false, // this is important as you dont want form to be submitted unless you have clicked the submit button
			autoDiscover: false,
			paramName: "upload_file", // The name that will be used to transfer the file
			previewsContainer: '#dropzonePreview',
			uploadMultiple: true,
			parallelUploads: 20,
			maxFiles: 20,
			//clickable: false,
			dictDefaultMessage: '',
			acceptedFiles: 'image/*',
			maxFilesize: 2, // MB
			error: function(file, msg){
				showFlashMsg(msg, 'error');
				this.removeFile(file);
			},

			init: function() {
				var myDropzone = this;
				//now we will submit the form when the button is clicked
				$('#dropzoneFileForm').validate();
				$("#dropzoneFileForm").on('submit',function(e) {
					e.preventDefault();
					if(($(this).find('.required').length && $(this).find('.required').val() != '') || $(this).find('.required').length == 0){
						myDropzone.processQueue(); // this will submit your form to the specified action path
						// after this, your whole form will get submitted with all the inputs + your files and the php code will remain as usual 
						//REMEMBER you DON'T have to call ajax or anything by yourself, dropzone will take care of that
						myDropzone.on("error", function (file, responseText) {
							showFlashMsg(file.name+' something went wrong.', 'error');
						});
						myDropzone.on("successmultiple", function (file, response) {
							//alert(response.message);
							//alert(response.url);
							showFlashMsg(response.message);
							setTimeout(function(){
								location.href = ajax_url + response.url;
							}, 2000);
						});
					}
				});
			} // init end
		};
		</script>
	<?php endif; 
				 ?>
	<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
	
	$("#notification").popover({
	  'title' : 'New Notification', 
	  'html' : true,
	  'placement' : 'top',
	  'content' : $(".alert_list").html()
	});
	
	$(function () {
		$("[data-toggle='tooltip']").tooltip();
		$("[data-tooltip='tooltip']").tooltip();
	});
	
	$(document).ready( function() {
		//$("#txtEditor").Editor();                   
	});

	$('.datepicker').datepicker();
   
   	
	$('.datetimepicker').datetimepicker({
		step:5,
	});
	$('.rangedatetimepicker').find('#statt_date').datetimepicker({
	});
	$('.rangedatetimepicker').find('#end_date').datetimepicker({
	});
	$('#end_date').change(function() {
    
		$('#statt_date').datetimepicker({
			maxDate: $('#end_date').val() // when the end time changes, update the maxDate on the start field
		});
	});
	$('#statt_date').change(function() {
		$('#end_date').datetimepicker({
			minDate: $('#statt_date').val() // when the start time changes, update the minDate on the end field
		});
	});
	

	$('#submit_member').on('click',function(){
		alert("here");
		// $('#add_member').submit();
	});
	
	
    </script>
		
</html>