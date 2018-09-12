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

					<?php if(!isset($_POST['email'])){ ?>
						<div class = "padding">
							<div class="bootstrap-iso ">
							 <div class="container-fluid">
							  <div class="row backgroundColor">
							   <div class="col-md-6 col-sm-6 col-xs-12">
								<form name="contactform" method="post" action="join_our_club.php" enctype="multipart/form-data">
								 <div class="form-group ">
								  <label class="control-label requiredField" for="first_name">
								   First Name
								   <span class="asteriskField">
									*
								   </span>
								  </label>
								  <input class="form-control" id="first_name" name="first_name" type="text"/>
								 </div>
								 <div class="form-group ">
								  <label class="control-label requiredField" for="surname">
								   Surname
								   <span class="asteriskField">
									*
								   </span>
								  </label>
								  <input class="form-control" id="surname" name="surname" type="text"/>
								 </div>
								 <div class="form-group ">
								  <label class="control-label requiredField" for="address">
								   Address
								   <span class="asteriskField">
									*
								   </span>
								  </label>
								  <input class="form-control" id="address" name="address" type="text"/>
								 </div>
								 <div class="form-group ">
								  <label class="control-label requiredField" for="mobile_number">
								   Mobile Number
								   <span class="asteriskField">
									*
								   </span>
								  </label>
								  <input class="form-control" id="mobile_number" name="mobile_number" type="text"/>
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
								 <label class="control-label requiredField" for="interests">
								   Interests
								   <span class="asteriskField">
									*
								   </span>
								  </label>
								  <br />
								  	<input type="checkbox" name="Interested_in" id="autocross" value="Autocross">Autocross<br />
								  	<input type="checkbox" name="Interested_in" id="autotest5" value="Autotest">Autotest<br />
								  	<input type="checkbox" name="Interested_in" id="marshalling" value="Marshalling">Marshalling<br />
								  	<input type="checkbox" name="Interested_in" id="night_navigation" value="Night navigation">Night navigation<br />
								  	<input type="checkbox" name="Interested_in" id="endurance_trials" value="Endurance trials">Endurance trials<br />
								  	<input type="checkbox" name="Interested_in" id="officiating" value="Officiating">Officiating<br />
								  	<input type="checkbox" name="Interested_in" id="stage rallying" value="Stage rallying">Stage rallying<br />
									<input type="checkbox" name="Interested_in" id="tarmac rallying" value="Tarmac rallying">Tarmac rallying<br />
								 <br />	  
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
							  $arrEmail = array('alanmugz@gmail.com');
							  // EDIT THE 2 LINES BELOW AS REQUIRED
							  $email_to = $arrEmail;
							  $email_subject = 'Club Membership';  
							  
							  
							  function died($error) {
								  // your error code can go here
								  $displayError = "We are very sorry, but there were error(s) found with the form you submitted. These errors appear below.<br /><br />".$error."<br /><br />"."Please go back and fix these errors.<br /><br />";
								  die();
							  }
							  
							  // validation expected data exists
							  if(!isset($_POST['first_name']) ||
								  !isset($_POST['surname']) ||
								  !isset($_POST['address']) ||
								  !isset($_POST['mobile_number']) ||
								  !isset($_POST['email'])) {
								  died('We are sorry, but there appears to be a problem with the form you submitted.');       
							  }
							  
							  $name = $_POST['first_name']; // required
							  $surname = $_POST['surname']; // required
							  $address = $_POST['address']; // required
							  $mobile_number = $_POST['mobile_number']; // required
							  $email_from = $_POST['email']; // required
							  
							  $error_message = "";
							  $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
							  if(!preg_match($email_exp,$email_from)) {
								  $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
							  }
							  $string_exp = "/^[A-Za-z .'-]+$/";
							  
							  if(!preg_match($string_exp,$name)) {
								  $error_message .= 'The first Name you entered does not appear to be valid.<br />';
							  }
							  if(!preg_match($string_exp,$surname)) {
								$error_message .= 'The surname you entered does not appear to be valid.<br />';
							  }
							  if(!preg_match($string_exp,$address)) {
								  $error_message .= 'The address you entered does not appear to be valid.<br />';
							  }
							  
							  if(strlen($error_message) > 0) {
								  died($error_message);
							  } 
							  $email_message = "Form details below.\n\n";
							  
							  function clean_string($string) {
								  $bad = array("content-type","bcc:","to:","cc:","href");
								  return str_replace($bad,"",$string);
							  }
							  
							  $email_message .= "First Name: ".clean_string($name)."\n";
							  $email_message .= "Surname: ".clean_string($surname)."\n";
							  $email_message .= "Address: ".clean_string($address)."\n";    
							  $email_message .= "Mobile Number: ".clean_string($mobile_number)."\n";
							  $email_message .= "Email: ".clean_string($email_from)."\n";
							  
							  
							  // create email headers
							  $headers = 'From: '.$email_from."\r\n".
							  'Reply-To: '.$email_from."\r\n" .
							  'X-Mailer: PHP/' . phpversion();
							  foreach($arrEmail as $key => $email_to)
							  {
								  @mail($email_to, $email_subject, $email_message, $headers);
							  }
					?>
						<div class = "padding <?php if(!isset($_POST['email'])){echo ".hidden";} ?>">
							Thank you for contacting us. We will be in touch with you very soon.
						</div>
						<?php
						  }
						?>
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