<?php

if ($PREVBREAKIN != NULL) {
  $msg = 'Naka swipe naka sa BREAKIN!';
}
else if($PREVOUTPM != NULL)
{
  $msg = 'Dili pwede mag BREAKOUT kung naka OUTPM naka!';
}
else
{
  if ($PREVBREAKOUT !=NULL) {
    $sql = "UPDATE TK SET BREAKIN = '". $dateT->format('Y-m-d h:i') ."' WHERE EMPID='". $id ."' and DATESCAN='".$prevdate."' ";
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
    $msg = 'Dili pwede mag BREAKIN kung walay BREAKOUT!';
  }
}
?>

<?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>