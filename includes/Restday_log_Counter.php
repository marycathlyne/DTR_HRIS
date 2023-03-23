<?php
	$sqlDTR = "SELECT * FROM RDLOG WHERE EMPID='".$id."' AND ". $field ."='". $temp_date ."'";
  	$DTRresult = $DTRdatabaseConnection->query($sqlDTR);
  	$currrows = $DTRresult->fetchAll();
?>

 <?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>