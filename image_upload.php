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
  <script type="text/javascript" src="jquery/jquery.js"></script>
  <script type="text/javascript" src="javascript/global.js"></script>
  <link rel="stylesheet" type="text/css" href="css/global.css"/>
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
	 
	<div id='cssmenu' style="margin-bottom:-13px;"> 
		<ul>
		   <li class='active'><a href='index.html'><span>Home</span></a></li>
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
			<li class='has-sub'><a href='club_championship.html'><span>Club Championship <span id="getClubChampionshipYear"></span></span></a></li>
			<li class='has-sub'><a href='#'><span>Gallery</span></a>
					<ul>
					   <li class='last'><a href='image_gallery.html'><span>Image Gallery</span></a></li> 
					   <li class='last'><a href='video_gallery.html'><span>Video Gallery</span></a></li>
					</ul>  			   
			</li> 
			<li class='has-sub'><a href='dinner_dance.html'><span>Dinner Dance</span></a></li>
			<li class='has-sub'><a href='contact_us.html'><span>Contact Us</span></a></li>
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
		 
		<div id="newsscroll">
			 
			<?php 
				 $gallery = $_POST["setcategory"];
				 $setcategory = $_POST["addcategory"]; 
				 
				 if (!file_exists('uploads/'.$gallery)) {
					mkdir('uploads/'.$gallery);
				 }
				 
				 $target = 'uploads/'.$gallery.'/';  
				 $target = $target . basename( $_FILES['uploaded']['name']) ; 
				 $ok=1; 
				 
				 //This is our size condition 
				 if ($uploaded_size > 350000) 
				 { 
				 echo "Your file is too large.<br>"; 
				 $ok=0; 
				 } 
				 
				 //This is our limit file type condition 
				 if ($uploaded_type == "text/php") 
				 { 
				 echo "No PHP files<br>"; 
				 $ok=0; 
				 } 
				 
				 //Here we check that $ok was not set to 0 by an error 
				 if ($ok==0)    
				 { 
				 Echo "Sorry your file was not uploaded"; 
				 } 
				  
				 //If everything is ok we try to upload it 
				 else 
				 { 
				 if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
				 {
				 echo "<div id='pageheader'>
								1 record added <span id='logout'>Return <a href='logged_in.html'>to Uploader</a></span>    
							 </div><br />
							 ";
				 echo "<div style='margin-left:15px;'>$target<br />";  
				 echo "New Cat: ".$gallery;
				 echo "<br />The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded</div>";
				 
				 // Create connection
				 $con=mysqli_connect("localhost","skibbdcc_usernam","fastnetrally85","skibbdcc_gallery");

				 $sql="INSERT INTO galleryinfo SET id='null',path='$target',category='$gallery'";
				 
				 if (!mysqli_query($con,$sql)) 
						  {
						  die('Error: ' . mysqli_error($con)); 
						  }
						
						
				 // Check connection
				 if (mysqli_connect_errno($con))
				  {
				  echo "Failed to connect to MySQL: " . mysqli_connect_error();
				  }
				  
				 }  
				 else 
				 { 
				 echo "Sorry, there was a problem uploading your file."; 
				 } 
				 } 
				 ?> 
			
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
