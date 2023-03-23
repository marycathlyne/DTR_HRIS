<?php

if ($PREVOUTPM != NULL) {
  $msg = 'Naka swipe naka sa OUTPM!';
}
else
{
  if (($PREVINAM ==NULL && $PREVINPM!=NULL)   || ($PREVINAM !=NULL && $PREVINPM!=NULL) ) {
    $sql = "UPDATE TK SET OUTPM = '". $dateT->format('Y-m-d h:i') ."' WHERE EMPID='". $id ."' and DATESCAN='".$prevdate."' ";
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
    $msg = 'Dili pwede mag OUTPM kung walay INAM/INPM!';
  }
}
?>

<?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>