<?php

//Database config
$configs = array(
	'db_servername' => 'localhost',
	'db_username' => 'skibbdcc_usernam',
	'db_password' => 'fastnetrally85');

//Environment
$environment = ($_SERVER['HTTP_HOST'] == 'www.skibbdcc.com') ? 'prod' : 'dev';

//Timer
//Timer date set in countdowntimerlights.html and countdowntimer.html
$countdownEventName = 'May Autotest 2017';
$countdownEventLink = 'autotest_may.php';

//Rally
$rallyEventYear = '2016';
$rallySponsor = 'Westlodge Hotel';

//Year to show the current set of files
$fileYear = '2017';

//Event date details
$fileYear = '2017';
$IslesNightNavigationTrialDetails = "100 Isle Night Navigation Trial 28th - 29th January 2017";
$LooseSurfaceAutocrossFebruaryDetails = "Surface Autocross 19th February 2017";
$AutotestMayDetails = "Autotest 20th & 21st May 2017";

//Email
$emailRecipients = array('alanmugz@gmail.com, webmaster@skibbdcc.com, pro@skibbdcc.com, colmfeen@gmail.com');
?>