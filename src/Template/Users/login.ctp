<body class="login-body-bg">  
	<div class="login-box">
		<div class="login-box-body">
			<div class="logo"><a href="employer-dash.html">e Track</a></div>
			<div class="logo-tagline">Smart Employee</div>
			<div class="login-box-msg">Sign in to start your session</div>
			<?php 		
			//echo base64_encode(convert_uuencode($_REQUEST['email']));
			?>
			<form id="login-form" action="<?php echo HTTP_ROOT.'login.json'?>" method="post">
				<div class="input-text-box">
					<input class="required" name="email" type="email" value="" placeholder="E-mail Address">
				</div>
				<div class="input-text-box">
					<input class="required" name="password" type="password" value="" placeholder="Password">
				</div>
				<div class="input-text-box checkbox-algin">
					<div class="checkbox">
					  <label>
						<input type="checkbox" value="">
						<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
						Keep me signed in
					  </label>
					</div>
				</div>
				<div class="input-text-box"><input type="submit" value="Sign in" ></div>
			</form>
			<div class="login-link">
				<a href="#" data-toggle="modal" data-target="#forgotPassword">Forgot password?</a>
			</div>
			<div class="login-link" id="accEmail">Do not have an account <a href="#" data-toggle="modal" id="createAcc" data-target="#createAccount">Create An Account</a>
			</div>

		</div>
		<div class="login-footer">e Track Smart Employee <a href="http://www.albertatechworks.com" target="_blank">&copy Alberta Tech Works</a></div>
	</div>	
</body>
