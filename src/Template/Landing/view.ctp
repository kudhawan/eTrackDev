<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Welome to e Track :: Project Management Solutions ::</title>

    <!-- Bootstrap -->
    <link href="<?php echo HTTP_ROOT.'css/bootstrap.css'; ?>" rel="stylesheet">
	<link href="<?php echo HTTP_ROOT.'css/font-awesome.css'; ?>" rel="stylesheet">
	<link href="<?php echo HTTP_ROOT.'css/styleAlberta.css'; ?>" rel="stylesheet">
	<link href="<?php echo HTTP_ROOT.'css/animated-intro.css'; ?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <header>
		<div class="container">
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="land-logo"><a href="http://www.albertatechworks.com/">Alberta TechWorks Inc</a></div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="land-btn">
					<a href="<?php echo HTTP_ROOT; ?>login" class="land-btn-default dblue">Login</a>
					<a href="#" class="land-btn-default">GET STARTED</a>
				</div>
			</div>
		</div>
	</header>
	
	<section class="land-content-bg">
		<div class="container">
			<div class="col-lg-12">
				<div class="land-title"><h2>How it Works?</h2></div>
				<div class="land-desc">
					<p>Our project management software makes it easy to create plans, collaborate with teams and clients, keep things organized and deliver projects on time.</p>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="land-desktop-bg">
					<div id="remove-class" class="animation-outer">
									
									<div id="text-animation" class="conteneur" align="center">
										<div class="css3_div">
										  <img src="<?php echo HTTP_ROOT.'images/alberta/logo-alberta.png'; ?>"/>
											<div class="txtcss">
											  <font style="font-weight:400;font-size: 29px;">Presents</font>
											</div>
										</div>
										<div class="html5_div">
										  <img src="<?php echo HTTP_ROOT.'images/alberta/etrack-logo.png'; ?>"/>
										  <div class="txthtml">
											<font style="font-weight:300;font-size: 45px;">e</font> <font style="font-weight:400;font-size: 45px;">track</font>
											  <br />
											  <font style="font-weight:300; font-size: 18px; color:#3A393A;">smart employee</font>
										  </div>
										</div>
										<div class="trycss">
											<font class="tag-heading" style="">Streamline</font> <font class="tag-heading bold">Workflow</font>
											  <br />
											<font class="tag-line"> Plan. Discuss. Achieve Goals. Succeed.</font>
										</div>
										<div class="shareit">
											<font class="tag-heading"> Simplify </font> <font class="tag-heading bold">Planning</font>
											  <br />
											<font class="tag-line">Plan. Discuss. Achieve Goals. Succeed.</font>
										</div>
										<div class="shareit1">
											<font class="tag-heading"> Enable </font> <font class="tag-heading bold">Collaboration</font>
											  <br />
											<font class="tag-line">Plan. Discuss. Achieve Goals. Succeed.</font>
										</div>
										<div class="click-here">
											<font class="tag-heading"> How </font> <font class="tag-heading bold">it Works</font>
											<br>
											<a id="playVid" href="javascript:void(0);" style="color:#00A0DD;"><font class="tag-line">click here</font></a>
										</div>
									</div>
									
									
									<script>
										document.getElementById('playVid').onclick = function (){
											document.getElementById('video').play();
											document.getElementById("video").style.display = "block";
											document.getElementById("text-animation").style.display = "none";
											document.getElementById("remove-class").className = "animation-outer-reset";
										};
									</script>
									
									<video id="video" loop poster="<?php echo HTTP_ROOT.'images/alberta/loading.jpg'; ?>" style="display:none;" preload="auto">
									  <source src="<?php echo HTTP_ROOT.'images/screen/movie.mp4'; ?>" type="video/mp4">
									  <source src="<?php echo HTTP_ROOT.'images/screen/movie.ogg'; ?>" type="video/ogg">
										Your browser does not support the video tag.
									</video>

					
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="land-newsletter-bg">
		<div class="container">
			<div class="col-lg-12">
				<div class="land-title"><h2>Ready to start delivering projects ! </h2></div>
				<div class="land-subscr-form">
					<form>
						<div class="input-group">
						  <input type="text" class="form-control custom-form" placeholder="Your email address...">
						  <span class="input-group-btn">
							<button class="btn btn-secondary custom-btn" type="button">Get Organized!</button>
						  </span>
						</div>
					</form>
				</div>
				<div class="land-desc">
					<p><span class="fa fa-star"></span>No installation <span class="fa fa-star"></span>No credit card</p>
				</div>
			</div>
		</div>
	</section>
	
	<section class="land-footer">
		<div class="container">
			<div class="col-lg-12">
				<a href="#" class="icon-btn"><img src="<?php echo HTTP_ROOT.'images/alberta/icon-apple.png'; ?>"></a>
				<a href="#" class="icon-btn"><img src="<?php echo HTTP_ROOT.'images/alberta/icon-android.png'; ?>"></a>
			</div>
			<div class="col-lg-12">
				<div class="land-footer-links">
					<ul>
						<li><a href="#">Terms and Conditions</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="#">Blog</a></li>
						<li><a href="#">Our Supporters</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="land-footer-links">
					<ul>
						<li><a href="#"><span class="fa fa-facebook"></span></a></li>
						<li><a href="#"><span class="fa fa-twitter"></span></a></li>
						<li><a href="#"><span class="fa fa-instagram"></span></a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	
	<footer class="land-copy-bg">
		<div class="container">
			<div class="col-lg-12">
				<div>All Rights Reserved &copy; Alberta TechWorks Inc. 2017</div>
			</div>
		</div>
	</footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo HTTP_ROOT.'js/jquery.min.js'; ?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo HTTP_ROOT.'js/bootstrap.min.js'; ?>"></script>
  </body>
</html>