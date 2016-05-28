<?php
	include 'dataconnection.php'; 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head><!--  ščřžýŠČŘŽÝ -->
  <meta name="generator" content="PSPad editor, www.pspad.com" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="The video gallery of Skibbereen &amp; District Car Club.">
  <meta name="keywords" content="Skibbereen and District Car Club, Skibbdcc, Westlodge Hotel, Skibbereen Motor Club, Fastnet Rally">
  <meta name="author" content="Alan Mulligan Web Design">
  <meta name="robots" content="index, follow"> 
  
  <title>Video Gallery</title>
  
  <script type="text/javascript" src="javascript/global.js"></script>
  <link rel="stylesheet" type="text/css" href="css/global.css"/>
  <link rel="icon" type="image/png" href="images/favicon.png"/> 
  
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <link type="text/css"
		href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" rel="stylesheet" />
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="jquery/jquery.youtubepopup.min.js"></script>  
  <script type="text/javascript">
		$(function () {
			$("a.youtube").YouTubePopup({ autoplay: 0 });
		});
  </script>
	 
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
				Video Gallery  
			</div>
			<?php
			
			// Create connection
			$connection=mysqli_connect("$host","$dbusername","$password","skibbdcc_video");

			// Check connection
			if (mysqli_connect_errno($con))
			  {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
			  
			$getvideo = mysqli_query($connection,"SELECT * FROM videodetails ORDER BY id DESC");

			while($row = mysqli_fetch_array($getvideo))
			{
				$title = $row['info']; 
				echo '<div id="displayvideo" title="'.$title.'"><a class="youtube" href="http://www.youtube.com/watch?v='.$row['youtube_id'].'"><img src="http://i4.ytimg.com/vi/'.$row['youtube_id'].'/hqdefault.jpg" width=147px height=106px style="border:solid 2px white;margin-left:15px;"></a></div>'; 
				$i++;
				if($i % 4 === 0)
				{
				echo "<br /><br /><br />"; 
				}
			}	
				  
			mysqli_close($connection);   
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
