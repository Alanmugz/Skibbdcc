<?php
require 'php/config.php';
include 'php/function.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Join Our Club</title>

	<meta name="generator" content="PSPad editor, www.pspad.com" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="Skibbereen &amp; District Car Club. Home of the Westlogde Fastent Rally" />
	<meta name="keywords" content="Skibbereen and District Car Club, Skibbdcc, Westlodge Hotel, Skibbereen Motor Club, Fastnet Rally, 100 Isles Night Navigation Trial" />
	<meta name="author" content="Alan Mulligan Web Design" />
	<meta name="robots" content="index, follow" />

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="cssbootstrap/style.css" type="text/css" media="screen" />
	<script type="text/javascript" src="jquery/jquery.js"></script>
	<script type="text/javascript" src="javascript/scripts.js"></script>
	<script type="text/javascript" src="javascript/global.js"></script>
	<link rel="stylesheet" type="text/css" href="cssbootstrap/global.css" />
	<link rel="icon" type="image/png" href="images/favicon.png" />

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" rel="stylesheet" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>

	<!-- Timer -->
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css" />

	<!-- http://fontawesome.io/cdn/success/ -->
	<script src="https://use.fontawesome.com/0ef5cb71bd.js"></script>

</head>
<body>
	<div class="container border10">
		<div class="row row-margin height visible-lg">
			<div class="col-md-12 backgroundColor">
				<div id="header">
					<?php
					include ('include/header.html');
					?>
				</div>
			</div>
		</div>
		<div style="margin-top:-20px">
			<?php
			include ('include/carousel.html');
			?>
		</div>
		<div class="row visible-lg" style="padding-bottom:20px">
			<div class="col-md-12">
				<div>
					<?php
					include ('include/menu.html');
					?>
				</div>
			</div>
		</div>
		<div class="row hidden-lg">
			<?php
			include ('include/mobilemenu.html');
			?>
		</div>
		<!-- <div style="display:inline-block;margin:-25px 0px 15px 0px;">
		<?php
		include ('include/event/100islesmenu.html');
		?>
	</div>	 -->
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default backgroundColor font">
					<div class="panel-heading">
						<h3 class="panel-title">Join Our Club</h3>
					</div>
					<div id='pageheader'>
						<?php Common::NewsTemplate(
							"How to join Skibbereen & District Car Club",
							"16-04-2017 21:31")
						?>
					</div>

					<p class="setmargin">
						Any persons wishing to become a new member or renew their membership to Skibbereen & District Car Club can do so by attending one of the club's monthly meeting.<br /><br />
						Please bring the relevant form(s) which may need to be stamped by the club, these can be downloaded below.<br /><br />
						2017 RENEWAL COMPETITION LICENCE APPLICATION FORM - <a style="color:red" href="forms/2017/renewal_competition_licence_application_form.pdf"><b>DOWNLOAD</b></a><br />
						2017 FIRST TIME COMPETITION LICENCE APPLICATION FORM - <a style="color:red" href="forms/2017/first_time_competition_licence_application_form.pdf"><b>DOWNLOAD</b></a><br />
						MOTORSPORT IRELAND LICENCE HOLDERS ONLY IRDS RALLY & MULTI-VENUE AUTOTEST INSURANCE FIRST & RENEWAL APPLICATION - <a style="color:red" href="forms/2017/motorsport_ireland_licence_holders_only_irds_rally_&_multii_venue_autotest_insurance_first_&_renewal_application.pdf"><b>DOWNLOAD</b></a><br />
						<br /><br />
						Club regristar Brian O'Mahony 0864031079
					</p>
				</div>

				<div class="panel panel-default visible-lg backgroundColor">
					<div class="panel-heading">
						<h3 class="panel-title">Latest Videos</h3>
					</div>
					<?php
					include('include/video.html');
					?>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-default backgroundColor">
					<div class="panel-heading">
						<h3 class="panel-title">Next Event:</h3>
					</div>
					<div id="countdown-nextmeeting">
						<?php
						include('include/countdowntimer.html');
						?>
					</div>
				</div>
				<div class="panel panel-default font">
					<div class="panel-heading">
						<h3 class="panel-title">Club Sponsors</h3>
					</div>
					<?php
					include('include/sponsors.html');
					?>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Social Media</h3>
					</div>
					<?php
					include('include/socialmedia.html');
					?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-default font">
					<div class="panel-heading">
						<h3 class="panel-title">Contact Us:</h3>
					</div>
					<?php
					include('include/contactus.html');
					?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default font">
					<div class="panel-heading">
						<h3 class="panel-title">Club Events:</h3>
					</div>
					<?php
					include('include/clubevents.html');
					?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default font">
					<div class="panel-heading">
						<h3 class="panel-title">In Association With:</h3>
					</div>
					<?php
					include('include/association.html');
					?>
				</div>
			</div>
		</div>
		<div class="row visible-lg">
			<div class="col-md-12">
				<div id="copyright">
					<?php
					include('include/copyright.html');
					?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>