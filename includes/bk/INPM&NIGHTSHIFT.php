<?php

if ($PREVINPM != NULL) {
  $msg = 'Naka swipe naka sa INPM!';
}
else
{
  if ($PREVOUTAM !=NULL) {
    $sql = "UPDATE TK SET INPM = '". $dateT->format('Y-m-d h:i') ."' WHERE EMPID='". $id ."' and DATESCAN='".$prevdate."' ";
    // echo $sql;
    try 
    {
      if ($DTRdatabaseConnection->query($sql)) 
      {
         $msg = 'Record Updated!';
      }
    } catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
    }
  }
  else
  {
    $msg = 'Dili pwede mag INPM kung walay OUTAM!';
  }
}
?>

<?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>