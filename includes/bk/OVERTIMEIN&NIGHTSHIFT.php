<?php

if ($otvalue>0) {
  if ($PREVDTOVERTIMEIN != NULL) {
    $msg = 'Naka swipe naka sa OVERTIMEIN!';
  }
  else if ($PREVOUTPM == NULL) {
    $msg = 'Dili pwede mag OVERTIMEIN Kung wala pa ka OUTPM!';
  }
  else{

    $sql = "UPDATE TK SET OVERTIMEIN = '". $dateT->format('Y-m-d h:i') ."' WHERE EMPID='". $id ."' and DATESCAN='". $prevdate ."' ";
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