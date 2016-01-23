<?php
	include ('dataconnection.php'); 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head><!--  ščřžýŠČŘŽÝ -->
  <meta name="generator" content="PSPad editor, www.pspad.com" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="A list of events held by Skibbereen &amp; District Car Club.">
  <meta name="keywords" content="Club Events,Skibbereen and District Car Club, Skibbdcc, Westlodge Hotel, Skibbereen Motor Club, Fastnet Rally">
  <meta name="author" content="Alan Mulligan Web Design">
  <meta name="robots" content="index, follow"> 
  
  <title>Club Events</title>
  
  <script type="text/javascript" src="global.js"></script>
  <link rel="stylesheet" type="text/css" href="global.css"/>
  <link rel="icon" type="image/png" href="images/favicon.png"/> 
	 
  </head>  
  <body onload="checkForMeeting(MyJSStringVar)">  
   
  <div id="container">
	<!-- header -->
	<div id="header">
		<?php 
			include 'include/header.html';
		?>
    </div>
	<!-- Menu Bar -->
	<div id="menu">
	 
	<div id='cssmenu'> 
		<?php
			include ('include/menu.html');
		?>
	</div>
	 
	</div>
  	
	<!-- Main Content --> 
	<div class="wrapper">
		<?php
			include 'getMeeting2.php'; 
		?>
		
		<script type='text/javascript'>
			var MyJSStringVar = "<?php Print($meetingDetails); ?>";  
		</script>
		
		<div id="news" style="font-size:0.95em">
			<div id='pageheader'>
				Club Events  
			</div>
			<div style="margin-left:15px;margin-right:15px">
				<div id="club_events_border">
					<p>
					<img id="club_events" src="images/skibbdcc_logo.png" width="140" height="95" />
					<span id="club_events_header"><a style="color:red;" href="fastnet_rally.php">Westlodge Fastnet Rally</a></span><br />
					Date: 25th October 2015<br />
					Getting to: <a style="color:red;" href="#" onclick="openMap(0)
					;return false;">Bantry</a><br /> 
					Information: The Skibbereen & District Car Clubs marquee event. The rally is a counting round 
					of Dunlop Rally Championship. The Westlodge Fastnet Rally will begin overlooking the beautiful
					Bantry Bay. 
					<br />
					</p>
				</div>
				<br />
				<div id="club_events_border">
					<p>
					<img id="club_events" src="images/100_isles_night_nav.jpg" width="140" height="95" />
					<span id="club_events_header"><a style="color:red;" href="100_isles_night_nav.php">100 Isles Night Nav</a></span><br />
					Date: 1st &amp; 2nd February 2014<br />
					Getting to: <a style="color:red;" href="#" onclick="openMap(1)
					;return false;">Randel Og Gaa Pitch, Ballinacarriga</a><br /> 
					Information: A of the Carbery Plastics Club Championship. Navigation Trials 
					are as much a test of map reading and direction finding skills as they are competition driving. 
					They are a relatively cheap form of Motorsport. 
					<br />
					</p>
				</div>
				<br /> 
				<div id="club_events_border">
					<p>
					<img id="club_events" src="images/lsautocross.jpg" width="140" height="95" />
					<span id="club_events_header"><a style="color:red;" href="loose_surface_autocross.php">Loose Surface AutoCross</a></span><br />
					Date: 12th July 2015<br />
					Getting to: <a style="color:red;" href="#" onclick="openMap(2)
					;return false;">Campbell's Pit, Grancore, Clonakilty</a><br />  
					Information: Both autocross events run by skibbdcc are counting rounds of the munster autocross 
					championship and the Carbery Plastics Club Championship<br />
					</p>
				</div>
				<br />
				<div id="club_events_border">
					<p>
					<img id="club_events" src="images/autotest.jpg" width="140" height="95" />
					<span id="club_events_header"><a style="color:red;" href="autotest.php">Autotest</a></span><br />
					Date: 23rd &amp; 24th May 2015<br />
					Getting to: <a style="color:red;" href="#" onclick="openMap(3)
					;return false;">Bandon Co-op, Kilbrogan, Bandon.</a><br /> 
					Information: Both autotest events run by skibbdcc are counting rounds of the Carbery Plastics Club Championship.
					The years early autotest takes place in Bandon Co-op.
					<br />
					</p>
				</div>
				<br />
				<div id="club_events_border">
					<p> 
					<img id="club_events" src="images/skibbdcc_logo.png" width="140" height="95" />
					<span id="club_events_header"><a style="color:red;" href="treasurehunt.php">Treasure Hunt</a></span><br />
					Date: 15th September 2013<br />
					Getting to: <a style="color:red;" href="#" onclick="openMap(4)
					;return false;">Ryans Petrol Station, Rosscarbery</a><br /> 
					Information: Skibbereen and District Car Club are delighted to be organising a Club information day and 
					treasure hunt. The event will take place at Ryan's Filling Station in Rosscarbery on the 15th September.  
					<br />
					</p>
				</div>
				<br />
				<div id="club_events_border">
					<p>
					<img id="club_events" src="images/carbery_night_nav.jpg" width="140" height="95" />
					<span id="club_events_header"><a style="color:red;" href="carbery_night_nav.php">Carbery Night Nav</a></span><br />
					Date: 6th December &amp; 7th December 2014<br />
					Getting to: <a style="color:red;" href="#" onclick="openMap(5)
					;return false;">Quailty Hotel, Clonakilty</a><br />  
					Information: A round of the Carbery Plastics Club Championship. Navigation Trials 
					are as much a test of map reading and direction finding skills as they are competition driving. 
					They are a relatively cheap form of Motorsport.
					<br />
					</p> 
				</div>	  
			</div>
		</div> 
		 
	<div id="newsrow">
		<?php 
			include ('include/sidebar.html'); 
		?>
	</div> 
	   
	<!-- footer -->
		<div id="footer">
			<?php
				include ('include/footer.html');
			?>		
		</div>	

	
	<!-- Copyright -->
		<div id="copyright">&copy; Skibbereen &amp; District Car Club 2011 - <span id="getYear"></span><br />Designed by Alan Mulligan Web Design</div>
		
	</div>
  </body>
  </html>
