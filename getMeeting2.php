<?php
include 'dataconnection.php';
// Check connection
	// Create connection
	$con=mysqli_connect("$host","$dbusername","$password","skibbdcc_meeting");

	// Check connection
	if (mysqli_connect_errno($con))
	  {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	else
		   
	$result = mysqli_query($con,"SELECT * FROM meetingdetails");

	while($row = mysqli_fetch_array($result))
	    {
			$meetingDetails = $row['day'] . " " . $row['date'] . " " . $row['month'] . " " .$row['year'] . "<br />" . $row['venue'] . "<br />at " . $row['time']." Sharp";
			$meetingDate = date("d-m-Y H:i:s", strtotime($row['meetingDate']));;
			$now =  date('d-m-Y H:i:s'); 
			
			$meetingDate = new dateTime($meetingDate);
			$now = new dateTime($now);
			
			if($now < $meetingDate)
			{
				$isMeetingSet =  1;
			}
			else
			{
				$isMeetingSet = 0;
			}
		}		
		mysqli_close($con);
?>
