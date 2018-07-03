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
$countdownEventName = 'Loose Surface AutoCross 2018';
$countdownEventLink = 'loose_surface_autocross_july.php';

//Rally
$rallyEventYear = '2018';
$rallySponsor = 'Westlodge Hotel';
$FastnetRallyCOC = 'C.O.C: T.B.C';

//Club Championship
$ClubChampionshipYear = '2018';
$ClubChampionshipSponsor = 'Carbery Plastics';

//Year to show the current set of files
$fileYear = '2018';

//Event date details
$fileYear = '2018';
$IslesNightNavigationTrialDetails = "100 Isle Night Navigation Trial 27th - 28th January 2018";
$IslesNightNavigationCOC = "C.O.C: Denis O Donovan 086 8773817";
$LooseSurfaceAutocrossFebruaryDetails = "Loose Surface Autocross 25th February 2018";
$LooseSurfaceAutocrossFebruaryCOC = "C.O.C: James Kingston 0868598038";
$AutotestMayDetails = "Autotest 20th & 21st May 2017";
$AutotestMayCOC = "C.O.C: Alan Clarke/DonGiles 0851744918/0868060604";
$LooseSurfaceAutocrossJulyDetails = "Loose Surface Autocross 8th July 2018";
$LooseSurfaceAutocrossJulyCOC = "C.O.C: Leslie Wolfe 0860666688";
$AutotestAugustDetails = "Autotest 19th & 20th August 2017";
$AutotestAugustCOC = "C.O.C: Michael Walsh/Michael Lynch 0862363901/0868909183";
$CarberyNightNavigationTrialDetails = "Carbery Night Navigation Trial 25th - 26th November 2017";
$CarberyNightNavigationTrialCOC = "C.O.C: Brian O'Mahony 0864031079";

//Email
$emailRecipients = array('alanmugz@gmail.com, webmaster@skibbdcc.com, pro@skibbdcc.com, colmfeen@gmail.com');
?>