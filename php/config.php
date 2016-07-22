<?php

	//Database config
	$configs = array(
    'db_servername' => 'localhost',
    'db_username' => 'skibbdcc_usernam',
    'db_password' => 'fastnetrally85');
	
	//Environment
	$environment = ($_SERVER['HTTP_HOST'] == 'www.skibbdcc.com') ? 'prod' : 'dev';
	
	//Timer
	$countdownEventName = 'Westlodge Hotel Fastnet Rally 2016';
	$countdownEventLink = 'fastnet_rally.php';
	//Timer date set in countdowntimer.html
	
	//Rally
	$rallyEventYear = '2016';
	$rallySponsor = 'Westlodge Hotel';
?>