<html>
<head>
	<title>Dropit</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script src="<?php echo base_url(''); ?>assets/scripts/jquery-1.7.2.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/styles/style.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
</head>
<body>
    <header>
        <div id="menu">
            <div id="add">  
                <div id="add_form">
                    <!--<form method="post" action="<?php echo base_url(); ?>add/add_validation">
                       <input name="add" type="text" id="text" placeholder="http://"/>
                       <input name="add_submit" type="submit" id="submit" value="+"/>
                    </form>-->
                <?php



                echo form_open('add/add_validation');
                
                //echo validation_errors();

                $text = array(
                	'name' => 'add',
                	'id' => 'text',
                	'placeholder' => 'http://'
                	);

                echo form_input($text);

                $submit = array(
                	'name' => 'add_submit',
                	'id' => 'submit',
                	'value' => '+',
                	);

                echo form_submit($submit);

                echo form_close();

                

                ?>
                </div>
            </div>
            <div id="logo">
                <a href="feed.php"><div id="logo_text">
                    <p>Dropit</p>
                </div></a>
                <a href="feed.php"><div id="logo_image">
                    <img src="<?php echo base_url(); ?>assets/img/logo.png"/>
                </div></a>
            </div>
            <div id="profile">
                <div id="profile_data">
                    <div id="profile_image">
                        <img src="<?php echo base_url(); ?>assets/img/profile.png">
                    </div>
                    <div id="profile_username">
                        <p><?php echo $this->session->userdata('username') ?></p>
                    </div>
                    <!--<a href="feed.php"><div id="home">
                        <img src="<?php echo base_url(); ?>assets/img/home.png">
                        <p>Feed</p>
                    </div></a>-->
                    <a href='<?php echo base_url() . "main/logout" ?>'><div id="logout">
                        <img src="<?php echo base_url(); ?>assets/img/logout.png">
                        <p>Logout</p>
                    </div></a>
                </div>
            </div>
        </div>
    </header>