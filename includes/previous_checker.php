<?php

  if ($posttkcount ==0 && $tkcount ==0) 
  {
    include('includes/Insertion.php');
  }
  else
  {
    if ($currcount>0) 
    {
      include('includes/Insertion.php');
    }
    else
    {
      if ($previousdayNword==$RESTDAY) 
      {
        //Pasabot restday niya yesterday 
        //? dapat naa syay datescan previous of yesterday
        if ($prevofprevcount>0) 
        {
          //pasabot dli sya absent previous of yesterday
          include('includes/Insertion.php');
        }
        else
        {
          //pasabot wala sya'y agi previous of yesterday so echeck naku kung restday ba niya ato
          $msgLockerDate = $prevofprevdate;
          include('includes/locker.php');
        }
      }
      else
      {
        //pasabot dli niya restday yesterday so dapat naa syay datescan
        if ($prevcount>0) 
        {
          //pasabot naa syay datescan so dapat e check 
          include('includes/Insertion.php');
        }
        else
        {
          $msgLockerDate = $prevdate;
          include('includes/locker.php');
        } 
      }
    }
  }

?>

 <?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>