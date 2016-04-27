<!DOCTYPE html>
<head>
    <title>Carbery Night Navigation Trial Map</title>

    <meta name="generator" content="PSPad editor, www.pspad.com" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Skibbereen &amp; District Car Club. Home of the Westlogde Fastent Rally"/>
    <meta name="keywords" content="Skibbereen and District Car Club, Skibbdcc, Westlodge Hotel, Skibbereen Motor Club, Fastnet Rally, Carbery Night Navigation Trial"/>
    <meta name="author" content="Alan Mulligan Web Design"/>
    <meta name="robots" content="index, follow"/>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="cssbootstrap/style.css" type="text/css" media="screen" />
    <script type="text/javascript" src="jquery/jquery.js"></script>
    <script type="text/javascript" src="javascript/scripts.js"></script>
    <script type="text/javascript" src="javascript/global.js"></script>
    <link rel="stylesheet" type="text/css" href="cssbootstrap/global.css"/>
    <link rel="icon" type="image/png" href="images/favicon.png"/>  

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" rel="stylesheet" /> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>

    <!-- Timer -->
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	
	<!-- Maps -->
	<link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>  

</head>
<div class="container border10">	
    <div class="row row-margin height visible-lg">
        <div class="col-md-12">
            <div id="header">
                <?php
                include ('includebootstrap/header.html');
                ?>
            </div>
        </div>
    </div>
    <div style="margin-top:-20px">
        <?php
        include ('includebootstrap/carousel.html');
        ?>
    </div>
    <div class="row visible-lg" style="padding-bottom:20px">
        <div class="col-md-12">
            <div id='cssmenu'> 
                <?php
                include ('include/menu.html');
                ?>
            </div>
        </div>
    </div>
    <div class="row hidden-lg">
        <?php
        include ('includebootstrap/mobilemenu.html');
        ?>
    </div>		
    <div style="display:inline-block;margin:-25px 0px 15px 0px;">
        <?php
        include ('includebootstrap/event/carberymenu.html');
        ?>
    </div>		
    <div class="row">
        <div class="col-md-8">
            <div class = "panel panel-default backgroundColor font">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Map</h3>
                </div>
                <script>
					function initialize() {
					    var myLatlng = new google.maps.LatLng(51.583723, -9.148854); 
					    var mapOptions = {
						  zoom: 12,
						  center: myLatlng,
						  mapTypeId: google.maps.MapTypeId.ROADMAP
					    }
                        
					    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                        
					    var contentString = 
						    '<div style="background-color:black;padding:10px;">'+ 
						    '<p style="color:white;">Carbery Night Nav</p>'+
						    '<p style="color:white;">Killmacabea, Leap, Co.Cork</p>'+
						    '</div>'; 
                        
					    var infowindow = new google.maps.InfoWindow({
						    content: contentString
					    });
                        
					    var marker = new google.maps.Marker({
						    position: myLatlng,
						    map: map,
						    title: 'Quailty Hotel, Clonakilty, Co.Cork' 
					    });
					    google.maps.event.addListener(marker, 'click', function() {
						  infowindow.open(map,marker);
					    });
					}

					google.maps.event.addDomListener(window, 'load', initialize);
				</script>
	
			<div id="map-canvas" style="width:97%;height:400px; margin: 10px auto 10px auto"></div>
            </div>

            <div class = "panel panel-default visible-lg backgroundColor">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Latest Videos</h3>
                </div>
                <?php
                include('includebootstrap/video.html');
                ?>    
            </div>
        </div>

        <div class="col-md-4">
            <div class = "panel panel-default backgroundColor">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Next Event:</h3>
                </div>
                <div id="countdown-nextmeeting">
                    <?php
                    include('includebootstrap/countdowntimer.html');
                    ?>
                </div>
            </div>
            <div class = "panel panel-default font">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Club Sponsors</h3>
                </div>
                <?php
                include('includebootstrap/sponsors.html');
                ?>
            </div>
            <div class = "panel panel-default">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Social Media</h3>
                </div>
                <?php
                include('includebootstrap/socialmedia.html');
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class = "panel panel-default font">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Contact Us:</h3>
                </div>
                <?php
                include('includebootstrap/contactus.html');
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class = "panel panel-default font">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Club Events:</h3>
                </div>
                <?php
                include('includebootstrap/clubevents.html');
                ?>
            </div>			
        </div>
        <div class="col-md-4">
            <div class = "panel panel-default font">
                <div class = "panel-heading">
                    <h3 class = "panel-title">In Association With:</h3>
                </div>
                <?php
                include('includebootstrap/association.html');
                ?>
            </div>			
        </div>
    </div>
    <div class="row visible-lg">
        <div class="col-md-12">
            <div id="copyright">
                <?php
                include('includebootstrap/copyright.html');
                ?>
            </div>
        </div>
    </div>
</div>
</html>