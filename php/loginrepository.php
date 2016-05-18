<?php

class LoginRepository {
   
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
		
	
	function isAuthenticatedUser(
		$username)
	{
		$sql = "SELECT * FROM skibbdcclogin WHERE username='$username'";
		$result = $this->conn->query($sql);

		$numrows = mysql_num_rows($result);
				
		if($numrows != 0)
		{
			while($row = mysql_fetch_assoc($sql))
			{
				$dbusername = $row['username'];
				$dbpassword = $row['password']; 
				
				if($username==$dbusername && $password==$dbpassword)
				{
					return true;
				}
			}
		}
	}
}
?> 