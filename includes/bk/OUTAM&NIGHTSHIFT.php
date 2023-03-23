<?php

if ($PREVOUTAM != NULL) {
  $msg = 'Naka swipe naka sa OUTAM!';
}
else
{
  if ($PREVINAM !=NULL) {
    $sql = "UPDATE TK SET OUTAM = '". $dateT->format('Y-m-d h:i') ."' WHERE EMPID='". $id ."' and DATESCAN='".$prevdate."' ";
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
    $msg = 'Dili pwede mag OUTAM kung walay INAM!';
  }
}
?>

<?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>