<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>

		<!-- Mobile Specifi Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Dropit</title>
		<meta name="description" content="Save everything you read on the web!" />
		<meta name="keywords" content="dropit, drop, it, save, posts, articles, news" />
		<meta name="author" content="Pablo Rivera" />
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/default.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/multilevelmenu.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/component.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/animations.css" />
		<script src="<?php echo base_url(); ?>assets/js/modernizr.custom.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
	</head>
	<div id="login">
	    <div id="login-div">
	    <?php

	    echo form_open('main/login_validation');

	    $username = array(
	    	'name' => 'username',
	    	'id' => 'username_input',
	    	'value' => $this->input->post('username'),
	    	'placeholder' => 'Username'
	    	);

	    echo "<div id='username'>";
	    echo form_input($username);
	    echo "</div>";

	    $password = array(
	    	'name' => 'password',
	    	'id' => 'password_input',
	    	'placeholder' => 'Password'
	    	);

	    echo "<div id='password'>";
	    echo form_password($password);
	    echo "</div>";

        $submit = array(
        	'name' => 'login_submit',
        	'id' => 'submit_type',
        	'value' => 'Log In',
        	);

	    echo "<div id='submit'><p>";
	    echo form_submit($submit);
	    echo "</p></div>";

	    echo validation_errors();

	    echo form_close();

	    ?>
	    </div>
	</div>
	    <div class="pt-triggers">
		    <button onclick="location.href='<?php echo base_url()?>main/signup'" id="signUp" class="pt-touch-button">Sign Up!</button>
		</div>
		<div id="pt-main" class="pt-perspective">
			<div class="pt-page pt-page-1">
			   <div id="logo">
			        <div id="logo_image">
			    	    <img src="<?php echo base_url()?>assets/img/logo.png">
			    	</div>
			    	<div id="logo_text">
			    		<h1>Droppit</h1>
			    	</div>		    	
			   </div>
			   <h2>Save all the stuff you find on the <br/>Web</h2>
			</div>
			<div class="pt-page pt-page-2">
				<h2>The easiest way to build your own online archive of the stuff you like</h2>
			</div>
			<div class="pt-page pt-page-3">
				<h2>Real simple</h2>
			</div>
			<div class="pt-page pt-page-4">
				<h2>When you find something you like on the web</h2>
			</div>
			<div class="pt-page pt-page-5">
				<h2>Copy the URL on your browser</h2>
			</div>
			<div class="pt-page pt-page-6">
				<h2>And paste it here:</h2>
				<div>
					<img src="<?php echo base_url(); ?>/assets/img/add_intro.png">
				</div>
			</div>
			<div class="pt-page pt-page-7">
				<h2>The information will be stored on your profile</h2>
			</div>
			<div class="pt-page pt-page-8">
				<h2>Like this:</h2>
			</div>
			<div class="pt-page pt-page-9">
				<div>
					<img src="<?php echo base_url();?>/assets/img/intro1.png"/>
				</div>
				<div>
					<img src="<?php echo base_url();?>/assets/img/intro2.png"/>
				</div>
				<div>
					<img src="<?php echo base_url();?>/assets/img/intro3.png"/>
				</div>
			</div>
			<div class="pt-page pt-page-10">
				<h2>That's it!</h2>
			</div>
			<div class="pt-page pt-page-11">
				<h2>Real simple huh?</h2>
			</div>
			<div class="pt-page pt-page-12">
				<h2>So come on...</h2>
			</div>
			<div class="pt-page pt-page-13">
				<h2>Sign up! <br/> You'll love it!</h2>
			</div>
		</div>
	    <div class="pt-triggers">
			<button id="iterateEffects" class="pt-touch-button">Learn more</button>
		</div>

		<div class="pt-message">
			<p>Your browser does not support CSS animations.</p>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.dlmenu.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/pagetransitions.js"></script>
	</body>
</html>
