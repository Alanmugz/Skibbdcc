<?php
	include ('dataconnection.php'); 
	
	if(!isset($configs_are_set)) {
		include("scriptfolder/configs.php");
	}

    //Facebook data from datbase
	$sql = "SELECT title, summary FROM ".$TABLE["News"]." WHERE status='Published' AND id='".mysql_real_escape_string($_REQUEST["id"])."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	if(mysql_num_rows($sql_result)>0) {	
	  $News = mysql_fetch_assoc($sql_result);
	}
	 
	$titlefb = ReadDB($News["title"]);
	$descfb = ReadDB($News["summary"]);  

?> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
 <head><!--  ščřžýŠČŘŽÝ -->
  <meta name="generator" content="PSPad editor, www.pspad.com" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="Skibbereen &amp; District Car Club. Home of the Westlogde Fastent Rally"/>
  <meta name="keywords" content="Skibbereen and District Car Club, Skibbdcc, Westlodge Hotel, Skibbereen Motor Club, Fastnet Rally"/>
  <meta name="author" content="Alan Mulligan Web Design"/>
  <meta name="robots" content="index, follow"/>

  <!-- for Facebook -->          
  <meta property="og:title" content="<?php echo $titlefb; ?>" />
  <meta property="og:type" content="article" />
  <meta property="og:image" content="http://www.skibbdcc.com/images/facebook_skibbdcc_logo.png" />
  <meta property="og:url" content="<?php echo "http://www.skibbdcc.com".$_SERVER['REQUEST_URI']; ?>" /> 
  <meta property="og:description" content="<?php echo $descfb; ?>" />
  
  <!-- for Twitter -->        
  <meta name="twitter:card" content="summary">
  <meta name="twitter:url" content="<?php echo "http://www.skibbdcc.com".$_SERVER['REQUEST_URI']; ?>">  
  <meta name="twitter:title" content="<?php echo $titlefb; ?>">
  <meta name="twitter:description" content="<?php echo $descfb; ?>">
  <meta name="twitter:image" content="http://www.skibbdcc.com/images/facebook_skibbdcc_logo.png"> 
  
  <title>Skibbereen &amp; District Car Club</title>
  <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
  <script type="text/javascript">var _siteRoot='index.html',_root='index.html';</script>
  <script type="text/javascript" src="jquery/jquery.js"></script>
  <script type="text/javascript" src="javascript/scripts.js"></script>
  <script type="text/javascript" src="javascript/global.js"></script>
  <link rel="stylesheet" type="text/css" href="css/global.css"/>
  <link rel="icon" type="image/png" href="images/favicon.png"/>  
  
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <link type="text/css"	href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" rel="stylesheet" /> 
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="jquery/jquery.youtubepopup.min.js"></script>  
  <script type="text/javascript">
		$(function () {
			$("a.youtube").YouTubePopup({ autoplay: 0 });
		});
  </script>
	 
  </head>  
  <body onload="checkForMeeting(meetingDetails, isMeetingSet)">
   
  <div id="container">
	<!-- header -->
	<div id="header">
		<?php 
			include ('include/header.html');   
		?>
    </div>
	
	  <!--/top-->
	<div id="header">
		<div class="wrap">
			<div id="slide-holder">
				<div id="slide-runner">
					<a href=""><img id="slide-img-1" src="images/slider/img14.jpg" class="slide" alt="" width="1000px"/></a>   
					<a href=""><img id="slide-img-2" src="images/slider/img18.jpg" class="slide" alt="" width="1000px"/></a>   
					<a href=""><img id="slide-img-3" src="images/slider/img16.JPG" class="slide" alt="" width="1000px"/></a>
					<a href=""><img id="slide-img-4" src="images/slider/img4.jpg" class="slide" alt="" width="1000px"/></a>
					<a href=""><img id="slide-img-5" src="images/slider/img12.jpg" class="slide" alt="" width="1000px"/></a>
					<a href=""><img id="slide-img-6" src="images/slider/img2.jpg" class="slide" alt="" width="1000px"/></a>     
				</div>
			
			<!--content featured gallery here -->
		   </div>
	   <script type="text/javascript"> 
		if(!window.slider) var slider={};slider.data=[{"id":"slide-img-1","client":"nature beauty","desc":"nature beauty photography"},
													  {"id":"slide-img-2","client":"nature beauty","desc":"add your description here"},
													  {"id":"slide-img-3","client":"nature beauty","desc":"add your description here"},
													  {"id":"slide-img-4","client":"nature beauty","desc":"add your description here"},
													  {"id":"slide-img-5","client":"nature beauty","desc":"add your description here"},
													  {"id":"slide-img-6","client":"nature beauty","desc":"add your description here"}]; 
	   </script>
	   </div>
   </div><!--/header-->
	
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
			include ('getMeeting2.php'); 
		?>
		
		<script type='text/javascript'>
			var meetingDetails = "<?php Print($meetingDetails); ?>";
			var isMeetingSet = "<?php Print($isMeetingSet); ?>";
		</script>
		
		<div id="news">
			<div id='pageheader'>
				Club News  
			</div>
			<?php 
				include("/home/skibbdcc/public_html/scriptfolder/news.php"); 
			?>    
		</div>   
		 
		<div id="newsrow">
			<?php 
				include ('include/sidebar.html'); 
			?>
		</div>

		<div id="video">
		   <div id='videoheader'>
				Latest Videos    
		   </div>
		   
		   <?php
			// Create connection
			$connection=mysqli_connect("$host","$dbusername","$password","skibbdcc_video");

			// Check connection
			if (mysqli_connect_errno($connection))
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}

			$getvideo = mysqli_query($connection,"SELECT * FROM videodetails ORDER BY id DESC LIMIT 4");

			while($row = mysqli_fetch_array($getvideo))
			{
				$title = $row['info']; 
				echo '<div id="displayvideo" title="'.$title.'"><a class="youtube" href="http://www.youtube.com/watch?v='.$row['youtube_id'].'"><img src="http://i4.ytimg.com/vi/'.$row['youtube_id'].'/hqdefault.jpg" width=147px height=106px style="border:solid 2px white;margin-left:15px;"></a></div>'; 
			}	
				  
			mysqli_close($connection);    
		   ?> 
		</div>
	   
		<!-- footer -->
		<div id="footer"> 
			<?php
				include ('include/footer.html');
			?>
		</div>	

		 <!-- Copyright -->
		<div id="copyright">&copy; Skibbereen &amp; District Car Club 2011 - <span id="getYear"></span><br />Designed by Alan Mulligan Web Design
		</div>
	
	</div>
  </body>
  </html>   
