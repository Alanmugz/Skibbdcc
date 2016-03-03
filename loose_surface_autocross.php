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
  
  <title>Loose Surface AutoCross</title>
  
  <script type="text/javascript" src="jquery/jquery.js"></script>
  <script type="text/javascript" src="javascript/global.js"></script>
  <link rel="stylesheet" type="text/css" href="css/global.css"/>
  <link rel="icon" type="image/png" href="images/favicon.png"/>
  <link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet"> 
  <link type="text/css" href="jquery/jquery.jscrollpane.css" rel="stylesheet" media="all" />
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <script type="text/javascript" src="jquery/jquery.jscrollpane.min.js"></script>
  <script type="text/javascript" src="http://stratus.sc/stratus.js"></script>
	 
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
	 
	<div id='cssmenu' style="margin-bottom:-13px;"> 
		<?php 
			include ('include/menu.html'); 
		?>
	</div>
	<div id="submenu">
				<ul id="nav">
					<li><a href="loose_surface_autocross.php" class="selected">Latest</a></li>
					<li><a href="files/ls_autocross/2016/regs.doc">Regs</a></li>
					<li><a href="files/ls_autocross/2016/regs.doc">Entry Form</a></li>
					<li><a href="map_lsautocross.php">Map</a></li>  
					<li><a href="files/ls_autocross/2016/results.pdf">Results</a></li>  
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
			<div id='pageheader'>
				Loose Surface Autocross 28th February 2016
			</div >
			<span class="newstitle">Loose Surface Autocross Images</span><span class="newsdate">3rd March 2016</span>
			<p class="setmargin">
			<p class="setmargin">Images by Pablo Photography & Ted O'Connell</p>
			<?php
			$images = array("IMG_0513-2.jpg","IMG_0145.jpg","IMG_0317.jpg", "IMG_9923.jpg", "IMG_0147.jpg", "IMG_0410-2.jpg", "IMG_0755.jpg", "IMG_1168.jpg", "IMG_9923.jpg", "IMG_1106.jpg", "IMG_9621.jpg", "IMG_0877.jpg");
			$count = 0;
			foreach ($images as &$image) {
				?>
				<div id="displayvideo"><img src="<?php echo 'files/ls_autocross/2016/images/'.$image;?>" width="200px" height="156px" style="border:solid 2px white;margin-left:15px;"></div>
				<?php
				$count++;
				if($count % 3 === 0)
				{
					echo "<br /><br /><br />";  
				}
			}
			?>
			</p> 
			
			<span class="newstitle">Loose Surface Autocross Results</span><span class="newsdate">1st March 2016</span>
			<p class="setmargin"> 
			Autocross results can now be downloaded by clicking the tab marked results above.<br />
			A detailed list of all award winner is also available to download by clicking <a href="files/ls_autocross/2016/awards.pdf" style="color:red; text-decoration:underline;">here</a>
			</p> 
			<span class="newstitle">Loose Surface Autocross</span><span class="newsdate">17th February 2016</span>
			<p class="setmargin"> 
			The February Autocross, a counting round of the Munster AutoCross Championship will take place on Sunday 28th February 2016 in Kilnadur, Dunmanway, Co Cork.
			The event will be Arrowed from Kilmichael, Coppeen & Dunmanway.  Venue GPS: N51.7813958  W9.0926125.<br />
			C.O.C of the Event is Eoghan Mc Carthy<br />
			<br />			
			Regs and entry form are available to download from the tab's above marks "regs" and "entry form" respectively.
			</p> 			 
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
