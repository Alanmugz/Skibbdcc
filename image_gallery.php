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
  
  <title>Image Gallery</title>
  <script type="text/javascript" src="jquery/jquery.js"></script>
  <script type="text/javascript" src="global.js"></script>
  <link rel="stylesheet" type="text/css" href="global.css"/>
  <link rel="icon" type="image/png" href="images/favicon.png"/>
  <link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet"> 
  <link type="text/css" href="jquery.jscrollpane.css" rel="stylesheet" media="all" />
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <script type="text/javascript" src="jquery.jscrollpane.min.js"></script>  
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/include/style.css">
  <link rel="stylesheet" type="text/css" href="css/tooltip.css"/>

<script>
	$(function() {
		$( document ).tooltip({
		position: {
		my: "center bottom-20",
		at: "center top",
		using: function( position, feedback ) {
		$( this ).css( position );
		$( "<div>" )
		.addClass( "arrow" )
		.addClass( feedback.vertical )
		.addClass( feedback.horizontal )
		.appendTo( this );
		}
		}
		});
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
	 
	<div id='cssmenu' style="margin-bottom:-13px;"> 
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
		 
		<div id="newsscroll">
			<div id='pageheader'> 
				Image Gallery 
			</div> 
			
			<?php
			// Create connection
			$con=mysqli_connect("$host","$dbusername","$password","skibbdcc_gallery");

			// Check connection
			if (mysqli_connect_errno($con))
			  {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }  		
		 
			$result = mysqli_query($con,"SELECT category, path FROM galleryinfo GROUP BY category ORDER BY id DESC");   
						
			while($row = mysqli_fetch_array($result)) 
				{
				?>  
					<div id="displayvideo"><a href="http://www.skibbdcc.com/image_display_gallery.html?gallery=<?php echo $row['category'];?>" title="<?php echo $row['category'];?>"><img src="<?php echo $row['path'];?>" width="200px" height="156px" style="border:solid 2px white;margin-left:15px;"></a></div>	
					
					<?php
						$i++;
						if($i % 3 === 0)
						{
						echo "<br /><br /><br />";  
						}
					?>				
				<?php
				}  
			 // Check connection
			if (mysqli_connect_errno($con))   
				{
					echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
				}   
			?> 
		</div>    
		 
	<div id="newsrow">
		<?php 
			include ('include/sidebar.html'); 
		?>
	</div>
		
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
