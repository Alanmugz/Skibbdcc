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
$countdownEventName = 'Carbery Night Navigation Trial 2018';
$countdownEventLink = 'carbery_night_nav.php';

//Rally
$rallyEventYear = '2018';
$rallySponsor = 'Westlodge Hotel';
$FastnetRallyCOC = 'C.O.C: John Buttimer 0872371501';

//Club Championship
$ClubChampionshipYear = '2018';
$ClubChampionshipSponsor = 'Carbery Plastics';

//Year to show the current set of files
$fileYear = '2018';

//Event date details
$fileYear = '2018';
$IslesNightNavigationTrialDetails = "100 Isle Night Navigation Trial February 2019";
$IslesNightNavigationCOC = "C.O.C: Denis O Donovan 086 8773817";
$LooseSurfaceAutocrossFebruaryDetails = "Loose Surface Autocross February 2019";
$LooseSurfaceAutocrossFebruaryCOC = "C.O.C: Eric Calnan 087 7693052";
$AutotestMayDetails = "Date TBA";//"Autotest 20th & 21st May 2017";
$AutotestMayCOC = "C.O.C: TBA";//"C.O.C: Alan Clarke/Don Giles 0851744918/0868060604";
$LooseSurfaceAutocrossJulyDetails = "Loose Surface Autocross 8th July 2018";
$LooseSurfaceAutocrossJulyCOC = "C.O.C: Leslie Wolfe 0860666688";
$AutotestAugustDetails = "Date TBA";//"Autotest 19th & 20th August 2017";
$AutotestAugustCOC = "C.O.C: TBA";//"C.O.C: Michael Walsh/Michael Lynch 0862363901/0868909183";
$CarberyNightNavigationTrialDetails = "Carbery Night Navigation Trial 24th - 25th November 2018";
$CarberyNightNavigationTrialCOC = "C.O.C: Brian O'Mahony 086 4031079";
$AwardsNightDetails = "Awards Night December 2018";
$AwardsNightTickets = "Tickets: TBA";

//Email
$emailRecipients = array('alanmugz@gmail.com, webmaster@skibbdcc.com, pro@skibbdcc.com, colmfeen@gmail.com');
?>