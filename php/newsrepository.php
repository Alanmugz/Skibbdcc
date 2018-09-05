<?php

class NewsRepository {

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
		require 'news.php';

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
	 * Get the latest news for the specified news category beetween the specified dates.
	 *
	 * @param int $category Category.
	 * @param int $startMonth Start month.
	 * @param int $finishMonth Finish month.
	 *
	 * @return News[] Returns a news array.
	 */
	function getLatestNewsForCategory(
		$category,
		$startMonth,
		$finishMonth)
	{
		$currentYear = date("Y");

		$sql = "SELECT publish_date, content, title, image, imgwidth, imgheight
				FROM pa_npro_news
				WHERE status ='Published'
				AND cat_id = $category
				AND YEAR(publish_date) = $currentYear
				AND MONTH(publish_date) >= $startMonth
				AND MONTH(publish_date) <= $finishMonth
				ORDER BY publish_date DESC";

		$result = $this->connection->query($sql);

		$newsItems = array();

		while($row = mysqli_fetch_array($result))
		{
			$news = new News();
			$news->setPublishDate($row['publish_date']);
			$news->setContent($row['content']);
			$news->setTitle($row['title']);
			$news->setImage($row['image']);
			$news->setImgwidth($row['imgwidth']);
			$news->setImgheight($row['imgheight']);

			array_push($newsItems, $news);
		}
		return $newsItems;
	}


	/**
	 * Get the latest news for the specified news category beetween the specified dates.
	 *
	 * @param int $category Category.
	 * @param int $startMonth Start month.
	 * @param int $finishMonth Finish month.
	 *
	 * @return News[] Returns a news array.
	 */
	function getLatestNewsForCategoryClubChampionship(
		$category,
		$startMonth,
		$finishMonth)
	{
		$currentYear = date("Y");
		$previousYear = date('Y', strtotime('-1 years'));

		$sql = "SELECT publish_date, content, title FROM pa_npro_news
				WHERE status ='Published'
				AND cat_id = $category
				AND YEAR(publish_date) BETWEEN $previousYear AND $currentYear
				AND MONTH(publish_date) >= $startMonth
				AND MONTH(publish_date) <= $finishMonth
				ORDER BY publish_date DESC";

		$result = $this->connection->query($sql);

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


	/**
	 * Get the latest news for the specified news category beetween the specified dates.
	 *
	 * @param int $category Category.
	 *
	 * @return News[] Returns a news array.
	 */
	function getLatestMarshalingEvent(
		$category)
	{
		$sql = "SELECT publish_date, content, title FROM pa_npro_news
				WHERE status ='Published'
				AND cat_id = $category
				ORDER BY publish_date DESC
				LIMIT 2";

		$result = $this->connection->query($sql);

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