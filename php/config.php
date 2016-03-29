<?php

	$configs = array(
    'db_servername' => 'localhost',
    'db_username' => 'skibbdcc_usernam',
    'db_password' => 'fastnetrally85');
	
	$environment = ($_SERVER['HTTP_HOST'] == 'www.skibbdcc.com') ? 'prod' : 'dev';
	
	$countdownEventName = 'Westlodge Fastnet Rally 2016';
	$countdownEventLink = 'fastnetrally.php';
	$countdownEventDate = '10/30/2016 12:00:00';
	
?>