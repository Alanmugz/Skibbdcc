<?php
require 'php/config.php';
include 'php/newsrepository.php';
include 'php/eventenumertion.php';
include 'php/function.php';
?>

<!DOCTYPE html>
<head>
    <title><?php echo $rallySponsor." "; ?> Fastnet Rally <?php echo $rallyEventYear; ?></title>

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

	<!-- http://fontawesome.io/cdn/success/ -->
	<script src="https://use.fontawesome.com/0ef5cb71bd.js"></script>		

</head>
<!-- Bottom menu -->
 <?php
    include ('include/event/fastnetrallybottommenu.html');
 ?>
<div class="container border10">	
    <div class="row row-margin height visible-lg">
        <div class="col-md-12 backgroundColor">
            <div id="header">
                <?php
                include ('include/header.html');
                ?>
            </div>
        </div>
    </div>
    <div style="margin-top:-20px">
        <?php
        include ('include/carousel.html');
        ?>
    </div>
    <div class="row visible-lg" style="padding-bottom:20px">
        <div class="col-md-12">
            <div> 
                <?php
                include ('include/menu.html');
                ?>
            </div>
        </div>
    </div>
    <div class="row hidden-lg">
        <?php
        include ('include/mobilemenu.html');
        ?>
    </div>		
    <div style="display:inline-block;margin:-25px 0px 15px 0px;">
    </div>		
    <div class="row">
        <div class="col-md-8">
            <div class = "panel panel-default backgroundColor font">
                <div class = "panel-heading">
                    <h3 class = "panel-title"><?php echo $rallySponsor." "; ?> Fastnet Rally <?php echo $rallyEventYear; ?></h3>
                </div>
                <div id='pageheader'>
                    <?php Common::NewsTemplate(
                        "Regulations and entry form are now available to download.",
                        "17-09-2016 14:30") 
                    ?>
                </div>
                <p class="setmargin">
                    Regulations and entry form for the 2016 Westlodge Hotel Fastnet Rally are now available to download 
                    from the competitor's section on the menu below or by clicking <a href="files/fastnet_2016/regs.doc">here</a>.<br />
					<br />
					if any competitors would like for a set of regulations to be post out to them we at Skibbereen & District Car Club 
					will do so by contacting club P.R.O Colm Feen on 0868626001. 
                </p>

				<div id='pageheader'>
					<?php Common::NewsTemplate(
						"Westlodge Hotel Fastnet Rally launch - Sunday 11th Of September @16:00",
						"06-09-2016 22:03") 
					?>
				</div>
				<p class="setmargin">
				Skibbereen & District Car Club will launch the 2016 Westlodge Hotel Fastnet Rally at the Westlodge Hotel, Bantry on Sunday 11th Of 
				September @16:00. All are welcome to attend. The club will provide a BBQ and finger food to attendees on the evening. The club has 
				also organised a few guest speakers to speak at the launch. 
				</p>
				
				<div id='pageheader'>
					<?php Common::NewsTemplate(
						"The Westlodge Hotel Fastnet Rally coming fast.",
						"29-08-2016 22:03") 
					?>
				</div>
				<p class="setmargin">
				It's nearly that time of year once again. The Westlodge Hotel Fastnet Rally is now just under two months away. This years Westlodge 
				Fastnet Rally organized by the Skibbereen & District Car Club is a counting round of the Plasticbags.ie Southern 4 Rally Championship 
				and the Carbery Plastic Skibbereen & District Car Club Championship. Many classes are yet to be decided making for an exciting bank 
				holiday weekend in Bantry.<br /><br />

				The Rally will be held on Sunday 30th October, the club have planned a two stage loop run three times based in close vicinity of Bantry 
				town. These classic stages will contain maximium allowed kilometres and are very technical. I have decided to set the entry fee at €385 
				plus Motorsport Ireland insurance increase of €180 this bring total entry fee of €565 this is simply to facilitate rally drivers who 
				want an enjoyable cost effective weekend.<br /><br />

				In the past competitors have being a faithful to our event and without this support we would find it next to impossible to continue 
				with our rally. With further ado I am inviting you to Bantry on the October bank holiday weekend and I hope you consider entering 
				our event. I am willing to help any competitor who wants to pay in advance or by instalments between here and our rally. Your 
				entry is of most importance to us and once again I thank you for your support in the past and look forward to hearing from you in 
				the next two months.<br /><br />

				Yours in motorsport<br /><br />

				Ger Hayes C.O.C
				</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class = "panel panel-default backgroundColor">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Next Event:</h3>
                </div>
                <div id="countdown-nextmeeting">
                    <?php
                    include('include/countdowntimer.html');
                    ?>
                </div>
            </div>
            <div class = "panel panel-default font">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Club Sponsors</h3>
                </div>
                <?php
                include('include/sponsors.html');
                ?>
            </div>
            <div class = "panel panel-default">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Social Media</h3>
                </div>
                <?php
                include('include/socialmedia.html');
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
                include('include/contactus.html');
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class = "panel panel-default font">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Club Events:</h3>
                </div>
                <?php
                include('include/clubevents.html');
                ?>
            </div>			
        </div>
        <div class="col-md-4">
            <div class = "panel panel-default font">
                <div class = "panel-heading">
                    <h3 class = "panel-title">In Association With:</h3>
                </div>
                <?php
                include('include/association.html');
                ?>
            </div>			
        </div>
    </div>
    <div class="row visible-lg">
        <div class="col-md-12">
            <div id="copyright" style="margin-bottom: 55px;">
                <?php
                include('include/copyright.html');
                ?>
            </div>
        </div>
    </div>
</div>
</html>