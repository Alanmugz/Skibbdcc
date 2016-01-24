<?php
	include 'dataconnection.php'; 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head><!--  ščřžýŠČŘŽÝ -->
  <meta name="generator" content="PSPad editor, www.pspad.com" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="Skibbereen &amp; District Car Club annual dinner dance">
  <meta name="keywords" content="Skibbereen and District Car Club, Skibbdcc, Westlodge Hotel, Skibbereen Motor Club, Fastnet Rally, dinner dance">
  <meta name="author" content="Alan Mulligan Web Design">
  <meta name="robots" content="index, follow"> 
  
  <title>MSI Amendments</title>
  
  <script type="text/javascript" src="global.js"></script>
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
		<?php
			include 'getMeeting2.php'; 
		?>
		
		<script type='text/javascript'>
			var MyJSStringVar = "<?php Print($meetingDetails); ?>";  
		</script>
		
		<div id="news">
			<div id='pageheader'>
			MSI Amendments 
			</div>
			
			<div>  
				<p class="setmargin"> 
				<img style="float:left;margin-right:10px;" src="images/pdf.png" alt="pdf Logo" />
				<br /><a href='http://www.motorsportireland.com/Libraries/Yearbook_2014_Amendments/APPENDIX_33_%e2%80%93_STANDARD_REGULATIONS_FOR_NAVIGATION_TRIALS_%e2%80%93_26_SEPTEMBER_14.sflb.ashx'><span>Standard Regulations for Navigstion Trial (Appendix 33)</span></a>
				</p> 
			</div>			
			
			<br />
			
			<div>
				<p class="setmargin"> 
				<img style="float:left;margin-right:10px;" src="images/pdf.png" alt="pdf Logo" />
				<br /><a href='http://www.motorsportireland.com/Libraries/Yearbook_2014_Amendments/KF3_Rule_change_2014_Appendix_70.sflb.ashx'><span>KF3 Rule change 2014 (Appendix 70)</span></a>
				</p> 
			</div>
			
			<br />
			 
			<div>
				<p class="setmargin"> 
				<img style="float:left;margin-right:10px;" src="images/pdf.png" alt="pdf Logo" />
				<br /><a href='http://www.motorsportireland.com/Libraries/Yearbook_2014_Amendments/KZ2_Rule_Change_2014_Appendix_70.sflb.ashx'><span>KZ2 Rule Change 2014 (Appendix 70)</span></a>
				</p> 
			</div>
			
			<br />
			
			<div>
				<p class="setmargin"> 
				<img style="float:left;margin-right:10px;" src="images/pdf.png" alt="pdf Logo" />
				<br /><a href='http://www.motorsportireland.com/Libraries/Yearbook_2014_Amendments/8_11_6_Rule_deleted_2014_Appendix_70.sflb.ashx'><span>8.11.6 Rule deleted 2014 (Appendix 70)</span></a>
				</p> 
			</div>
			
			<br />
			
			<div>
				<p class="setmargin"> 
				<img style="float:left;margin-right:10px;" src="images/pdf.png" alt="pdf Logo" />
				<br /><a href='http://www.motorsportireland.com/Libraries/Yearbook_2014_Amendments/RC_-_App_29_RC1_Classes_update_January_14.sflb.ashx'><span>RC - App.29 RC1 Classes update January 14</span></a>
				</p> 
		    </div>		
			
			<br />
			
			<div>
				<p class="setmargin"> 
				<img style="float:left;margin-right:10px;" src="images/pdf.png" alt="pdf Logo" />
				<br /><a href='http://www.motorsportireland.com/Libraries/Yearbook_2014_Amendments/Rally_2_Restart_Regulations_2014_Appendix_29.sflb.ashx'><span>Rally 2 Restart Regulations 2014 (Appendix 29)</span></a>
				</p>
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
