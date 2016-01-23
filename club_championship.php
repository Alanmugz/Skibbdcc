<?php
	include ('dataconnection.php'); 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head><!--  ščřžýŠČŘŽÝ -->
  <meta name="generator" content="PSPad editor, www.pspad.com" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="The Carbery Plastics sponsored, Skibbereen &amp; District Car Club, Club Championship.">
  <meta name="keywords" content="Carbery Plastics, Club Championship, Skibbereen and District Car Club, Skibbdcc, Westlodge Hotel, Skibbereen Motor Club, Fastnet Rally">
  <meta name="author" content="Alan Mulligan Web Design">
  <meta name="robots" content="index, follow"> 
  
  <title>Carbery Plastics Club Championship</title>
  
  <script type="text/javascript" src="global.js"></script>
  <link rel="stylesheet" type="text/css" href="global.css"/>
  <link rel="icon" type="image/png" href="images/favicon.png"/> 
	 
  </head>  
  <body onload="checkForMeeting(MyJSStringVar)">  
   
  <div id="container">
	<!-- header -->
	<div id="header">
		<img src="images/header.jpg" alt="image header" />
		<div id="header_font"><img src="images/club_championship_header.png" alt="image header" /></div>
		<div id="header_image"><img src="" /></div>
		<div id="setText"></div>
		<div id="logo"><img src="images/skibbdcc_logo.png" /></div>
		<div id="banner"><img src="images/banner.png" alt="Official Skibbereen &amp; District Car Club" /></div>
		  <div class="fb-like-button"><iframe src="https://www.facebook.com/plugins/like.php?href=https://www.facebook.com/pages/The-OFFICIALSkibbereen-and-District-Car-Club-page/503817079653581?ref=ts&fref=ts"
			  scrolling="no" frameborder="0" style="border:none; width:50px; height:25px"></iframe>
		  </div> 
		  <div style="position:absolute;top:15px;left:268px; z-index:2;">		  
			  <a href="https://twitter.com/Skibbdcc" class="twitter-follow-button" data-show-count="false">Follow @Skibbdcc</a>
			  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>  
		  </div>
		<span id="official">SKIBBDCC.COM - THE OFFICIAL WEBSITE</span>
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
		
		<div id="news">
			<div id='pageheader'>
				Carbery Plastics Club Championship    
			</div> 
			<div style="margin-left:15px;margin-right:15px;">
				Amended Carbery Plastics Club Championship 2015 final standings <a href="files/club_champ/2015_final_amended.xlsx" style="text-decoration: underline;">final standings</a> 
			</div><br /> 
			<div style="margin-left:15px;margin-right:15px;">
				Carbery Plastics Club Championship 2015 final standings <a href="files/club_champ/2015_final.xlsx" style="text-decoration: underline;">final standings</a> 
			</div><br />
			<div style="margin-left:15px;margin-right:15px;">
				Updated - Carbery Plastics Club Championship 2015 <a href="files/club_champ/regs_2015b.docx" style="text-decoration: underline;">regulations</a> 
			</div>
			<div style="margin-left:15px;margin-right:15px;"> 
				<br />Carbery Plastics Club Championship 2015 standing after Westlodge Hotel Fastnet Rally <a href="files/club_champ/14_15_westlodge_fastnet_rally.xlsx" style="text-decoration: underline;">standings</a> 
			</div>	
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
