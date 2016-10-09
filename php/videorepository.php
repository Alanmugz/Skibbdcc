<?php

class VideoRepository {

	private $connection;


	/**
	 * Opens a connection to the specified database.
	 *
	 * @param string $dbname Database name.
	 */
    function connect(
		$dbname)
	{
		require 'config.php';

        $servername = $configs['db_servername'];
		$username = $configs['db_username'];
		$password = $configs['db_password'];

		// Create connection
		$this->connection = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($this->connection->connect_error) {
			die("Connection failed: " . $this->connection->connect_error);
		}
    }


	/**
	 * Closes a database connection.
	 */
	function close()
	{
		$this->connection->close();
	}


	/**
	 * Gets the four latest video and displays.
	 */
	function getLatestVideos()
	{
		$sql = "SELECT * FROM videodetails ORDER BY id DESC LIMIT 4";
		$result = $this->connection->query($sql);

		while($row = mysqli_fetch_array($result))
		{
			$title = $row['info'];
			echo '<div id="displayvideo" title="'.$title.'"><a class="youtube" href="http://www.youtube.com/watch?v='.$row['youtube_id'].'"><img src="http://i4.ytimg.com/vi/'.$row['youtube_id'].'/hqdefault.jpg" width=147px height=106px style="border:solid 2px white;margin-left:15px;margin-top:10px;margin-bottom:10px;"></a></div>';
		}
	}
}
?> 