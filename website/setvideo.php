<?php
include 'dataconnection.php';
// Check connection
if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else		
		$url = $_POST['set_video'];
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		
		$youtube_id = $my_array_of_vars['v'];
		
		$info = $_POST['set_desc'];
		
		$id = $my_array_of_vars['v'];  
		$xmlData = simplexml_load_string(file_get_contents("http://gdata.youtube.com/feeds/api/videos/{$id}?fields=title"));

		$title = (string)$xmlData->title; 
	
		
		
		$connection = mysqli_connect("localhost","skibbdcc_usernam","fastnetrally85","skibbdcc_video");
	
		$sql = sprintf("INSERT INTO videodetails SET id='null',youtube_id='$youtube_id',info='%s'",
			mysqli_real_escape_string($connection,$title)   
		);

		if (!mysqli_query($connection,$sql))
		  {
		  die('Error: ' . mysqli_error($connection)); 
		  }
		echo "<div id='pageheader'>
				1 record added<span id='logout'>Return to <a href='contributors_login.html'>Contributors Login</a></span>  
			 </div>";
			 
		echo '<div id="setvideo"><a href="http://www.youtube.com/watch?v='.$my_array_of_vars['v'].'" target="_blank"><img src="http://i4.ytimg.com/vi/'.$my_array_of_vars['v'].'/default.jpg" style="border:solid 2px white;"></a><p>'.$title.'</p></div>';

	mysqli_close($connection);  
?>
