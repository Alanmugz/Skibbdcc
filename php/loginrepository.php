<?php

class LoginRepository {

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
	 * Verifies if a user is authenticated.
	 *
	 * @param string $username Username
	 * @param string $password Password
	 *
	 * @return boolean Returns a boolean value to determine if a user is authenticated.
	 */
	function isAuthenticatedUser(
		$username,
		$password)
	{
		$sql = "SELECT * FROM skibbdcclogin WHERE username = '$username'";
		$result = $this->connection->query($sql);

		$numrows = mysqli_num_rows($result);

		if($numrows != 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$dbusername = $row['username'];
				$dbpassword = $row['password'];

				if($username == $dbusername && $password == $dbpassword)
				{
					return true;
				}
				return false;
			}
			return false;
		}
		return false;
	}
}
?> 