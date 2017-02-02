<?php

//Database config
$configs = array(
	'db_servername' => 'localhost',
	'db_username' => 'skibbdcc_usernam',
	'db_password' => 'fastnetrally85');

//Environment
$environment = ($_SERVER['HTTP_HOST'] == 'www.skibbdcc.com') ? 'prod' : 'dev';

//Timer
$countdownEventName = 'Loose Surface Autocross 2017';
$countdownEventLink = 'loose_surface_autocross_february.php';
//Timer date set in countdowntimer.html

//Rally
$rallyEventYear = '2016';
$rallySponsor = 'Westlodge Hotel';

//Year to show the current set of files
$fileYear = '2017';

//Email
$emailRecipients = array('alanmugz@gmail.com, webmaster@skibbdcc.com, cozyger@gmail.com, colmfeen@gmail.com');
?>