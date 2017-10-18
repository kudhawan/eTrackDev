<body class="login-body-bg">    
	<div class="login-box">
		<div class="login-box-body">
			<div class="logo"><a href="employer-dash.html">e Track</a></div>
			<div class="logo-tagline">Smart Employee</div>
			<div class="login-box-msg">Reset your password</div>
			<?php 
				// $link = $_SERVER['REQUEST_URI'];;
			 //    $link_array = explode('/',$link);
			 //    $token = end($link_array);

			    if(@$_REQUEST['token'] && !empty($_REQUEST['token']))
					$token = $_REQUEST['token'];
					// $token = $_REQUEST['token'];

				 if(@$_REQUEST['id'] && !empty($_REQUEST['id']))
					$id = convert_uudecode(base64_decode($_REQUEST['id']));
					// $id = $_REQUEST['id'];

			?>
			<form id="recover-form" action="<?php echo HTTP_ROOT.'recover.json'?>" method="post">
				<input name="token" type="hidden" value="<?php echo $token ? $token : ''; ?>">
				<input name="id" type="hidden" value="<?php echo $id ? $id : ''; ?>">
				<div class="input-text-box">
					<input class="required" name="new_password" type="password" value="" placeholder="New Password">
				</div>
				<div class="input-text-box">
					<input class="required" name="confirm_password" type="password" value="" placeholder="Confirm Password">
				</div>
				
				<div class="input-text-box"><input type="submit" value="Submit" ></div>
			</form>
		</div>
		<div class="login-footer">e Track Smart Employee <a href="http://www.albertatechworks.com" target="_blank">&copy Alberta Tech Works</a></div>
	</div>	
</body>
