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
  
  <title>Carbery Night Nav</title>
  
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
	
			<div id="submenu">
				<ul id="nav">
					<li><a href="carbery_night_nav.php" class="selected">Latest</a></li>
					<li><a href="files/carbery_night_nav/Carbery_Night_Navigation_Trial_Regs_2015.docx">Regs</a></li>
					<li><a href="files/carbery_night_nav/Carbery_Night_Navigation_Trial_Regs_2015.docx">Entry Form</a></li>
					<li><a href="map_carbery_night_nav.php">Map</a></li>  
					<li><a href="#">Results</a></li>  
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
				Carbery Night Navigation Trial  
			</div>
			<span class="newstitle">HQ Location</span><span class="newsdate">26th November 2015</span>
			<p class="setmargin"> 
			Amendment to the plot for event HQ Kilmacabea GAA Club is 202.5/374.5 (and not 383/204 as on regs)<br />
			Directions:<br /> 
			At the bottom of Leap Village turn right in between the Harbour Bar and Ger's Diner<br />
			Continue to the next junction and keep left (about half a mile from village)
			</p>			
			<span class="newstitle">Marshals Needed</span><span class="newsdate">18th November 2015</span>
			<p class="setmargin"> 
			Skibbereen & District Car Club are looking for marshals for upcoming Carbery Night Navigation 
			Trail on Saturday 28th Sunday 29th of November 2015. Marshals will meeting at event HQ in 
			Kilmacabea Gaa club Leap time 8:30pm contact Colm Feen for more information on 0868626001.
			</p>
			<span class="newstitle">Regulation & Entry Form now available to download </span><span class="newsdate">18th November 2015</span>
			<p class="setmargin"> 
			Regulations and entry form for the Carbery Night Navigation Trial are now availble to download by clicking the 
			links above.
			</p>
			<span class="newstitle">Carbery Night Navgation Trial</span><span class="newsdate">9th November 2015</span>
			<p class="setmargin"> 
			Skibbereen & District Car Club will host the Carbery Night Navagition Trial on Saturday 28th & Sunday
			29th of November 2015 which will be a counting round of the Munster Night Navagition Championship and
			 the final round of the Carbery Plastics Skibbereen & District Car Club Championship.
			</p>
			<p class="setmargin">
			Clerk of the course: Colm Feen 0868626001
			Event secretary:  Amanda Giles 0863400190
			Chief marshal: Colm Feen 0868626001
			Venue is Killmacabea Gaa Club, Leap, Co.Cork
			</p>
			<p class="setmargin">
			This years route is approximately 80 miles with no petrol halt, map is sheet 89 4th edition.
			Timetable check in & scrutiny at 20:00
			Inital route card at 2015 route card at 21:30
			First car away at 23:00 	
			</p>
			 
			<!--TODO Update Location on the Map  -->
			
			
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