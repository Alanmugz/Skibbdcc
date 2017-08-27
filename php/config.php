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
$countdownEventName = 'Westlodge Hotel Fastnet Rally 2017';
$countdownEventLink = 'fastnet_rally.php';

//Rally
$rallyEventYear = '2017';
$rallySponsor = 'Westlodge Hotel';
$FastnetRallyCOC = 'John Buttimer';

//Club Championship
$ClubChampionshipYear = '2017';
$ClubChampionshipSponsor = 'Carbery Plastics';

//Year to show the current set of files
$fileYear = '2017';

//Event date details
$fileYear = '2017';
$IslesNightNavigationTrialDetails = "100 Isle Night Navigation Trial 28th - 29th January 2017";
$IslesNightNavigationCOC = "";
$LooseSurfaceAutocrossFebruaryDetails = "Loose Surface Autocross 19th February 2017";
$LooseSurfaceAutocrossFebruaryCOC = "C.O.C: James Kingston 0868598038";
$AutotestMayDetails = "Autotest 20th & 21st May 2017";
$AutotestMayCOC = "C.O.C: Alan Clarke/DonGiles 0851744918/0868060604";
$LooseSurfaceAutocrossJulyDetails = "Loose Surface Autocross 9th July 2017";
$LooseSurfaceAutocrossJulyCOC = "C.O.C: Leslie Wolfe 0860666688";
$AutotestAugustDetails = "Autotest 19th & 20th August 2017";
$AutotestAugustCOC = "C.O.C: Michael Walsh/Michael Lynch 0862363901/0868909183";
$CarberyNightNavigationTrialDetails = "Carbery Night Navigation Trial 25th - 26th November 2017";
$CarberyNightNavigationTrialCOC = "C.O.C: Brian O'Mahony 0864031079";

//Email
$emailRecipients = array('alanmugz@gmail.com, webmaster@skibbdcc.com, pro@skibbdcc.com, colmfeen@gmail.com');
?>