<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head><!--  ščřžýŠČŘŽÝ -->
  <meta name="generator" content="PSPad editor, www.pspad.com" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  
  <title>Contributors Login</title>
  
  <link rel="icon" type="image/png" href="images/favicon.png"/>
  <link rel="stylesheet" type="text/css" href="global.css"/>
  <script type="text/javascript" src="global.js"></script>
  
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
	 
	<div id='cssmenu'> 
		<?php 
			include ('menu.html'); 
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
		
		<div id="news">
			<div id='pageheader'>
				Contributors Login<span id='logout'>Return <a href='index.php'>Home</a></span>  
			</div>  
			<form action="logged_in.php" method="POST" id="login_form">
					<select onchange="redirect(value)" style="width:250px;padding:10px;">
					  <option value="meeting">Update Club Meeting Dates</option>    
					  <option value="news" >Update Home Page News</option>
					  <option value="email" >Club Email</option>
					</select><br /><br > 
					<span style="position:relative;top:0px;">Username:</span> <input type="text" name="username" style="padding:10px;width:229px;"><br /><br />   
					<span style="position:relative;top:0px;">Password:</span> <input type="password" name="password" style="padding:10px;width:229px;"><br /><br >  
				<input type="submit" name="login_button" value="Login" style="position:relative;top:0px;left:193px;" />   
			</form> 
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