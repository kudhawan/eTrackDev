<?php $session = $this->request->session()->read();?>
<html lang="en"><!--<![endif]--><!-- BEGIN HEAD --><head>
<meta charset="utf-8">
<title>Administrator - eTrack</title>

<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<meta content="" name="description">
<meta content="" name="author">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<?php echo $this->Html->css(array('Admin.font-awesome.css', 'Admin.simple-line-icons.css', 'Admin.timepicki.css', 'Admin.bootstrap.css', 'Admin.components.css', 'Admin.layout.css', 'Admin.grey.css', 'Admin.dataTables.bootstrap.css', 'Admin.toastr.min.css','Admin.custom.css')) ?>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="/favicon.ico">
</head>
<body class="page-header-fixed page-quick-sidebar-over-content ">
<!-- BEGIN HEADER -->
	<div class="page-header navbar navbar-fixed-top">
		<!-- BEGIN HEADER INNER -->
		<div class="page-header-inner">
			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<?php echo $this->Html->link('eTrack', '/administrator/users')?>
			</div>
			<!-- END LOGO -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<span class="username username-hide-on-mobile"><?php echo $session['Auth']['User']['name']?></span>
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<?php echo $this->Html->link('<i class="icon-settings"></i> Settings', '/administrator/users/settings', array('escape' => false))?>
							</li>
							<li>
								<?php echo $this->Html->link('<i class="icon-key"></i> Log Out', '/administrator/users/logout', array('escape' => false))?>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END HEADER INNER -->
	</div>
	<!-- END HEADER -->
	<div class="clearfix"></div>
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar-wrapper">
			<div class="page-sidebar navbar-collapse collapse">
				<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
					<!--li class="start <?php echo strtolower($this->request->controller) == 'default' &&  strtolower($this->request->action) == 'dashboard' ? 'active' : '' ?>">
						<?php echo $this->Html->link('<span class="title">Dashboard</span><span class="arrow "></span>', array('controller' => 'default', 'action' => 'dashboard'), array('escape' => false));?>
					</li-->
					<li class="start <?php echo strtolower($this->request->controller) == 'users' ? 'active' : '' ?>">
						<?php echo $this->Html->link('<span class="title">Users</span><span class="arrow "></span>', array('controller' => 'users', 'action' => 'index'), array('escape' => false));?>
					</li>
				</ul>
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div style="min-height:1161px" class="page-content">
				<?php if(isset($session['Flash']['flash']) && count($session['Flash']['flash']) > 0):?>
					<div id="<?php echo ($session['Flash']['flash'][0]['element'] == 'Flash/error') ? 'fl-er' : 'fl-sc';?>" class="Metronic-alerts alert alert-info fade in"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><?php echo $this->Flash->render()?></div>
				<?php endif; ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<!-- END CONTENT -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="page-footer">
		<div class="page-footer-inner"></div>
		<div class="scroll-to-top">
			<i class="icon-arrow-up"></i>
		</div>
	</div>
<span class="select2-hidden-accessible" aria-live="polite" role="status"></span>
<script>var ajax_url = '<?php echo HTTP_ROOT ?>'</script>
<?php echo $this->Html->script(array('Admin.jquery.js', 'Admin.jquery-ui.min.js', 'jquery.validate.min.js', 'Admin.timepicki.js', 'Admin.bootstrap.js', 'Admin.custom.js', 'Admin.toastr.min.js')) ?>
</body><!-- END BODY -->
</html>
