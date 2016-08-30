<?php

class NewsRepository {
   
	private $conn;
   
    function connect(
		$dbname) 
	{
		require 'config.php';
		require 'news.php';
		
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
		$category,
		$startMonth,
		$finishMonth)
	{
		$currentYear = date("Y");

        $sql = "SELECT publish_date, content, title FROM pa_npro_news 
		        WHERE status='Published'
				AND cat_id=$category 
				AND YEAR(publish_date) = $currentYear
				AND MONTH(publish_date) >= $startMonth
				AND MONTH(publish_date) <= $finishMonth
				ORDER BY publish_date DESC";
				
		$result = $this->conn->query($sql);

		$newsItems = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$news = new News();
			$news->setPublishDate($row['publish_date']);
			$news->setContent($row['content']);
			$news->setTitle($row['title']);
			
			array_push($newsItems, $news);
		}
		return $newsItems;
	}
	
	
	function getLatestNewsForCategoryClubChampionship(
		$category,
		$startMonth,
		$finishMonth)
	{
		$currentYear = date("Y");
		$previousYear = date('Y', strtotime('-1 years'));

        $sql = "SELECT publish_date, content, title FROM pa_npro_news 
		        WHERE status='Published'
				AND cat_id=$category 
				AND YEAR(publish_date) BETWEEN $previousYear AND $currentYear
				AND MONTH(publish_date) >= $startMonth
				AND MONTH(publish_date) <= $finishMonth
				ORDER BY publish_date DESC";
				
		$result = $this->conn->query($sql);

		$newsItems = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$news = new News();
			$news->setPublishDate($row['publish_date']);
			$news->setContent($row['content']);
			$news->setTitle($row['title']);
			
			array_push($newsItems, $news);
		}
		return $newsItems;
	}
	
	
	function getLatestMarshalingEvent(
		$category)
	{
        $sql = "SELECT publish_date, content, title FROM pa_npro_news 
		        WHERE status='Published'
				AND cat_id=$category 
				ORDER BY publish_date DESC
				LIMIT 1";
				
		$result = $this->conn->query($sql);

		$newsItems = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$news = new News();
			$news->setPublishDate($row['publish_date']);
			$news->setContent($row['content']);
			$news->setTitle($row['title']);
			
			array_push($newsItems, $news);
		}
		return $newsItems;
	}
}
?> 