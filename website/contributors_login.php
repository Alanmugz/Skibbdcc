<?php
	require 'php/config.php'; 
?>

<!DOCTYPE html>
<head>
	<title>Login</title>
	
	<meta name="generator" content="PSPad editor, www.pspad.com" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="Skibbereen &amp; District Car Club. Home of the Westlogde Fastent Rally"/>
	<meta name="keywords" content="Skibbereen and District Car Club, Skibbdcc, Westlodge Hotel, Skibbereen Motor Club, Fastnet Rally, Club Championship, Carbery Plastics"/>
	<meta name="author" content="Alan Mulligan Web Design"/>
	<meta name="robots" content="index, follow"/>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
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
	
	<!-- Timer -->
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	
	<!-- Contact Form https://formden.com/form-builder/ -->
	<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
	<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: #E4F3F6 !important;} .asteriskField{color: red;}</style>
	
    <script type="text/javascript">
		$(function () {
			$("a.youtube").YouTubePopup({ autoplay: 0 });
		});
    </script>
</head>
<html>
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
						include ('includebootstrap/menu.html');
					?>
				</div>
			</div>
		</div>
		<div class="row hidden-lg">
			<?php 
				include ('includebootstrap/mobilemenu.html');
			?>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class = "panel panel-default backgroundColor font">
					<div class = "panel-heading">
						<h3 class = "panel-title">Contact Us</h3>
					</div>
					<div class = "padding">
					  <div class="bootstrap-iso">
						 <div class="container-fluid">
						  <div class="row">
						   <div class="col-md-6 col-sm-6 col-xs-12">
							<form action="logged_in.php" method="post">
							 <div class="form-group ">
							  <label class="control-label " for="select">
							   Select a Choice
							  </label>
							  <select onchange="redirect(value)" class="select form-control" id="select" name="select">
							   <option value="meeting">
								Update Club Meeting Dates
							   </option>
							   <option value="news">
								Update Home Page News
							   </option>
							   <option value="email">
								Club Email
							   </option>
							  </select>
							 </div>
							 <div class="form-group ">
							  <label class="control-label " for="name">
							   Username
							  </label>
							  <input class="form-control" id="name" name="name" type="text"/>
							 </div>
							 <div class="form-group ">
							  <label class="control-label " for="password">
							   Password
							  </label>
							  <input class="form-control" id="password" name="password" type="password"/>
							 </div>
							 <div class="form-group">
							  <div>
							   <button class="btn btn-primary " name="submit" type="submit">
								Submit
							   </button>
							  </div>
							 </div>
							</form>
						   </div>
						  </div>
						 </div>
						</div>	
					</div>
				</div>
				<div class = "panel panel-default visible-lg backgroundColor">
					<div class = "panel-heading">
						<h3 class = "panel-title">Latest Videos</h3>
					</div>
					<?php 
						include('includebootstrap/video.html');
					?>    
				</div>
			</div>
			
			<div class="col-md-4">
				<div class = "panel panel-default backgroundColor">
				    <div class = "panel-heading">
						<h3 class = "panel-title">Next Event:</h3>
				    </div>
					<div id="countdown-nextmeeting">
						<?php
							include('includebootstrap/countdowntimer.html');
						?>
					</div>
				</div>
				<div class = "panel panel-default font">
				   <div class = "panel-heading">
					  <h3 class = "panel-title">Club Sponsors</h3>
				   </div>
				   <?php 
						include('includebootstrap/sponsors.html');
					?>
				</div>
				<div class = "panel panel-default">
				    <div class = "panel-heading">
						<h3 class = "panel-title">Social Media</h3>
				    </div>
				   <?php 
						include('includebootstrap/socialmedia.html');
					?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class = "panel panel-default font">
				    <div class = "panel-heading">
						<h3 class = "panel-title">Contact Us:</h3>
				    </div>
				    <?php 
						include('includebootstrap/contactus.html');
					?>
				</div>
			</div>
			<div class="col-md-4">
				<div class = "panel panel-default font">
				    <div class = "panel-heading">
						<h3 class = "panel-title">Club Events:</h3>
				    </div>
				    <?php 
						include('includebootstrap/clubevents.html');
					?>
				</div>			
			</div>
			<div class="col-md-4">
				<div class = "panel panel-default font">
				    <div class = "panel-heading">
						<h3 class = "panel-title">In Association With:</h3>
				    </div>
					<?php 
						include('includebootstrap/association.html');
					?>
				</div>			
			</div>
		</div>
		<div class="row visible-lg">
			<div class="col-md-12">
				<div id="copyright">
					<?php 
						include('includebootstrap/copyright.html');
					?>
				</div>
			</div>
		</div>
	</div>
</html>