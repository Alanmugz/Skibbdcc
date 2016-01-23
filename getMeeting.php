<?php
include 'dataconnection.php';
// Check connection

if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	$day = $_POST[set_date];
	//echo $day;
	
	$month = $_POST[set_month];
	
	switch ($month) {
		case "January":
			$month = 01;
			break;
		case "February":
			$month = 02;
			break;
		case "March":
			$month = 03;
			break;
		case "April":
			$month = 04;
			break;
		case "May":
			$month = 05;
			break;
		case "June":
			$month = 06;
			break;
		case "July":
			$month = 07;
			break;
		case "August":
			$month = 08;
			break;
		case "September":
			$month = 09;
			break;
		case "October":
			$month = 10;
			break;
		case "November":
			$month = 11;
			break;
		case "December":
			$month = 12;
			break;
	} 
	
	$year = $_POST[set_year]; 
	$str = $year.'-'.$month.'-'.$day.' 21:30:00';
	//echo "<br />".$str;
	$date = date("Y-m-j H:i:s",strtotime($str)); 
	//echo "<br />".$date; 
	$sql = "UPDATE meetingdetails 
		SET day='$_POST[set_day]',date='$_POST[set_date]',month='$_POST[set_month]',venue='$_POST[set_venue]',time='$_POST[set_time]',year='$_POST[set_year]',meetingDate='$date'
		WHERE id='1'";

	if ($con->query($sql) === TRUE) { 
		echo "<div id='pageheader'>
					Your information has been saved <span id='logout'>Return to <a href='contributors_login.php'>Contributors Login</a></span>   
			  </div>";
	} else {
		echo "Error updating record: " . $con->error;
	}

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



				
				
				
				 
				