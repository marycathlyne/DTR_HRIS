<?php
 	//PDO Database Connection
 	try {
	 	$DTRdatabaseConnection = new PDO('firebird:host='.DTR_HOST_NAME_.';dbname='.DTR_DATABASE_NAME_, DTR_USER_NAME_, DTR_DB_PASSWORD);
 		$DTRdatabaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 	} 	
 	catch(PDOException $e) {
 		echo 'Connection Failed: ' . $e->getMessage();
		die();
 	}
 
?>
