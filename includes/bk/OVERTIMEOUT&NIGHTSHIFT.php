<?php

  if ($otvalue>0) {
    if ($PREVOVERTIMEOUT != NULL) {
      $msg = 'Naka swipe naka sa OVERTIMEOUT!';
    }
    else{
      if ($PREVOVERTIMEIN != NULL) {
        $sql = "UPDATE TK SET OVERTIMEOUT = '". $dateT->format('Y-m-d h:i') ."' WHERE EMPID='". $id ."' and DATESCAN='". $prevdate."' ";
        // echo $sql;
        try 
        {
          if ($DTRdatabaseConnection->query($sql)) 
          {
            $msg = 'Record Updated!';
          }
          else
          {
             //$msg = 'No Record Inserted';
          }
        } catch(PDOException $e) {
          echo 'ERROR: ' . $e->getMessage();
        }
      }
      else
      {
        $msg = 'Dili pwede mag OVERTIMEOUT kung walay OVERTIMEIN!';
      }
    } 
  }
  else
  {
    $msg = 'Dili ka allowed mag Overtime!';
    $Lockmsg = 'Contact HR Personnel!';
  }
?>

<?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>