<?php
	include ('dataconnection.php'); 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head><!--  ščřžýŠČŘŽÝ -->
  <meta name="generator" content="PSPad editor, www.pspad.com" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="A brief history of Skibbereen &amp; District Car Club.">
  <meta name="keywords" content="Skibbereen and District Car Club, Skibbdcc, Westlodge Hotel, Skibbereen Motor Club, Fastnet Rally, Club History">
  <meta name="author" content="Alan Mulligan Web Design">
  <meta name="robots" content="index, follow"> 
  
  <title>Club History</title>
  
  <script type="text/javascript" src="javascript/global.js"></script>
  <link rel="stylesheet" type="text/css" href="css/global.css"/>
  <link rel="icon" type="image/png" href="images/favicon.png"/> 
	 
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
				Club History  
			</div>
			<p style="padding-left:15px;padding-right:15px;">Mr. Michael O'Driscoll, who lived in Skibbereen was keenly interested in car Rallies and motoring in 
			general and early in 1961 he organized a Car Road Safety Rally in Skibbereen. A large Committee was 
			formed to run this rally and it was a major success.<br /><br />

			As a result of a very successful Road Safety Rally, which attracted an entry of 82 drivers, was held 
			in Skibbereen on September 24th 1961. With the £11 profit from this rally it was decided, in December 
			1961, to form the West Cork Motorcycle and Car club.<br /><br />

			In its heyday there were over 200 Club members and major Scramblers and Grasstrack races were organized 
			in Skibbereen and Dunmanway. Some of these events attracted crowds of several thousand people, and were 
			the main Sporting events in West Cork at this time.<br /><br />

			Several Veteran Car runs which attracted up to 100 entries from all over Ireland and Britain were also 
			organized and the Club also assisted in the running of the Circuit of Ireland Rally.<br /><br />

			The club ceased to be active in the early 1970's. On November 1977 a meeting was held in O'Brien's 
			Lounge Skibbereen to reform the Motor Club. In the lapsed years, car competitions became more popular 
			than bikes and the new club was called Skibbereen Motor Club. The Club was affiliated o the R.I.A.C. 
			in 1981 under its present name, Skibbereen and District Car Club and had its first dates on the 
			calendar in 1982.<br /><br />

			The first event run by the newly formed club was a Test-Trial in the public car park behind Gerald 
			O'Brien's Lounge and J.J. Fields of Main Street Skibbereen.<br /><br />

			In March 1982 the first rally was run by the Club. The Rally headquarters was Bernard O'Brien's, 
			Main Street Skibbereen and the Rally was called 'The Motovox Single Stage Rally'. It was run over 
			the Classic Tragumna Stage and was won by Demi Fitzgerald driving his famous black Chevette HSR. 
			October 1982 also saw the running of the first 'Fastnet Inn Hotel Schull Single Stage Rally' 
			which was won by Frank O'Mahony in his pristine Ford Escort RS 1800. 1989 saw the Marine Hotel 
			Fastnet Rally as the final round of the Anglo Irish Bank Corp. National Stages Rally Championship.<br /><br />

			The club continues to the present day and has approximately 225 club members. The club runs a range of 
			popular successful events throughout the sporting year such as two double autotests, two autocrosses, 
			two night navigation trials, an economy run and the club’s highlight of the year on the October Bank 
			Holiday Weekend – The Fastnet Rally.<br /><br />

			Skibbereen & District Car Club has made contributions to charity from monies raised at these events, 
			namely St Michael’s Home for the Elderly in Bandon, Marymount Hospice Cork, Cystic Fibrosis Unit 
			Cork University Hospital, West Cork Rapid Response, R.N.L.I, and others. We have also run events 
			for the children from the “Share a dream foundation”.<br /><br />


			The 2011 Westlodge Fastnet Rally moved from its home for the past  few years of Skibbereen to its new home 
			of Bantry. Clerk of the course for the event was again Ger Hayes. Ger and his hard working team can be found 
			week after week around the country helping out at all types of motorsport events.<br /><br />

			The Present officers of the Club are:<br />
			President: Alan Clarke<br />
			Chairman: Colm Feen<br />
			Secretary: Ger Hayes<br />
			Treasurer: John Coleman<br />
			Registrar: James Kingston<br />
			P.R.O Padraig McCarthy<br /><br />

			Club telephone number is 087 0560316</p>
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
