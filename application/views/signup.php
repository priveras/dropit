<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Mobile Specifi Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<title>Signup page</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/signup.css" />
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
</head>
<body>
    <div id="logo">
        <div id="logo_image">
            <img src="<?php echo base_url()?>assets/img/logo.png">
        </div>
        <div id="logo_text">
            <h1>Droppit</h1>
        </div>		    	
    </div>
    
<div id="container">

	<?php

	echo form_open('main/signup_validation');

	echo validation_errors();

	$username = array(
		'name' => 'name',
		'id' => 'username_input',
		'value' => $this->input->post('name'),
		'placeholder' => 'Full Name'
		);

	echo form_input($username);

	$username = array(
		'name' => 'username',
		'id' => 'username_input',
		'value' => $this->input->post('username'),
		'placeholder' => 'Username'
		);

	echo form_input($username);

	$email = array(
		'name' => 'email',
		'id' => 'email_input',
		'value' => $this->input->post('email'),
		'placeholder' => 'Email'
		);

	echo form_input($email);

	$password1 = array(
		'name' => 'password',
		'id' => 'password1_input',
		'placeholder' => 'Password'
		);

	echo form_password($password1);

	$password2 = array(
		'name' => 'cpassword',
		'id' => 'password2_input',
		'placeholder' => 'Confirm Password'
		);

	echo form_password($password2);


	$submit = array(
		'name' => 'signup_submit',
		'id' => 'submit_type',
		'value' => 'Sign up!',
		);

	echo "<p>";
	echo form_submit($submit);
	echo "</p>";

	echo form_close();
	?>
	<p>By joining you are accepting our<br/> terms and privacy policy</p>
</div>

<div id="login">
	<a href="<?php echo base_url();?>"><h1>Already a member? Click here to log in...</h1></a>
</div>
</body>
</html>