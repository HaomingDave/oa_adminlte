<?php

	class DatabaseHelper {
		private $dbconn;

        
    function DatabaseHelper()
	{
		$dbhost = '192.168.3.103';
            $dbuser = 'root';
      		$dbpass = '123456';
   			$dbname = 'bitnami_pm';
   		$this->dbconn = mysql_connect($dbhost, $dbuser, $dbpass) or die (mysql_error());
		mysql_select_db($dbname) or die (mysql_error());
	}
		
	function __destruct()
	{
 		if($this->dbconn != null)
 			mysql_close($this->dbconn);
	}
		
	function execute($query)
	{
		mysql_query("SET NAMES 'UTF8'");
		$res 	 = mysql_query($query);
		return $res;
	}

}
?>