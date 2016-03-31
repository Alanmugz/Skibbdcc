<?php

class MeetingRepository {
   
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
		
	
	function isMeetingWithinTheLast10Days()
	{
		$sql = "SELECT * FROM meetingdetails";
		$result = $this->conn->query($sql);
		$meetingDate = "";
		$now = date("Y-m-d");

		while($row = mysqli_fetch_array($result))
	    {
			$meetingDate = date("d-m-Y", strtotime($row['meetingDate'])); 
		}
		
		if($now <= $meetingDate)
		{
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
	}
	
	
	function meetingDetails()
	{
		$sql = "SELECT * FROM meetingdetails";
		$result = $this->conn->query($sql);

		while($row = mysqli_fetch_array($result))
	    {
			return $row['day'] . " " . $row['date'] . " " . $row['month'] . " " .$row['year'] . "<br />" . $row['venue'] . "<br />at " . $row['time']." Sharp";
		}
	}
}
?> 