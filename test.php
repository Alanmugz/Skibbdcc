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
    <link rel="stylesheet" href="cssbootstrap/style.css" type="text/css" media="screen" />
    <script type="text/javascript">var _siteRoot='index.html',_root='index.html';</script>
    <script type="text/javascript" src="jquery/jquery.js"></script>
    <script type="text/javascript" src="javascript/scripts.js"></script>
    <script type="text/javascript" src="javascript/global.js"></script>
    <link rel="stylesheet" type="text/css" href="cssbootstrap/global.css"/>
    <link rel="icon" type="image/png" href="images/favicon.png"/>  
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" rel="stylesheet" /> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.youtubepopup.min.js"></script>

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:600,700' rel='stylesheet' type='text/css'>
	<link href="http://fonts.googleapis.com/css?family=Righteous" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="countdown.demo.css" type="text/css">
	
    <script type="text/javascript">
		$(function () {
			$("a.youtube").YouTubePopup({ autoplay: 0 });
		});
    </script>
</head>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="jquery.countdown.js"></script>
        <script>
        window.jQuery(function ($) {
            "use strict";

            $('time').countDown({
                with_separators: false
            });
            $('.alt-1').countDown({
                css_class: 'countdown-alt-1'
            });
            $('.alt-2').countDown({
                css_class: 'countdown-alt-2'
            });

        });
		
		function countdownTimer()
		{
			// get total seconds between the times
			var delta = Math.abs(date_future - date_now) / 1000;

			// calculate (and subtract) whole days
			var days = Math.floor(delta / 86400);
			delta -= days * 86400;

			// calculate (and subtract) whole hours
			var hours = Math.floor(delta / 3600) % 24;
			delta -= hours * 3600;

			// calculate (and subtract) whole minutes
			var minutes = Math.floor(delta / 60) % 60;
			delta -= minutes * 60;

			// what's left is seconds
			var seconds = delta % 60;  // in theory the modulus is not required
			
			alert(2);
			return "102h00m59s";
		}
		
        </script>

<style type="text/css">

/* Large desktop */
@media (min-width: 1200px) {
	.container {
    width: 1025px;
  }
}
 
/* Portrait tablet to landscape and desktop */
@media (min-width: 768px) and (max-width: 979px) { 
	.container {
    width: 830px;
  } 
}
 
/* Landscape phone to portrait tablet */
@media (max-width: 767px) { ... }
 
/* Landscape phones and down */
@media (max-width: 480px) { ... }

