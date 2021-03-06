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
			<div class="col-md-12">
				<div class="panel panel-default backgroundColor font">
					<div class="panel-heading">
						<h3 class="panel-title">
							<?php echo $rallySponsor." "; ?> Fastnet Rally <?php echo $rallyEventYear; ?> - Entry List
						</h3>
					</div>

					<?php
					$classDetails = array(
						0 => array(
							'name' => 'Main Field',
							'file' => 'files/fastnet_2018/entry_list_main_field.csv'
						),
						//0 => array(
						//    'name' => 'Main Field - Late Entries',
						//    'file' => 'files/fastnet_2017/entry_list_main_field.csv'
						//),
						//1 => array(
						//    'name' => 'Historics',
						//    'file' => 'files/fastnet_2016/entry_list_historics.csv'
						//),
						2 => array(
							'name' => 'Juniors',
							'file' => 'files/fastnet_2018/entry_list_juniors.csv'
						)
					);

					foreach ($classDetails as $row) {
					?>
					<div class="container" style="padding-right:35px">
						<!-- 1, Driver, Co Driver, Cork, Honda Civic, 11 -->
						<h2>
							<?php echo $row['name']; ?>
						</h2>
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Driver</th>
									<th>Co-Driver</th>
									<th>Address</th>
									<th>Car</th>
									<th>Class</th>
								</tr>
							</thead>
							<tbody>
								<?php
						try
						{
							$filePath = $row['file'];

							if ( !file_exists($filePath) ) {
								throw new Exception('File not found.');
							}

							$openedFile =  fopen($filePath, "r");
							if ( !$openedFile ) {
								throw new Exception('File open failed.');
							}

							while(!feof($openedFile))
							{
								$line = fgetcsv($openedFile);
								?>
								<tr>
									<th>
										<?php echo $line[0]; ?>
									</th>
									<th>
										<?php echo $line[1]; ?>
									</th>
									<th>
										<?php echo $line[2]; ?>
									</th>
									<th>
										<?php echo $line[3]; ?>
									</th>
									<th>
										<?php echo $line[4]; ?>
									</th>
									<th>
										<?php echo $line[5]; ?>
									</th>
								</tr>
								<?php
							}
							fclose($openedFile);
						}
						catch ( Exception $e )
						{
							echo  $e->getMessage();
						}
								?>
							</tbody>
						</table>
					</div>
					<?php
					}
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
