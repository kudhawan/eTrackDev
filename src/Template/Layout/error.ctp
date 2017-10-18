<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- SITE TITLE -->
<title>Talent Quarry</title>

<!-- =========================
      FAV AND TOUCH ICONS  
============================== -->
<link rel="icon" href="<?php HTTP_ROOT?>/images/favicon.ico">
<!-- =========================
     STYLESHEETS   
============================== -->
<!-- BOOTSTRAP -->
<link rel="stylesheet" href="<?php echo HTTP_ROOT?>/css/bootstrap.min.css">

<!-- FONT ICONS -->
<link rel="stylesheet" href="<?php echo HTTP_ROOT?>/assets/elegant-icons/style.css">
<link rel="stylesheet" href="<?php echo HTTP_ROOT?>/assets/app-icons/styles.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<!--[if lte IE 7]><script src="lte-ie7.js"></script><![endif]-->

<!-- WEB FONTS -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700|Montserrat' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>


<!-- CAROUSEL AND LIGHTBOX -->
<link rel="stylesheet" href="<?php echo HTTP_ROOT?>/css/owl.theme.css">
<link rel="stylesheet" href="<?php echo HTTP_ROOT?>/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo HTTP_ROOT?>/css/nivo-lightbox.css">
<link rel="stylesheet" href="<?php echo HTTP_ROOT?>/css/nivo_themes/default/default.css">

<!-- ANIMATIONS -->

<link rel="stylesheet" href="<?php echo HTTP_ROOT?>/css/animate.min.css">

<!-- CUSTOM STYLESHEETS -->
<link rel="stylesheet" href="<?php echo HTTP_ROOT?>/css/styles.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


<!-- COLORS -->
<link rel="stylesheet" href="<?php echo HTTP_ROOT?>/css/colors/blue.css"> 
<link rel="stylesheet" href="<?php echo HTTP_ROOT?>/css/toastr.min.css">


<!--[if lt IE 9]>
			<script src="<?php echo HTTP_ROOT?>/js/html5shiv.js"></script>
			<script src="<?php echo HTTP_ROOT?>/js/respond.min.js"></script>
<![endif]-->

<!-- JQUERY -->

</head>

<body>
<?php echo $this->element('header') ?>
<section class="talent-brief">
	<div class="container" id="container">
		<?php echo $this->fetch('content') ?>
	</div>
</section>
<?php echo $this->element('footer') ?>
</body>
</html>
