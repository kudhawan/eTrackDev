<?php $session = $this->request->session()->read();?>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.3.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Administrator - TalentQuarry</title>

<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<?php echo $this->Html->css(array('Admin.bootstrap.css', 'Admin.login.css'))?>
<link rel="shortcut icon" href="/favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
	<!--a href="#">
	<img src="http://textmole.com/admin/logo.png" alt=""/>
	</a-->
</div>
<!-- END LOGO -->

<!-- BEGIN LOGIN -->
<div class="content">
	<?php if((isset($session['Flash']['auth']) && count($session['Flash']['auth']) > 0) || (isset($session['Flash']['flash']) && count($session['Flash']['flash']) > 0)):?>
		<div style="text-align: center; color: rgb(255, 112, 101);"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><?php echo $this->Flash->render('auth')?><?php echo $this->Flash->render()?></div>
	<?php endif; ?>
	<!-- BEGIN LOGIN FORM -->
	<form id="UserLoginForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>		<h3 class="form-title">Sign In</h3>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="email"  name="email" required/>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="password"  name="password" required/>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-success uppercase">Login</button>
		</div>
	</form>	<!-- END LOGIN FORM -->
</div>

<!-- END BODY -->
</html><style>div.form, div.index, div.view{border:none;}</style>
