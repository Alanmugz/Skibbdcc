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
  
  <title>Skibbereen &amp; District Car Club</title>
  
  <script type="text/javascript" src="javascript/global.js"></script>
  <link rel="stylesheet" type="text/css" href="css/global.css"/>
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
			include 'getMeeting2.php';  
		?>
		
		<script type='text/javascript'>
			var MyJSStringVar = "<?php Print($meetingDetails); ?>";  
		</script>
		
		<?php
			session_start(); 					
						  
			session_destroy(); 
		?>		
		
		<?php
			include 'setVideo.php';  
		?>
		
		<form action='savedvideo.php' method='POST' id='set_video' style='width:400px;align:center;margin-left:auto;margin-right:auto;padding-top:50px'>
			<p>Add another video</p>
			<span style='float:left;color:white;position:relative;top:9px;'>URL:</span><input type='text' style='float:right;padding:10px;width:335px;margin-left:10px;' name='set_video' id='setvideo'><br /><br /><br />
			<input type='submit' onClick='return validate()' name='save_button' value='Submit Video' style='float:right;'/>
		</form> 
		
		</div> 
		 
	<div id="newsrow">
		<?php 
			include ('include/sidebar.html'); 
		?>		
	</div> 
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