.border10 {
    padding: 10px;
}
#custom-bootstrap-menu.navbar-default .navbar-brand {
    color: rgba(119, 119, 119, 1);
}
#custom-bootstrap-menu.navbar-default {
    font-size: 14px;
    background-color: rgba(8, 8, 8, 1);
    border-width: 1px;
    border-radius: 3px;
}
#custom-bootstrap-menu.navbar-default .navbar-nav>li>a {
    color: rgba(255, 255, 255, 1);
    background-color: rgba(0, 0, 0, 1);
}
#custom-bootstrap-menu.navbar-default .navbar-nav>li>a:hover,
#custom-bootstrap-menu.navbar-default .navbar-nav>li>a:focus {
    color: rgba(255, 255, 255, 1);
    background-color: rgba(255, 0, 0, 1);
}
#custom-bootstrap-menu.navbar-default .navbar-nav>.active>a,
#custom-bootstrap-menu.navbar-default .navbar-nav>.active>a:hover,
#custom-bootstrap-menu.navbar-default .navbar-nav>.active>a:focus {
    color: rgba(255, 255, 255, 1);
    background-color: rgba(250, 0, 0, 1);
}
#custom-bootstrap-menu.navbar-default .navbar-toggle {
    border-color: #fa0000;
}
#custom-bootstrap-menu.navbar-default .navbar-toggle:hover,
#custom-bootstrap-menu.navbar-default .navbar-toggle:focus {
    background-color: #fa0000;
}
#custom-bootstrap-menu.navbar-default .navbar-toggle .icon-bar {
    background-color: #fa0000;
}
#custom-bootstrap-menu.navbar-default .navbar-toggle:hover .icon-bar,
#custom-bootstrap-menu.navbar-default .navbar-toggle:focus .icon-bar {
    background-color: #080808;
}
.bottom-buffer { margin-bottom:20px; }
.height { background-color : white;}
.height1 { height : 42px; background-color : white; margin-left: 0px; margin-right: 0px}
.height2 { height : 100%; background-color : white; margin-left: 0px; margin-right: 0px}
.border { border: solid red 1px}
.padding { margin: 0px 1%}
.carousel{
    background: #2f4357;
    margin-top: 20px;
}
.carousel .item img{
    margin: 0 auto; /* Align slide image horizontally center */
}
.panel-body {
background:#E4F3F6;}
.font{ font-size: 1.3em}
.fill{
    height:150px;
}

</style>
<html lang="en">
	<div class="container border10">	
		<div class="row row-margin height">
			<div class="col-md-4 visible-xs">
				<div class = "panel panel-default">
					<img src="images/skibbdcc_logo.png" class="img-responsive" alt="Rounded Image">
				</div>
			</div>
		</div>
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
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Carousel indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
					<li data-target="#myCarousel" data-slide-to="3"></li>
					<li data-target="#myCarousel" data-slide-to="4"></li>
					<li data-target="#myCarousel" data-slide-to="5"></li>
				</ol>
				<!-- Wrapper for carousel items -->
				<div class="carousel-inner">
					<div class="item active">
						<img src="imagesbootstrap/slider/img14.jpg" alt="First Slide">
					</div>
					<div class="item">
						<img src="imagesbootstrap/slider/img18.jpg" alt="Second Slide">
					</div>
					<div class="item">
						<img src="imagesbootstrap/slider/img19.jpg" alt="Second Slide">
					</div>
					<div class="item">
						<img src="imagesbootstrap/slider/img4.jpg" alt="Second Slide">
					</div>
					<div class="item">
						<img src="imagesbootstrap/slider/img12.jpg" alt="Second Slide">
					</div>
					<div class="item">
						<img src="imagesbootstrap/slider/img2.jpg" alt="Second Slide">
					</div>
				</div>
			</div>
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
			<div class="col-md-12">
				<div id="custom-bootstrap-menu" class="navbar navbar-default" role="navigation">
					<div class="container-fluid">
						<div class="navbar-header"><a class="navbar-brand" href="#">Skibbdcc</a>
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
							</button>
						</div>
						<div class="collapse navbar-collapse navbar-menubuilder">
							<ul class="nav navbar-nav navbar-justified">
								<li><a href="/">Home</a>
								</li>
								<li><a href="#">Westlodge Fastnet Rally 2018</a>
								</li>
								<li><a href="#">Club Events</a>
								</li>
								<li><a href="#">Gallery</a>
								</li>
								<li><a href="#">Club Championship 2015</a>
								</li>
								<li><a href="#">History</a>
								</li>
								<li><a href="/contact">Contact Us</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
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
				    <div style="margin:20px auto -10px auto; width:90%; text-align: center; font: 15px arial, sans-serif;">
						Skibbdcc AutoCross<br />
						28th February 2016
					</div>
					<?php 
						$result = timer();
						if($result[0] >= 24)
						{
							?>
							<div class = "panel-body">
								<h1 class="alt-1" ><?php echo $result[1]; ?></h1>
							</div>
							<?php
						}
						else
						{
							?>
							<div class = "panel-body">
								<h1 class="alt-1" style="padding-left:20px"><?php echo $result[1]; ?></h1>
							</div>
							<?php
						}
					?>
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
						<a class="twitter-timeline" href="https://twitter.com/Skibbdcc" data-widget-id="708227933484290048">Tweets by @Skibbdcc</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
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

<?php
function timer()
{
	$now = new DateTime();
	$event_date = new DateTime('2016-03-09 15:00:00');
	
	$interval = date_diff($now, $event_date);
	
	$daysInHours = $interval->format('%d') * 24;
	$hours = $interval->format('%h') + $daysInHours;
	$minutes = $interval->format('%i');
	$seconds = $interval->format('%s');
	
	$timer = $hours.'h'.$minutes.'m'.$seconds.'s';
	
	return array ($hours, $timer);
}
?>