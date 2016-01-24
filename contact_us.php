<?php
	include ('dataconnection.php'); 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head><!--  ščřžýŠČŘŽÝ -->
  <meta name="generator" content="PSPad editor, www.pspad.com" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="Contact Skibbereen &amp; District Car Club.">
  <meta name="keywords" content="Contact Us, Skibbereen and District Car Club, Skibbdcc, Westlodge Hotel, Skibbereen Motor Club, Fastnet Rally">
  <meta name="author" content="Alan Mulligan Web Design">
  <meta name="robots" content="index, follow"> 
  
  <title>Contact Us</title>
  
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
		<?php
			include 'getMeeting2.php'; 
		?>
		
		<script type='text/javascript'>
			var MyJSStringVar = "<?php Print($meetingDetails); ?>";  
		</script>
		
		<div id="news">
			<div id='pageheader'>
				Contact Us  
			</div>
			<div style="margin-left:15px;">
				Send attachments to webmaster@skibbdcc.com 
			</div>
				<form name="contactform" method="post" action="send_form_email.php" enctype="multipart/form-data">
					<table width="450px" align="center" style="margin-top:50px;">
					<tr>
					 <td valign="top">
					  <label for="full_name">Recipient</label>
					 </td>
					 <td valign="top"> 
					  <select style="width:209px;" name="recipient"> 
						  <option value="0">Skibbdcc</option> 
						  <option value="1">Webmaster</option>  
					  </select> 
					 </td>
					</tr>
					<tr>
					 <td valign="top">
					  <label for="full_name">Full Name *</label>
					 </td>
					 <td valign="top">
					  <input  type="text" name="full_name" maxlength="50" size="30">
					 </td>
					</tr>
					<tr>
					 <td valign="top">
					  <label for="email">Email Address *</label>
					 </td>
					 <td valign="top">
					  <input  type="text" name="email" maxlength="80" size="30">
					 </td>
					</tr>
					
					<tr>
					 <td valign="top"">
					  <label for="subject">Subject *</label>
					 </td>
					 <td valign="top">
					  <input  type="text" name="subject" maxlength="50" size="30">
					 </td>
					</tr>	
					<tr>
					 <td valign="top">
					  <label for="comments">Comments *</label>
					 </td>
					 <td valign="top">
					  <textarea  name="comments" maxlength="1000" cols="39" rows="6"></textarea> 
					 </td>
					</tr> 
					<tr>
					 <td colspan="2" style="text-align:center">
					  <input type="submit" value="Submit">   
					 </td>
					</tr>
					</table>
				</form>

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
