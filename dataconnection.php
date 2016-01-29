
	<?php
		$host = "localhost"; 
		$dbusername = "skibbdcc_usernam";
		$password = "fastnetrally85"; 
		
		
		mysqli_connect("$host","$dbusername","$password","skibbdcc_login");
		
		$con=mysqli_connect("$host","$dbusername","$password","skibbdcc_meeting"); 
		
		function ConnectToDb(dbName)
		{
			mysqli_connect("$host","$dbusername","$password",dbName);
		}
				 
	?>  

