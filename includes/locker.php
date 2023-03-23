<?php
	$sql = "UPDATE EMPLOYEE SET LOCK='1' WHERE EMPID='". $id ."'";
    // echo $sql;
    try 
    {
      if ($HRISdatabaseConnection->query($sql)) 
      {
        $msgresult = sprintf("ABSENT, %s", $msgLockerDate); 
        $msg = $msgresult;
        $Lockmsg = 'Employee Status Locked, Report to HR';
      }
      else  
      {
         //$msg = 'No Record Inserted';
      }
    } 
    catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
    }
?>
 <?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>