<?php
require 'php/config.php';
include 'php/newsrepository.php';
include 'php/eventenumertion.php';
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
			<div class="col-md-12 headerBackgroundColor">
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
		<div style="display:inline-block;margin:-25px 0px 15px 0px;"></div>
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default backgroundColor font">
					<div class="panel-heading">
						<h3 class="panel-title">
							<?php echo $rallySponsor." "; ?> Fastnet Rally <?php echo $rallyEventYear; ?> - Accommodation
						</h3>
					</div>
					<div>
						<h3 class="setmargin">Hotel Accommodation</h3>
						<p class="setmargin">
							Westlodge Hotel & Pondlodge Cottages 027 50360
							<br />
							Bantry Bay Hotel Wolfe Tone Square, Bantry 027-50062
							<br />
							The Maritime Hotel The Quay, Bantry 027-54700 027-54701
							<br />
						</p>
						<h3 class="setmargin">B&B Accommodation</h3>
						<p class="setmargin">
							Bru na Pairce Slip Park, Bantry 027-51603
							<br />
							Atlantic Shore Newtown, Bantry 027-51310
							<br />
							Ard na Greine Newtown, Bantry 027-51169
							<br />
							Leyton 23 Slip Lawn, Bantry 027-50665
							<br />
							Carbery Cottage Guest Lodge, Brahalish, Durrus 027 61368 or 087 7577743
							<br />
							Elmwood House 6 Slip Lawn, Bantry 027-50087
							<br />
							The Mill Newtown, Bantry 027-50278
							<br />
							Doire Liath Newtown, Bantry 027-50223
							<br />
							La Mirage Droumdaniel, Ballylickey, Bantry 027-50688
							<br />
							Dunauley (self-catering) Seskin, Bantry 027-50290
							<br />
							Donemark Rise Droumacoppil, Bantry 027-51099
							<br />
							Ardaravan House 028-32740
							<br />
							The Bridge House, Pearson Bridge, Bantry 027-66281
							<br />
							Sunville Newtown, Bantry 027-50175
							<br />
							Cnoc A Dúin 26 Slip Lawn, Bantry 027-50744
							<br />
							Highfield Newtown, Bantry 027-50791
							<br />
							Eden Crest (also Self-catering) Newtown, Bantry 027-51110
							<br />
							Graceland Kealkil, Bantry 027-66055
							<br />
							Reendonegan House Reendonegan, Ballylickey, Bantry 027-51455
							<br />
							Aran Lodge Ballylickey, Bantry 027-50378
							<br />
							Pipit Cove (self-catering) Ballylickey, Bantry 027-51594
							<br />
							Bridge View House Kilcrohane, Durrus, Bantry 027-67108 027-67086
							<br />
							Coulin Gurteenroe, Bantry 027-50020
							<br />
							Bantry House (B&B + self-catering) Bantry 027-50047 027-50795
							<br />
							Ahakista Escape -Self catering Ahakista Bantry 027 61117
							<br />
							Sheep's Head Holiday Homes Sheeps Head ,Bantry 086-3598875
							<br />
						</p>
						<h3 class="setmargin">Farm House Accommodation</h3>
						<p class="setmargin">
							Dromcloc House Bantry 027-50030
							<br />
							Hillcrest Farm Ahakista, Durrus, Bantry 027-67045
							<br />
							Sea Mount Farmhouse Goats Path Rd, Glenlough West, Bantry 027-61226 027-61226
							<br />
							Bay View Farm (self-catering) Gories, Bantry 027-50515
							<br />
							Reenmore Farmhouse Ahakista, Durrus, Bantry 027-67051
							<br />
						</p>
					</div>
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
