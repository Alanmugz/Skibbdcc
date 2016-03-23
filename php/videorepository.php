<?php

include('config.php');

class VideoRepository {
   
	private $conn;
   
    function connect(
		$dbname) 
	{
        $servername = $configs['db_servername'];
		$username = $configs['db_username'];
		$password = $configs['db_password'];

		// Create connection
		$this->conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		}
    }
	
	
	function close()
	{
		$this->conn->close();
	}
	
	
	function getLatestVideos()
	{
		$sql = "SELECT * FROM videodetails ORDER BY id DESC LIMIT 4";
		$result = $this->conn->query($sql);
		$videos = "";
		
		while($row = mysqli_fetch_array($result))
		{
			$title = $row['info']; 
			echo '<div id="displayvideo" title="'.$title.'"><a class="youtube" href="http://www.youtube.com/watch?v='.$row['youtube_id'].'"><img src="http://i4.ytimg.com/vi/'.$row['youtube_id'].'/hqdefault.jpg" width=147px height=106px style="border:solid 2px white;margin-left:15px;margin-top:10px;margin-bottom:10px;"></a></div>';
		}
	}
}
?> 