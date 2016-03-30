<?php

class NewsRepository {
   
	private $conn;
   
    function connect(
		$dbname) 
	{
		require 'config.php';
		
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
	
	
	function getLatestNewsForCategory(
		$category)
	{
		$sql = "SELECT publish_date, content, summary FROM pa_npro_news 
		        WHERE status='Published'
				AND publish_date > '2016-01-01T00:00:00.000Z'
				AND cat_id=$category 
				ORDER BY publish_date DESC";
		$result = $this->conn->query($sql);
		
		while($row = mysqli_fetch_array($result))
		{
			echo $row['publish_date'];
		}
		
		$newsItems = array();
		
		/*while($row = mysqli_fetch_array($result))
		{
			$news = new news;
			$news->setPublishDate($row['publish_date']);
			$news->setContent($row['content']);
			$news->setSummary($row['summary']);
			
			array_push($newsItems, $news);
		}
		return $newsItems; */
	}
}
?> 