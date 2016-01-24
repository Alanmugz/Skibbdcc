<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head><!--  ščřžýŠČŘŽÝ -->
  <meta name="generator" content="PSPad editor, www.pspad.com" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  
  <title>Saved</title>
  
  <link rel="stylesheet" type="text/css" href="css/global.css"/>
  <script type="text/javascript" src="global.js"></script>
  <link rel="icon" type="image/png" href="images/favicon.png"/>
  
  
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
	 
	<div id='cssmenu'> 
		<?php
			include ('include/menu.html');
		?>
	</div>
	 
	</div>
	
    <!-- Main Content -->
	<div class="wrapper">
		<div id="news">
		<?php
			include 'getMeeting.php'; 
		?>		
		<script type='text/javascript'>
			var MyJSStringVar = "<?php Print($meetingDetails); ?>";  
		</script>
		
		<?php
			session_start(); 					
						  
			session_destroy(); 
		?>		 
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
