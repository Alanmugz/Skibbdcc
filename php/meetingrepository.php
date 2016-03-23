<?php

include('config.php');

class MeetingRepository {
   
	private $conn;
   
    function connect(
		$dbname) 
	{
		echo $configs['db_servername'];
		echo $configs['db_username'];
		echo $configs['db_password'];
		
        $servername = 'localhost';
		$username = 'skibbdcc_usernam';
		$password = 'fastnetrally85';

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

		while($row = mysqli_fetch_array($result))
	    {
			$meetingDetails = $row['day'] . " " . $row['date'] . " " . $row['month'] . " " .$row['year'] . "<br />" . $row['venue'] . "<br />at " . $row['time']." Sharp";
			$meetingDate = date("d-m-Y H:i:s", strtotime($row['meetingDate']));
			$now =  date('d-m-Y H:i:s'); 
			
			$meetingDate = new dateTime($meetingDate);
			$now = new dateTime($now);
			
			if(($now <= $meetingDate && $now > $meetingDate->sub(new DateInterval('P10D'))))
			{
				return true;
			}
			else
			{
				return false;
			}
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