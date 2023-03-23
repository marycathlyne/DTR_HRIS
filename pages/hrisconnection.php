<?php

	//PDO Database Connection
	try {
	 	$HRISdatabaseConnection = new PDO('firebird:host='.HRIS_HOST_NAME_.';dbname='.HRIS_DATABASE_NAME_, HRIS_USER_NAME_, HRIS_DB_PASSWORD);
	 	$HRISdatabaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  	} 
 	catch(PDOException $e) {
	 	echo 'Connection Failed: ' . $e->getMessage();
		die();
	}
 
?>