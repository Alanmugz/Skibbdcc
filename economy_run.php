<?php
	include ('dataconnection.php'); 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head><!--  ščřžýŠČŘŽÝ -->
  <meta name="generator" content="PSPad editor, www.pspad.com" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="Skibbereen &amp; District Car Club. Home of the Westlogde Fastent Rally">
  <meta name="keywords" content="Skibbereen and District Car Club, Skibbdcc, Westlodge Hotel, Skibbereen Motor Club, Fastnet Rally">
  <meta name="author" content="Alan Mulligan Web Design">
  <meta name="robots" content="index, follow"> 
  
  <title>Treasure Hunt/Fun Day</title>
  
  <script type="text/javascript" src="jquery/jquery.js"></script>
  <script type="text/javascript" src="global.js"></script>
  <link rel="stylesheet" type="text/css" href="css/global.css"/>
  <link rel="icon" type="image/png" href="images/favicon.png"/>
  <link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet"> 
  <link type="text/css" href="jquery.jscrollpane.css" rel="stylesheet" media="all" />
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <script type="text/javascript" src="jquery.jscrollpane.min.js"></script>
  
  </head>  
  <body onload="checkForMeeting(MyJSStringVar)">  
   
  <div id="container">
	<!-- header -->
	<div id="header">
		<?php 
			include ('include/header.html'); 
		?>
    </div>
	<!-- Menu Bar -->
	<div id="menu">
	 
	<div id='cssmenu' style="margin-bottom:-13px;"> 
		<?php 
			include ('include/menu.html'); 
		?>
	</div>
	<div id="submenu">
				<ul id="nav">
					<li><a href="economy_run.html" class="selected">Latest</a></li>
					<li><a href="map_economy_run.html">Map</a></li>    
				</ul>
			</div>	 
	</div>
  	
	<!-- Main Content --> 
	<div class="wrapper">
		<?php
			include ('getMeeting2.php');  
		?>
		
		<script type='text/javascript'>
			var MyJSStringVar = "<?php Print($meetingDetails); ?>";  
		</script>
		
		<div id="newsscroll"> 
			<div id='pageheader'>
				Treasure Hunt/Fun Day  
			</div>
			
			<span class="newstitle">Treasure Hunt/Fun Day</span><span class="newsdate">11th September 2013</span>
			<p class="setmargin">
			Skibbereen and District Car Club are delighted to be organising a Club information day and treasure hunt. The event will take place at Ryan's Filling Station in Rosscarbery on next weekend sunday 15 September.<br />
			The treasure hunt will be getting underway at 1pm with a €20 entry fee per car.. This is a new look event and for fun to break up the seriousness of competing giving the competitor a chance to relax and enjoy the "Craic"with family, friends and fellow clubs and club members.<br /><br />

			Skibbdcc will also be running a club information day along side the treasure hunt for patrons of motorsport that are interested in joining a motorsport club or finding information on what types of motor sport that they could get involved with, Autocross cars, night nav cars, rally cars, Autotest cars and some other interesting machines will be in attendance. <br />
			Officials of Skibbdcc and dedicated members will be on hand too help you with any questions you may need answered.<br /><br />  

			Skibbdcc strive to raise awareness for many charities and on this event we are helping to raise funds for these two very worthy charities..<br /><br />

			The Barry Collins Fund.<br /><br />

			Mary Mount Hospice Cancer Treatment.<br /><br />

			This event is sure to be a great day out for all, so please call down and support this event. <br />

			For more information contact<br /><br />

			Brian:+353 (86) 403 1079<br /> 
			Colm:(086) 862 6001
		    </p>
			
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
