<?php

	$configs = array(
    'db_servername' => 'localhost',
    'db_username' => 'skibbdcc_usernam',
    'db_password' => 'fastnetrally85');
	
	$environment = ($_SERVER['HTTP_HOST'] == 'admin') ? 'dev' : $_SERVER['HTTP_HOST'];
	
?>