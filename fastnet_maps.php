<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head><!--  ščřžýŠČŘŽÝ -->
  <meta name="generator" content="PSPad editor, www.pspad.com" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="The Westlodge Fastnet Rally will agian start over looking the beautiful bantry bay">
  <meta name="keywords" content="Maps, Westloge Fastnet Rally 2013, Entry form, regulations, maps, programmes, Skibbereen and District Car Club, Skibbdcc, Westlodge Hotel, Skibbereen Motor Club, Fastnet Rally">
  <meta name="author" content="Alan Mulligan Web Design">
  <meta name="robots" content="index, follow"> 
  
  <title>Westlodge Fastnet Rally 2015 - Maps</title> 
  
  <script type="text/javascript" src="jquery/jquery.js"></script>
  <script type="text/javascript" src="javascript/global.js"></script>
  <link rel="stylesheet" type="text/css" href="css/global.css"/>
  <link rel="icon" type="image/png" href="images/favicon.png"/>
  <link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet">
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>  
	 
  </head>  
  <body>  
   
  <div id="container">
	<!-- header -->
	<div id="header">
		<img src="images/header.jpg" alt="image header" /> 
		<div id="header_font"><img src="images/fastnet_header.png" alt="image header"/></div>
		
    </div>
	<!-- Menu Bar -->
	<div id="menu">
	 
	<div id='cssmenu' style="margin-bottom:-13px;">  
		<?php 
			include ('include/menu.html'); 
		?>
	</div>
		<div id="submenu2" style="position:relative;top:14px;z-index:1;">
			<ul>
				<li><a href="fastnet_rally.php">Latest</a></li>  
				<li><a href="fastnet_competitors.php">Competitors</a>
					<ul>
						<li><a href="files/fastnet2015/Regulations.doc" class="selected">Regs/Entry Form</a></li>
						<li><a href="#" class="selected" target="_blank">Final Instruction</a></li>
						<li><a href="#" class="selected" >Time & Distance</a></li>
					</ul>
				</li> 
				<li><a href="fastnet_entry_list.php">Entry List</a></li>
				<li><a href="fastnet_results.php">Results</a></li>
				<li class="selected"><a href="fastnet_maps.php">Maps</a></li> 
				<li><a href="fastnet_accomodation.php">Accommodation</a></li>
				<li><a href="fastnet_prog_outlets.php">Prog Outlets</a></li>
				<li><a href="fastnet_marshals.php">Marshals</a></li> 
			</ul> 
		</div>		 	 
	</div>
  	
	<!-- Main Content --> 
	<div class="wrapper">
		<div id="news">
			<div id='pageheader'>
				Westlodge Fastnet Rally - Maps
			</div>
		
		
<script type="text/javascript">
function initialize() {
	var i;
	var arrDestinations = [
		{
			lat: 51.672662, 
			lon: -9.474592, 
			title: "HQ & Parc Ferme", 
			description: "HQ & Parc Ferme",   
		},
		{
			lat: 51.660737,   
			lon: -9.470724,
			title: "Scrutiny", 
			description: "Scrutiny, Barrys Of Bantry"
		},
		{
			lat: 51.663439,  
			lon: -9.476234, 
			title: "Trailer Park", 
			description: "Trailer Park,\nBantry Business Park"
		},
		{
			lat: 51.681177,   
			lon: -9.454851, 
			title: "Service Area", 
			description: "Service Area"
		}
	];
	
	var myOptions = {
		zoom: 13,
		center: new google.maps.LatLng(51.673270, -9.467500),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
	var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
	
	var infowindow =  new google.maps.InfoWindow({
		content: ''
	});
	
	// loop over our array 
	for (i = 0; i < arrDestinations.length; i++) {
		// create a marker
		var marker = new google.maps.Marker({
			title: arrDestinations[i].title,
			position: new google.maps.LatLng(arrDestinations[i].lat, arrDestinations[i].lon),   
			map: map
		});
		
		// add an event listener for this marker 
		bindInfoWindow(marker, map, infowindow, "<p class='tooltip'>" + arrDestinations[i].description + "</p>");  
	}
}

function bindInfoWindow(marker, map, infowindow, html) { 
	google.maps.event.addListener(marker, 'mouseover', function() { 
		infowindow.setContent(html); 
		infowindow.open(map, marker); 
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
