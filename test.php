<!DOCTYPE html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	<title>Skibbereen &amp; District Car Club</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
    <script type="text/javascript">var _siteRoot='index.html',_root='index.html';</script>
    <script type="text/javascript" src="jquery/jquery.js"></script>
    <script type="text/javascript" src="javascript/scripts.js"></script>
    <script type="text/javascript" src="javascript/global.js"></script>
    <link rel="stylesheet" type="text/css" href="css/global.css"/>
    <link rel="icon" type="image/png" href="images/favicon.png"/>  
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" rel="stylesheet" /> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.youtubepopup.min.js"></script>
	
	<!-- Timer -->
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	
    <script type="text/javascript">
		$(function () {
			$("a.youtube").YouTubePopup({ autoplay: 0 });
		});
    </script>
</head>

<html lang="en">
	<div class="container border10">	
		<div class="row row-margin height visible-lg">
			<div class="col-md-12">
				<div id="header">
					<?php 
						include ('includebootstrap/header.html');
					?>
				</div>
			</div>
		</div>
		<div style="margin-top:-20px">
			<?php 
				include ('includebootstrap/carousel.html');
			?>
		</div>
		<div class="row visible-lg" style="padding-bottom:20px">
			<div class="col-md-12">
				<div id='cssmenu'> 
					<?php
						include ('include/menu.html');
					?>
				</div>
			</div>
		</div>
		<div class="row hidden-lg">
			<div class="col-md-12 font">
				<header class="navbar navbar-inverse bs-docs-nav" role="banner">
					<div class="container">
					<div class="navbar-header">
						<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <a href="./" class="navbar-brand">Skibbdcc</a>
					</div>
					<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
						<ul class="nav navbar-nav">
							<li>
							  <a href="#">Home</a>
							</li>
							<li>
							  <a href="#">Westlodge Fastnet Rally 2016 </a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Club Events <b class="caret"></b></a>
								<ul class="dropdown-menu">
								  <li><a href="#">LS AutoCross</a></li>
								  <li><a href="#">Autotest</a></li>
								  <li><a href="#">Economy Run</a></li>
								  <li><a href="#">100 Isles Night Nav</a></li>
								  <li><a href="#">Carbery Night Nav</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Gallery <b class="caret"></b></a>
								<ul class="dropdown-menu">
								  <li><a href="#">Image Gallery</a></li>
								  <li><a href="#">Video Gallery</a></li>
								</ul>
							</li>
							<li>
							  <a href="#">Club Championship 2015</a>
							</li>
							<li>
							  <a href="#">History</a>
							</li>
							<li>
							  <a href="#">Contact Us</a>
							</li>
							<li>
							  <a href="#">Club History</a>
							</li>
						</ul>
					</nav>
					</div>
				</header>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class = "panel panel-default">
					<div class = "panel-heading">
						<h3 class = "panel-title">Club News</h3>
					</div>
					<?php 
						include("/home/skibbdcc/public_html/scriptfolderbootstrap/news.php");
					?>    
				</div>
			</div>
			
			<div class="col-md-4">
				<div class = "panel panel-default" style="background:#E4F3F6;">
				    <div class = "panel-heading">
						<h3 class = "panel-title">Next Event:</h3>
				    </div>
					<a href="" style="text-decoration:none">
				    <div>
						<h3 align="center">Westlodge Fastnet Rally 2016</h3>
						<ul class="countdown">
							<li> <span class="days">00</span>
							<p class="days_ref">days</p>
							</li>
							<li class="seperator"></li>
							<li> <span class="hours">00</span>
							<p class="hours_ref">hours</p>
							</li>
							<li class="seperator">:</li>
							<li> <span class="minutes">00</span>
							<p class="minutes_ref">minutes</p>
							</li>
							<li class="seperator">:</li>
							<li> <span class="seconds">00</span>
							<p class="seconds_ref">seconds</p>
							</li>
						</ul>
						<script type="text/javascript" src="jquery/jquery.downCount.js"></script> 
						<script type="text/javascript">
							$('.countdown').downCount({
								//Month/Day/Year
								date: '10/30/2016 12:00:00',
								offset: +10
							});
						</script> 
					</div>
					</a>
				</div>
				<div class = "panel panel-default font">
				   <div class = "panel-heading">
					  <h3 class = "panel-title">Club Sponsors</h3>
				   </div>
				   
				   <div class = "panel-body">
						<a href="http://www.westlodgehotel.ie/">Westlodge Hotel</a><br /> 
						<a href="http://www.bantry.ie/">Bantry Development & Tourism Association</a><br /> 
						<a href="http://www.carberyplastics.com/">Carbery Plastics</a><br />
						<a href="omahony.html">O'Mahony Crash Repairs</a><br />
						<a href="clonakiltypotatoes.html">Clonakilty Potatoes</a><br />
						<a href="http://www.keohanereadymix.com/">Keohane Readymix</a><br />
						<a href="http://www.plasticbags.ie/">Plastic Bags</a><br />
						<a href="toureenconstruction.html">Toureen Construction</a><br />
						<a href="blastit.html">Blast It</a><br />
						<a href="johnfordeconstruction.html">John Forde Construction</a><br />
						<a href="http://www.westcorkoil.ie/">Tria Oil</a><br />
						<a href="hayescabins.html">Hayes Cabins</a><br />
						<a href="http://www.blackwatermotors.ie/">Blackwater Motors</a><br />
						<a href="lordantarmac.html">Lordan Tarmac</a><br />
						<a href="mossiecabs.html">MossiesCabs</a><br />
						<a href="n71odonovanmotorstheoldcreamery.html">N71 & O'Donovan Motors & The Old Creamery</a><br />
						<a href="http://www.danseamanmotors.ie/">Dan Seaman Motors</a><br /> 
						<a href="dandmcrashrepairs.html">D & M Crash Repairs</a>	
				   </div>
				</div>
				<div class = "panel panel-default">
				    <div class = "panel-heading">
						<h3 class = "panel-title">Social Media</h3>
				    </div>
				   
				    <div class = "panel-body">
						<!-- https://twitter.com/settings/widgets/708238291645145088/edit?notice=WIDGET_UPDATED-->
						<a class="twitter-timeline" href="https://twitter.com/Skibbdcc" data-widget-id="708238291645145088">Tweets by @Skibbdcc</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				    </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class = "panel panel-default font">
				    <div class = "panel-heading">
					  <h3 class = "panel-title">Contact Us:</h3>
				    </div>
				   
				    <div class = "panel-body fill">
						<a href="contact_us.php">Contact Skibbdcc</a><br />
						<a href="contact_us.php">WebMaster</a><br />
						<a href="contributors_login.php">Contributors Login</a>
				    </div>
				</div>
			</div>
			<div class="col-md-4">
				<div class = "panel panel-default font">
				   <div class = "panel-heading">
						<h3 class = "panel-title">Club Events:</h3>
				   </div>
				   
				   <div class = "panel-body fill">
						<a href="fastnet_rally.php">Westlodge Hotel Fastnet Rally</a><br />
						<a href="autotest.php">AutoTest</a><br />
						<a href="loose_surface_autocross.php">Loose Surface AutoCross</a><br />
						<a href="100_isles_night_nav.php">100 Isles Night Nav</a><br />
						<a href="carbery_night_nav.php">Carbery Night Nav</a><br />
						<a href="economy_run.php">Treasure Hunt</a><br />
						<a href="club_championship.php">The <span id="getSponsor"></span> Club Championship</span></a>
				   </div>
				</div>			
			</div>
			<div class="col-md-4">
				<div class = "panel panel-default font">
				   <div class = "panel-heading">
						<h3 class = "panel-title">In Association With:</h3>
				   </div>
				   
				   <div class = "panel-body fill">
					   <a href="http://www.nationalirishrallychampionship.com/" target="_blank">Triton Showers National Rally Championship</a><br />
					   <a href="http://www.southern4rallychampionship.com/" target="_blank">Southern 4 Rally Championship</a><br />
					   <a href="http://www.motorsportireland.com/" target="_blank">Motorsport Ireland</a></span>
				   </div>
				</div>			
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="copyright">
					&copy; Skibbereen &amp; District Car Club 2011 - <?php echo date("Y"); ?><br />Designed by Alan Mulligan Web Design
				</div>
			</div>
		</div>
	</div>
</html>