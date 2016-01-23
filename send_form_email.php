<?php
if(isset($_POST['email'])) {

	if($_POST['recipient'] == 1)
	{
		$recipient = "webmaster@skibbdcc.com";   
	}else
	{
		$recipient = "webmaster@skibbdcc.com";//if value = 0 send to pro
	}
		
	
     
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = $recipient;
	$email_subject = $_POST['subject'];  
     
     
    function died($error) {
        // your error code can go here
		$displayError = "We are very sorry, but there were error(s) found with the form you submitted. These errors appear below.<br /><br />".$error."<br /><br />"."Please go back and fix these errors.<br /><br />";
		
		?>
		
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
  
  <title>Error</title>
  
  <script type="text/javascript" src="global.js"></script>
  <link rel="stylesheet" type="text/css" href="global.css"/>
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
			<div style="padding-left:15px;margin-right:15px;"><?php echo $displayError;?></div> 
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
		
		<?php
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['full_name']) ||
        !isset($_POST['subject']) ||
		!isset($_POST['email']) || 
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
     
    $full_name = $_POST['full_name']; // required
    $subject = $_POST['subject']; // required
    $email_from = $_POST['email']; // required
    $comments = $_POST['comments']; // required
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$full_name)) {
    $error_message .= 'The full Name you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$subject)) {
    $error_message .= 'The subject you entered does not appear to be valid.<br />';
  }
  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  } 
    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Full Name: ".clean_string($full_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
	$email_message .= "Subject: ".clean_string($subject)."\n";    
    $email_message .= "Comments: ".clean_string($comments)."\n";
     
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
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
  
  <title>Confirmation - Message sent</title>
  
  <script type="text/javascript" src="global.js"></script>
  <link rel="stylesheet" type="text/css" href="global.css"/>
  <link rel="icon" type="image/png" href="images/favicon.png"/> 
	 
  </head>  
  <body onload="checkForMeeting(MyJSStringVar)">  
   
  <div id="container">
	<!-- header -->
		<div id="header">
			<img src="images/header.jpg" alt="image header" />
			<div id="header_font"><img src="images/header_font.png" alt="image header" /></div>
			<div id="header_image"><img src="" /></div>
			<div id="setText"></div>
			<div id="logo"><img src="images/skibbdcc_logo.png" /></div>
			<div id="banner"><img src="images/banner.png" alt="Official Skibbereen &amp; District Car Club" /></div>
			  <div class="fb-like-button"><iframe src="https://www.facebook.com/plugins/like.php?href=https://www.facebook.com/pages/The-OFFICIALSkibbereen-and-District-Car-Club-page/503817079653581?ref=ts&fref=ts"
				  scrolling="no" frameborder="0" style="border:none; width:350px; height:25px"></iframe>
			  </div>   
			<span id="official">SKIBBDCC.COM - THE OFFICIAL WEBSITE</span>
		</div>
	<!-- Menu Bar -->
	<div id="menu">
		<div id='cssmenu'> 
			<ul>
			   <li class='has-sub'><a href='index.html'><span>Home</span></a></li>
			   <li class='has-sub'><a href='fastnet_rally.html'><span>WestLodge Fastnet Rally 2013</span></a></li>   
			   <li class='has-sub'><a href='club_events.html'><span>Club Events</span></a>
						<ul>
						   <li><a href='loose_surface_autocross.html'><span>LS AutoCross</span></a></li>
						   <li class='last'><a href='autotest.html'><span>AutoTest</span></a></li>
						   <li class='last'><a href='economy_run.html'><span>Economy Run</span></a></li>
						   <li class='last'><a href='100_isles_night_nav.html'><span>100 Isles Night Nav</span></a></li>
						   <li class='last'><a href='carbery_night_nav.html'><span>Carbery Night Nav</span></a></li>
						</ul>
				</li>		
				<li class='has-sub'><a href='club_championship_12/13.html'><span>Club Championship <span id="getClubChampionshipYear"></span></span></a></li>
				<li class='has-sub'><a href='gallery.html'><span>Gallery</span></a>
					<ul>
					   <li><a href='image_gallery.html'><span>Image Gallery</span></a></li>
					   <li class='last'><a href='video_gallery.html'><span>Video Gallery</span></a></li>
					</ul>				
				</li> 
				<li class='has-sub'><a href='dinner_dance.html'><span>Dinner Dance</span></a></li>
				<li class='active'><a href='contact_us.html'><span>Contact Us</span></a></li>
				<li class='last'><a href='club_history.html'><span>Club History</span></a></li>
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
		
		<div id="news">
			<div id='pageheader'>
				Contact Us  
			</div>
			<div style="padding-left:15px;margin-right:15px;">Thank you for contacting us. We will be in touch with you very soon.
			</div>
		</div> 
		 
	<div id="newsrow">
		<div class="row_next_event"> 
			<span class="colheader">Next Event:</span>
					
			<div id="upcoming_event"><a href=""><img src="" alt="Next Event"/></a>
				<div id="timerContainer">
					<div id="daysBox"></div>
					<div id="cdtdwrapper"> 
							<div id="hoursBox"></div>
							<div id="minutesBox"></div>
							<div id="secondsBox"></div>
					</div>
				</div>

				<script type="text/javascript"> cdtd(); </script>
				
			</div>
		</div>
			
			<div class="row_facebook"><span class="colheader" style="left:-205px;">Social Media:</span><div class="fb-like-box" data-href="https://www.facebook.com/pages/The-OFFICIALSkibbereen-and-District-Car-Club-page/503817079653581?ref=stream&amp;hc_location=stream" data-width="290" data-show-faces="true" data-colorscheme="dark" data-stream="false" data-show-border="true" data-header="true"></div></div>
			<div class="row_club_cship"><span id="getClubChampionship"></span><div id="club_championship"><a href=""><img src="" alt="Club Championship"/></a></div></div>																																														
			<div class="row_club_membership"><span class="colheader">Join Skibbdcc / membership renewal:</span><div id="setMembership"><a href=""><img src="" alt="Club Membership"/></a></div> 
		</div>
		
	</div> 
	   
	<!-- footer -->
		<div id="footer">
		  <div class="a"><span class="colheader">Contact Us:</span><br /><span class="colmain"><a href="contact_us.html"><span id="getPRO"></span> Club P.R.O</a><br /><a href="contact_us.html">WebMaster</a><br /><a href="contributors_login.html">Contributors Login</a></span></div>
		  <div class="b"><span class="colheader">Events:</span><br /><span class="colmain"><a href="fastnet_rally.html">Westlodge Fastnet Rally</a><br /><a href="autotest.html">AutoTest</a><br /><a href="loose_surface_autocross.html">Loose Surface AutoCross</a><br /><a href="100_isles_night_nav.html">100 Isles Night Nav</a><br /><a href="carbery_night_nav.html">Carbery Night Nav</a><br /><a href="economy_run.html">Economy Run</a><br /><a href="club_championship.html">The <span id="getSponsor"></span> Club Championship</span></a></div> 
		  <div class="c"><span class="colheader">In Association With:</span><br /><span class="colmain"><a href="http://www.nationalirishrallychampionship.com/" target="_blank">Dunlop National Rally Championship</a><br /><a href="http://www.southern4rallychampionship.com/" target="_blank">Southern 4 Rally Championship</a><br /><a href="http://www.motorsportireland.com/" target="_blank">Motorsport Ireland</a></span></div>
		</div>	

	
	<!-- Copyright -->
		<div id="copyright">&copy; Skibbereen &amp; District Car Club 2011 - <span id="getYear"></span><br />Designed by Alan Mulligan Web Design</div>
		
	</div>
  </body>
  </html> 
 
<?php
}
?>
