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
  
  <title>Treasure Hunt/Fun Day</title> 
  <script type="text/javascript" src="jquery/jquery.js"></script>
  <script type="text/javascript" src="javascript/global.js"></script>
  <link rel="stylesheet" type="text/css" href="css/global.css"/>
  <link rel="icon" type="image/png" href="images/favicon.png"/>
  <link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet">
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>  
	 
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
					<li><a href="economy_run.php">Latest</a></li>
					<li><a href="map_treasurehunt.php" class="selected">Map</a></li>  
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
				Map Treasure Hunt  
			</div>
<script>
	
function initialize() {
  var myLatlng = new google.maps.LatLng(51.571809,-9.009964); 
  var mapOptions = {
    zoom: 12,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var contentString = 
	  '<div style="background-color:black;padding:10px;">'+ 
      '<p style="color:white;">Treasure Hunt/Fun Day</p>'+
      '<p style="color:white;">Ryans Filling Station, Rosscarbery</p>'+
      '</div>'; 

  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Ryans Filling Station, Rosscarbery'
  });
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
	
			<div id="map-canvas" style="width:650px;height:400px;margin-left:15px;margin-right:15px;"></div> 
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
