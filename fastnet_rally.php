<?php
require 'php/config.php';
include 'php/newsrepository.php';
include 'php/eventenumertion.php';
include 'php/function.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		<?php echo $rallySponsor." "; ?> Fastnet Rally <?php echo $rallyEventYear; ?>
	</title>

	<meta name="generator" content="PSPad editor, www.pspad.com" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="Skibbereen &amp; District Car Club. Home of the Westlogde Fastent Rally" />
	<meta name="keywords" content="Skibbereen and District Car Club, Skibbdcc, Westlodge Hotel, Skibbereen Motor Club, Fastnet Rally" />
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
	<!-- Bottom menu -->
	<?php
	include ('include/event/fastnetrallybottommenu.html');
	?>
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
		<div class="alert alert-danger font">
			<strong>Alert !! </strong>Sunday, 29 October 2017 — Daylight Saving Time Ends. Clocks move backward 1 hour.
		</div>
		<div style="display:inline-block;margin:-25px 0px 15px 0px;"></div>
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default backgroundColor font">
					<div class="panel-heading">
						<h3 class="panel-title">
							<?php echo $rallySponsor." "; ?> Fastnet Rally <?php echo $rallyEventYear; ?>
							<h6>
								<?php echo $FastnetRallyCOC ?>
							</h6>
						</h3>
					</div>
					<div id='pageheader'>
						<?php Common::NewsTemplate(
							"Time & Distance",
							"25-10-2017 17:12")
						?>
					</div>
					<p class="setmargin">
						Time and Distance is now available to download from the Skibbereen & District Car Club website on the Fastnet Rally page under the competitor's section or 
						by clicking <?php Common::Href("files/fastnet_2017/time_and_distance.docx", "here") ?>
					</p>
					<div id='pageheader'>
						<?php Common::NewsTemplate(
							"Final Instruction 2",
							"25-10-2017 17:12")
						?>
					</div>
					<p class="setmargin">
						Final instruction 2 is now available to download from the Skibbereen & District Car Club website on the Fastnet Rally page under the competitor's section or 
						by clicking <?php Common::Href("files/fastnet_2017/final_instruction_2.doc", "here") ?>
					</p>
					<div id='pageheader'>
						<?php Common::NewsTemplate(
							"Final Instruction 1",
							"24-10-2017 19:12")
						?>
					</div>
					<p class="setmargin">
						Final instruction 1 is now available to download from the Skibbereen & District Car Club website on the Fastnet Rally page under the competitor's section or 
						by clicking <?php Common::Href("files/fastnet_2017/final_instruction_1.doc", "here") ?>
					</p>
					<div id='pageheader'>
						<?php Common::NewsTemplate(
							"Excitement is at fever pitch in and around the coastal town of Bantry.",
							"13-10-2017 12:13")
						?>
					</div>
					<p class="setmargin">
						Excitement is at fever pitch in and around the coastal town of Bantry Co. Cork on the Wild Atlantic Way as the town gears up for the final counting 
						Round of the Motorsport Ireland Triton Showers National Rally Championship which takes place as usual on the October Bank Holiday weekend. 
						Under the guidance of new Clerk of the Course John Buttimer and his team in the Skibbereen &amp; District Car Club, they are expecting a bumper entry. 
						With the overall Championship driver having been won by county Monaghan&rsquo;s Sam Moffett there is still the matter of the overall co-drivers&rsquo; 
						award for whom west corks own Karl Atkinson is on target to take on the Fastnet Rally, as well as many of the classes. Speaking today John added we are 
						delighted with the entries received to date and we thank those who have submitted an entry and also what has been promised to come in ,however, if there 
						are any crews that are taking part in the&nbsp; event that have not sent in their&nbsp; entry I would urge you to do so immediately. The Rally has three 
						different stage locations making reconnaissance very straightforward for all crews, with a total of eight stages deciding this year&rsquo;s 
						ultra-competitive Triton series. He added we have centralised service which is located within the town of Bantry. Our Headline sponsors the Westlodge 
						Hotel have laid on fantastic entertainment and a very detailed menu for rally crews and fans alike over the course of the weekend. We will have a 
						ceremonial start in Bantry on Saturday evening and would urge all families to come out and get up close to these star drivers. Action gets underway 
						shortly after 9.00 a.m. on Sunday 29th October (the Bank Holiday Weekend)
						<br />
						<br />
						So Come to Bantry this October Bank Holiday Weekend to the final counting round of the Triton National Rally Championship 2017 promoted and ran by the Skibbereen &amp; District Motor Club in Conjunction with the Westlodge Hotel and the Bantry Development and Tourism Association.
					</p>
					<div id='pageheader'>
						<?php Common::NewsTemplate(
							"Regulations & Entry Form",
							"18-09-2017 21:12")
						?>
					</div>
					<p class="setmargin">
						Regulations and entry form are now available to download from the Skibbereen & District Car Club website on the Fastnet Rally page under the competitor's section or 
						by clicking <a href="files/fastnet_2017/regs.doc">regs</a> or <a href="files/fastnet_2017/entry_form.docx">entryform</a>
					</p>
					<div id='pageheader'>
						<?php Common::NewsTemplate(
							"Westlodge Hotel Fastnet Rally Launch",
							"23-08-2017 03:22")
						?>
					</div>
					<p class="setmargin">
						Skibbereen & District Car Club Clerk of the Course - John Buttimer would like to cordially invite you to the launch of The Westlodge 
						Hotel Rally 2017 0n Friday 1st September at 8 PM. We would be delighted if you could join us, at the Westlodge Hotel for light refreshments.
						<br />
						<br />
						<img src="files/fastnet_2017/launch_invite.png" alt="Launch Invite" style="width:630px;height:398px;">
					</p>
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
				<div id="copyright" style="margin-bottom: 55px;">
					<?php
					include('include/copyright.html');
					?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>