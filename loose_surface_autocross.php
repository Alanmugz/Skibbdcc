<?php
	include 'dataconnection.php'; 
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
  
  <title>Loose Surface AutoCross</title>
  
  <script type="text/javascript" src="jquery/jquery.js"></script>
  <script type="text/javascript" src="global.js"></script>
  <link rel="stylesheet" type="text/css" href="global.css"/>
  <link rel="icon" type="image/png" href="images/favicon.png"/>
  <link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet"> 
  <link type="text/css" href="jquery.jscrollpane.css" rel="stylesheet" media="all" />
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <script type="text/javascript" src="jquery.jscrollpane.min.js"></script>
  <script type="text/javascript" src="http://stratus.sc/stratus.js"></script>
	 
  </head>  
  <body onload="checkForMeeting(MyJSStringVar)">  
   
  <div id="container">
	<!-- header -->
	<div id="header">
		<?php 
			include ('header.html'); 
		?>
    </div>
	<!-- Menu Bar -->
	<div id="menu">
	 
	<div id='cssmenu' style="margin-bottom:-13px;"> 
		<?php 
			include ('menu.html'); 
		?>
	</div>
	<div id="submenu">
				<ul id="nav">
					<li><a href="loose_surface_autocross.php" class="selected">Latest</a></li>
					<li><a href="files/ls_autocross/2015/regs&entryform.doc">Regs</a></li>
					<li><a href="files/ls_autocross/2015/regs&entryform.doc">Entry Form</a></li>
					<li><a href="map_lsautocross.php">Map</a></li>  
					<li><a href="files/ls_autocross/2015/LS_Autocross_15.xls">Results</a></li>  
				</ul> 
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
		 
		<div id="newsscroll"> 
			<div id='pageheader'>
				Loose Surface Autocross 12th July 2015
			</div >
			<span class="newstitle">Loose Surface Autocross - Results</span><span class="newsdate">13th July 2015</span>
			<p class="setmargin"> 
			Results are now available to download via the results tab above.
			</p> 			
			<span class="newstitle">Loose Surface Autocross</span><span class="newsdate">1st July 2015</span>
			<p class="setmargin"> 
			The July Autocross, round 5 of the National AutoCross Championship will take place on Sunday 12th July 2015 in Keohane's Pit, Shannonvale - our new venue for 2015. 
			The start of the track is fast and smooth and then it tightens into a more challenging surface.  From mid point onwards the 
			track gets very fast and very smooth to the finish line.  There is a spacious service area, ample parking for competitiors 
			and spectators.<br />
			C.O.C of the Event is Fergus Harrington<br />
			<br />			
			Regs and entry form are availabe to download from the tab's above marks "regs" and "entry form" respectively<br />
			<br />
			<a style="color:red; text-decoration:underline;" href="files/ls_autocross/2015/national_championship_standings.xls">National AutoCross Championship standings</a>
			</p> 			 
		</div> 
		 
	<div id="newsrow">
		<?php 
			include ('sidebar.html'); 
		?>
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