<?php
	//http://logging.apache.org/log4php/
	include('log4php/src/main/php/Logger.php');
    // Tell log4php to use our configuration file.
	Logger::configure('log4php/src/main/php/config.xml');
	 
	class LoggerInstance
	{
		/** Holds the Logger. */
		private $log;
	 
		/** Logger is instantiated in the constructor. */
		public function __construct()
		{
			// The __CLASS__ constant holds the class name, in our case "Foo".
			// Therefore this creates a logger named "Foo" (which we configured in the config file)
			$this->log = Logger::getLogger(__CLASS__);
		}
	 
		/** Logger can be used from any member method. */
		public function getLogger()
		{
			return $this->log;
		}
	}
?>
