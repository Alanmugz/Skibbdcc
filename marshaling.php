<?php
require 'php/config.php';
include 'php/newsrepository.php';
include 'php/eventenumertion.php';
include 'php/function.php';
?>

<!DOCTYPE html>
<head>
    <title>Marshaling</title>

    <meta name="generator" content="PSPad editor, www.pspad.com" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Skibbereen &amp; District Car Club. Home of the Westlogde Fastent Rally"/>
    <meta name="keywords" content="Skibbereen and District Car Club, Skibbdcc, Westlodge Hotel, Skibbereen Motor Club, Fastnet Rally, 100 Isles Night Navigation Trial"/>
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
    <!-- <div style="display:inline-block;margin:-25px 0px 15px 0px;">
        <?php
        include ('includebootstrap/event/100islesmenu.html');
        ?>
    </div>	 -->	
    <div class="row">
        <div class="col-md-8">
            <div class = "panel panel-default backgroundColor font">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Marshaling</h3>
					<?php
					$repository = new NewsRepository;
					$repository->connect("skibbdcc_news");

					$newsItems = $repository->getLatestMarshalingEvent(EventEnumertion::Marshaling);

					foreach ($newsItems as $news) {
						?>
						<div id='pageheader'>
							<?php Common::NewsTemplate($news->getTitle(), $news->getPublishDate()) ?>
						</div>

						<p class="setmargin"> 
							<?php echo $news->getContent(); ?>
						</p>
						<?php
					}
					$repository->close();
					?>
					</div>
						<div id='pageheader'>
						<?php Common::NewsTemplate(
							"Marshaling do's and don'ts",
							"30-08-2016 21:03") 
						?>
					</div>

                    <p class="setmargin">
						Skibbereen & District Car Club are always looking for marshals to participate on club event as well as event outside the club control
						every year the club runs stages at the West Cork Rally, Rally Of The Lakes, Circuit Of Munster, Raven Rock, Imokelly, Cork Forest,
						Cork 20 International Rally, our own event the Fastnet Rally  and  the Historic Lakes.<br /><br />

						What to bring with you marshaling:<br />
						Hi-vis vest.<br />
						Rain gear waterproof boots warm clothing a spare change of clothing in the event of weather turning bad.<br />
						Food hot/cold drink.<br /><br />

						When marshaling, think safety at all times.<br />
						Always stay alert and be prepared for the unexpected.<br />
						Look out for the safety of you colleagues and spectators.<br />
						Do not stand or sit in prohibited area/box junction escape roads or on the outside of bends/the road verge, after yumps, behind obstacles used of chicanes.<br />
						Do not turn your back to oncoming rally traffic. <br />
						Use of camera/camcorder, consumption of alcohol while marshalling is prohibited.<br /><br />

						Always ensure you have an escape route in case something should go wrong.<br /><br />

						For more information on marshaling:<br />
						Ger Hayes 0970560316<br />
						Ted Murphy 0878341145<br />
                    </p>
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