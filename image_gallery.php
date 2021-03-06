<?php
require 'php/config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Skibbereen &amp; District Car Club Image Gallery</title>

	<meta name="generator" content="PSPad editor, www.pspad.com" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="Skibbereen &amp; District Car Club. View the latest image from club events and members in action." />
	<meta name="keywords" content="Skibbereen and District Car Club, Skibbdcc, Westlodge Hotel, Skibbereen Motor Club, Fastnet Rally" />
	<meta name="author" content="Alan Mulligan Web Design" />
	<meta name="robots" content="index, follow" />

	<!-- For Facebook -->
	<meta property="og:title" content="<?php echo $titlefb; ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:image" content="http://www.skibbdcc.com/images/facebook_skibbdcc_logo.png" />
	<meta property="og:url" content="<?php echo "http://www.skibbdcc.com".$_SERVER['REQUEST_URI']; ?>" />
	<meta property="og:description" content="<?php echo $descfb; ?>" />

	<!-- For Twitter -->
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:url" content="<?php echo "http://www.skibbdcc.com".$_SERVER['REQUEST_URI']; ?>" />
	<meta name="twitter:title" content="<?php echo $titlefb; ?>" />
	<meta name="twitter:description" content="<?php echo $descfb; ?>" />
	<meta name="twitter:image" content="http://www.skibbdcc.com/images/facebook_skibbdcc_logo.png" />

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="cssbootstrap/style.css" type="text/css" media="screen" />
	<script type="text/javascript">var _siteRoot = 'index.html', _root = 'index.html';</script>
	<script type="text/javascript" src="jquery/jquery.js"></script>
	<script type="text/javascript" src="javascript/scripts.js"></script>
	<script type="text/javascript" src="javascript/global.js"></script>
	<link rel="stylesheet" type="text/css" href="cssbootstrap/global.css" />
	<link rel="icon" type="image/png" href="images/favicon.png" />

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" rel="stylesheet" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
	<script type="text/javascript" src="jquery/jquery.youtubepopup.min.js"></script>

	<!-- Timer -->
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript">
		$(function () {
			$("a.youtube").YouTubePopup({ autoplay: 0 });
		});
	</script>

	<!-- http://fontawesome.io/cdn/success/ -->
	<script src="https://use.fontawesome.com/0ef5cb71bd.js"></script>

	<!-- https://github.com/blueimp/Bootstrap-Image-Gallery -->
	<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css" />
	<link rel="stylesheet" href="gallery/css/bootstrap-image-gallery.css" />
	<link rel="stylesheet" href="gallery/css/demo.css" />
	<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
	<script src="gallery/js/bootstrap-image-gallery.js"></script>

</head>
<body>
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
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Image Gallery</h3>
					</div>
					<?php
					include ('gallery/index.html');
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
