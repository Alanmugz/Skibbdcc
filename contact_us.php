<?php
	require 'php/config.php'; 
?>

<!DOCTYPE html>
<head>
	<title>Contact Us</title>
	
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
		
	<!-- http://fontawesome.io/cdn/success/ -->
	<script src="https://use.fontawesome.com/0ef5cb71bd.js"></script>		

</head>
<html>
	<div class="container border10">	
		<div class="row row-margin height visible-lg">
			<div class="col-md-12 backgroundColor">
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
				<div> 
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
					<?php if(!isset($_POST['email'])){ ?>
						<div class = "padding">
							<div>
								Send attachments to webmaster@skibbdcc.com<br /><br />
							</div>
							<div class="bootstrap-iso ">
							 <div class="container-fluid">
							  <div class="row backgroundColor">
							   <div class="col-md-6 col-sm-6 col-xs-12">
								<form name="contactform" method="post" action="contact_us.php" enctype="multipart/form-data">
								 <div class="form-group ">
								  <label class="control-label " for="select">
								   Recipient
								  </label>
								  <select class="select form-control" id="select" name="recipient">
								   <option value="Skibbdcc">
									Skibbdcc
								   </option>
								   <option value="Webmaster">
									Webmaster
								   </option>
								  </select>
								 </div>
								 <div class="form-group ">
								  <label class="control-label requiredField" for="name">
								   Name
								   <span class="asteriskField">
									*
								   </span>
								  </label>
								  <input class="form-control" id="name" name="full_name" type="text"/>
								 </div>
								 <div class="form-group ">
								  <label class="control-label requiredField" for="email">
								   Email
								   <span class="asteriskField">
									*
								   </span>
								  </label>
								  <input class="form-control" id="email" name="email" type="text"/>
								 </div>
								 <div class="form-group ">
								  <label class="control-label requiredField" for="subject">
								   Subject
								   <span class="asteriskField">
									*
								   </span>
								  </label>
								  <input class="form-control" id="subject" name="subject" type="text"/>
								 </div>
								 <div class="form-group ">
								  <label class="control-label " for="message">
								   Message
								  </label>
								  <textarea class="form-control" cols="40" id="message" name="comments" rows="10"></textarea>
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
					<?php 
					} 
					else
					{						
						if($_POST['recipient'] == 1)
						{
							$recipient = "alanmugz@gmail.com, alanmulligan@yahoo.com";   
						}else
						{
							$recipient = "alanmugz@gmail.com, alanmulligan@yahoo.com";
						}
							
						// EDIT THE 2 LINES BELOW AS REQUIRED
						$email_to = $recipient;
						$email_subject = $_POST['subject'];  
						 
						 
						function died($error) {
							// your error code can go here
							$displayError = "We are very sorry, but there were error(s) found with the form you submitted. These errors appear below.<br /><br />".$error."<br /><br />"."Please go back and fix these errors.<br /><br />";
							die();
						}
						 
						// validation expected data exists
						if(!isset($_POST['full_name']) ||
							!isset($_POST['subject']) ||
							!isset($_POST['email']) || 
							!isset($_POST['comments'])) {
							died('We are sorry, but there appears to be a problem with the form you submitted.');       
						}
						 
						$full_name = $_POST['full_name']; // required
						$subject = $_POST['subject']; // required
						$email_from = $_POST['email']; // required
						$comments = $_POST['comments']; // required
						 
						$error_message = "";
						$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
						if(!preg_match($email_exp,$email_from)) {
							$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
						}
						$string_exp = "/^[A-Za-z .'-]+$/";
						
						if(!preg_match($string_exp,$full_name)) {
							$error_message .= 'The full Name you entered does not appear to be valid.<br />';
						}
						if(!preg_match($string_exp,$subject)) {
							$error_message .= 'The subject you entered does not appear to be valid.<br />';
						}
						
						if(strlen($comments) < 2) {
							$error_message .= 'The Comments you entered do not appear to be valid.<br />';
						}
						
						if(strlen($error_message) > 0) {
							died($error_message);
						} 
						$email_message = "Form details below.\n\n";
						 
						function clean_string($string) {
							$bad = array("content-type","bcc:","to:","cc:","href");
							return str_replace($bad,"",$string);
						}
						 
						$email_message .= "Full Name: ".clean_string($full_name)."\n";
						$email_message .= "Email: ".clean_string($email_from)."\n";
						$email_message .= "Subject: ".clean_string($subject)."\n";    
						$email_message .= "Comments: ".clean_string($comments)."\n";
						 
						 
						// create email headers
						$headers = 'From: '.$email_from."\r\n".
						'Reply-To: '.$email_from."\r\n" .
						'X-Mailer: PHP/' . phpversion();
						@mail($email_to, $email_subject, $email_message, $headers);
						?>
						<div class = "padding <?php if(!isset($_POST['email'])){echo ".hidden";} ?>">
							Thank you for contacting us. We will be in touch with you very soon.
						</div>
						<?php
					}
					?>
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