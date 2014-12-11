<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Signup page</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/signup.css" />
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
</head>
    <div id="logo">
        <div id="logo_image">
            <img src="<?php echo base_url()?>assets/img/logo.png">
        </div>
        <div id="logo_text">
            <h1>Droppit</h1>
        </div>		    	
    </div>
	<div id="login">
		<h1>Your email has been confirmed...</h1>
		<br/>
	    <div id="login-div">
	    <?php

	    echo form_open('main/login_validation');

	    echo validation_errors();

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
	    	'id' => 'username_input',
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

	    echo form_close();

	    ?>
	    </div>
	</div>
	</body>
</html>