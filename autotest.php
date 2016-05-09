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
  
  <title>Autotest</title>
  
  <script type="text/javascript" src="jquery/jquery.js"></script>
  <script type="text/javascript" src="javascript/global.js"></script>
  <link rel="stylesheet" type="text/css" href="css/global.css"/>
  <link rel="icon" type="image/png" href="images/favicon.png"/>
  <link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet"> 
  <link type="text/css" href="jquery/jquery.jscrollpane.css" rel="stylesheet" media="all" />
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <script type="text/javascript" src="jquery/jquery.jscrollpane.min.js"></script>
	 
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
	 
	<div id='cssmenu' style="margin-bottom:-13px;"> 
		<?php
			include ('include/menu.html');
		?>
	</div>
	<!-- Sub Menu -->
	<div id="submenu">
				<ul id="nav">
					<li><a href="autotest.php" class="selected">Latest</a></li>
					<li><a href="files/autotest/2016/regs.pdf">Regs</a></li>
					<li><a href="files/autotest/2016/regs.pdf">Entry Form</a></li>
					<li><a href="map_autotest.php">Map</a></li> 
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
				Autotest 21st & 22nd May 2016
			</div>
			<p class="setmargin"> 
				Skibbereen & District Car Club's Norman Giles Autotest Weekend 21st & 22nd of May. This years event will take place in Bandon Co-op, Kilbrogan Hill, Bandon. Alan Clarke will be Clerk Of The Course for 2016.
				<br /><br />
				Regulations are now available to download <a href="files/autotest/2016/regs.pdf" style="Color:red">here</a>,regulations will follow soon,
				<br /><br /> 
				Note: This years Autotest will take place one week prior to the date specified MSI hand book.
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
