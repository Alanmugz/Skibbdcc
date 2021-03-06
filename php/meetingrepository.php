<?php

class MeetingRepository {

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
	 * Determines if a meeting is within the last 10 days.
	 *
	 * @param Logger $logger Logger.
	 *
	 * @return boolean Returns a boolean value to determine if a meeting is within the last 10 days.
	 */
	function isMeetingWithinTheLast10Days(
		$logger)
	{
		$sql = "SELECT * FROM meetingdetails";
		$result = $this->connection->query($sql);
		$meetingDate = "";
		$now = date("Y-m-d");

		while($row = mysqli_fetch_array($result))
		{
			$meetingDate = date("Y-m-d G:i:s", strtotime($row['meetingDate']));
		}
		$logger->info('Meeting date from database: '.$meetingDate);
		$logger->info('Current date: '.$now);
		if($now <= $meetingDate)
		{
			$logger->info("Current date less then or equal to meeting date");
			$diff = abs(strtotime($meetingDate) - strtotime($now));

			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
			$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

			if(($days >= 0 && $days <= 10) && $months == 0 && $years == 0)
			{
				return true;
			}
			return false;
		}
		return false;
	}


	/**
	 * Gets the latest meeting details.
	 *
	 * @return string Returns a string reperesenting the meeting data and time.
	 */
	function meetingDetails()
	{
		$sql = "SELECT * FROM meetingdetails";
		$result = $this->connection->query($sql);

		while($row = mysqli_fetch_array($result))
		{
			return $row['day'] . " " . $row['date'] . " " . $row['month'] . "<br />" . $row['venue'] . "<br />at " . $row['time']." Sharp";
		}
		return "";
	}


	/**
	 * Saves a meetings details.
	 *
	 * @param string $date Date.
	 * @param string $time Time.
	 * @param string $venue Venue.
	 * @param Logger $logger Logger.
	 *
	 * @return boolean Returns a boolean value to determine if a meeting details have been saved to the repository.
	 */
	function saveMeetingDetails(
		$date,
		$time,
		$venue,
		$logger)
	{
		$dateWithTime = $date." 21:30:00";
		$logger->info('Date With Time: '.$dateWithTime);
		$date = new DateTime($dateWithTime);

		$day3LetterFormat = $date->format('D');
		$logger->info('Day 3 letter format: '.$day3LetterFormat);

		$dateWithSuffix = $date->format('jS');
		$logger->info('Date with suffix: '.$dateWithSuffix);

		$month = $date->format('F');
		$logger->info('Month: '.$month);

		$year = $date->format('Y');
		$logger->info('Year: '.$year);

		$date = date_format($date, 'Y-m-d H:i:s');
		$logger->info('Date: '.$date);

		$sql = "UPDATE meetingdetails
				SET day = '$day3LetterFormat', date = '$dateWithSuffix', month = '$month', venue = '$venue', time = '$time', year = '$year', meetingDate = '$date'
				WHERE id = 1";

		$result = $this->connection->query($sql);

		if ($result)
		{
			$logger->info('Meeting updated successfully');
			return true;
		}
		else
		{
			$logger->error('Meeting update error: Error: '.$sql."<br>".$this->connection->error);
			return false;
		}
	}
}
?>