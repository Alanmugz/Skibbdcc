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
  
  <title>100 Isles Night Nav</title> 
  
  <script type="text/javascript" src="jquery/jquery.js"></script>
  <script type="text/javascript" src="global.js"></script>
  <link rel="stylesheet" type="text/css" href="global.css"/>
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
			include 'header.html';
		?>
    </div>
	<!-- Menu Bar -->
	<div id="menu">
		<div id='cssmenu' style="margin-bottom:-13px;"> 
			<?php
				include ('menu.html');
			?>
		</div>
		<!-- Sub Menu -->
		<div id="submenu">
			<ul id="nav">
				<li><a href="100_isles_night_nav.php" class="selected">Latest</a></li>
				<li><a href="files/100Isles/2016_regs.pdf">Regs</a></li>
				<li><a href="files/100Isles/2016_regs.pdf">Entry Form</a></li>
				<li><a href="map_100_isles_night_nav.php">Map</a></li> 
				<li><a href="#">Results</a></li> 
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
				100 Isle Night Navigation Trial 30th - 31st January 2016
			</div >
			
			<!--<span class="newstitle">100 Isle Night Navigation Trial Results</span><span class="newsdate">1st February 2015</span>
			<p class="setmargin"> 
			100 Isle Night Navigation Trial Results <a href="files/100Isles/Results_2015.xlsx" class="selected" style="color:red">Click here</a> 
			</p>-->
			 
		</div>
		 
		<div id="newsrow">
			<?php 
				include ('sidebar.html'); 
			?>
		</div>
		
	</div> 
	   
	<!-- footer -->
	<div id="footer">
		<?php
			include ('footer.html');
		?>
	</div>	

	
	<!-- Copyright -->
		<div id="copyright">&copy; Skibbereen &amp; District Car Club 2011 - <span id="getYear"></span><br />Designed by Alan Mulligan Web Design</div>
		
	</div>
  </body>
  </html>