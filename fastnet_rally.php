<?php
require 'php/config.php';
include 'php/newsrepository.php';
include 'php/eventenumertion.php';
?>

<!DOCTYPE html>
<head>
    <title>Westlodge Fastnet Rally <?php echo $rallyEventYear; ?></title>

    <meta name="generator" content="PSPad editor, www.pspad.com" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Skibbereen &amp; District Car Club. Home of the Westlogde Fastent Rally"/>
    <meta name="keywords" content="Skibbereen and District Car Club, Skibbdcc, Westlodge Hotel, Skibbereen Motor Club, Fastnet Rally"/>
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
                include ('includebootstrap/menu.html');
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
    </div>		
    <div class="row">
        <div class="col-md-8">
            <div class = "panel panel-default backgroundColor font">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Westlodge Fastnet Rally <?php echo $rallyEventYear; ?></h3>
                </div>
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
            <div id="copyright" style="margin-bottom: 55px;">
                <?php
                include('includebootstrap/copyright.html');
                ?>
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-md-12">
            <div>
			<nav role="navigation" class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="fastnet_rally.php" class="navbar-brand">Westlodge Fastnet Rally</a>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="fastnet_rally.php">Latest</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Competitor<b class="caret"></b></a>
					<ul class="dropdown-menu">
					  <li><a href="#">Regulations</a></li>
					  <li><a href="#">Entry Form</a></li>
					  <li><a href="#">Final Instruction 1</a></li>
					  <li><a href="#">Time & Distance</a></li>
					</ul>
					</li>
                <li><a href="fastnet_entry_list.php">Entry List</a></li>
                <li><a href="fastnet_results.php">Results</a></li>
                <li><a href="fastnet_maps.php">Map</a></li>
                <li><a href="fastnet_accomodation.php">Accommodation</a></li>
                <li><a href="fastnet_prog_outlets.php">Program Outlets</a></li>
                <li><a href="fastnet_marshals.php">Marshals</a></li>
            </ul>
        </div>
    </div>
</nav>


<style type="text/css">
.navbar-default {
  background-color: #E4F3F6;
  border-color: #0B6122;
}
.navbar-default .navbar-brand {
  color: #000000;
}
.navbar-default .navbar-brand:hover,
.navbar-default .navbar-brand:focus {
  color: #000000;
}
.navbar-default .navbar-text {
  color: #000000;
}
.navbar-default .navbar-nav > li > a {
  color: #000000;
}
.navbar-default .navbar-nav > li > a:hover,
.navbar-default .navbar-nav > li > a:focus {
  color: #000000;
}
.navbar-default .navbar-nav > li > .dropdown-menu {
  background-color: #FAFAFA;
}
.navbar-default .navbar-nav > li > .dropdown-menu > li > a {
  color: #000000;
}
.navbar-default .navbar-nav > li > .dropdown-menu > li > a:hover,
.navbar-default .navbar-nav > li > .dropdown-menu > li > a:focus {
  color: #000000;
  background-color: #FAFAFA;
}
.navbar-default .navbar-nav > li > .dropdown-menu > li > .divider {
  background-color: #0B6122;
}
.navbar-default .navbar-nav .open .dropdown-menu > .active > a,
.navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
.navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
  color: #000000;
  background-color: #0B6122;
}
.navbar-default .navbar-nav > .active > a,
.navbar-default .navbar-nav > .active > a:hover,
.navbar-default .navbar-nav > .active > a:focus {
  color: #000000;
  background-color: #0B6122;
}
.navbar-default .navbar-nav > .open > a,
.navbar-default .navbar-nav > .open > a:hover,
.navbar-default .navbar-nav > .open > a:focus {
  color: #000000;
  background-color: #0B6122;
}
.navbar-default .navbar-toggle {
  border-color: #0B6122;
}
.navbar-default .navbar-toggle:hover,
.navbar-default .navbar-toggle:focus {
  background-color: #0B6122;
}
.navbar-default .navbar-toggle .icon-bar {
  background-color: #000000;
}
.navbar-default .navbar-collapse,
.navbar-default .navbar-form {
  border-color: #000000;
}
.navbar-default .navbar-link {
  color: #000000;
}
.navbar-default .navbar-link:hover {
  color: #000000;
}

@media (max-width: 767px) {
  .navbar-default .navbar-nav .open .dropdown-menu > li > a {
    color: #000000;
  }
  .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
  .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
    color: #000000;
  }
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a,
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
    color: #000000;
    background-color: #0B6122;
  }
}
</style>
            </div>
        </div>
    </div>
</div>
</html>