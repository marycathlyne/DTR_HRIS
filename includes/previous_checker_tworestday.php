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
      if ($previousdayNword==$RESTDAY || $previousdayNword==$RESTDAY1) 
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
          if ($previousofpreviousdayNword==$RESTDAY || $previousofpreviousdayNword==$RESTDAY1) 
          {
            echo $msgLockerDate;
            $sqlDTR = "SELECT * FROM TK WHERE EMPID='". $id ."' AND DATESCAN='". $TWOdaysRestdayChecker ."'";
            $DTRresult = $DTRdatabaseConnection->query($sqlDTR);
            $TWOdaysRDrows = $DTRresult->fetchAll();
            $TWOdaysRDCount = count($TWOdaysRDrows);

            if ($TWOdaysRDCount>0) 
            {
              include('includes/Insertion.php');
            }
            else
            {
              //pasabot wala sya'y agi previous of yesterday so echeck naku kung restday ba niya ato
              if ($TWOdaysRestdayCheckerdayNword==$RESTDAY || $TWOdaysRestdayCheckerdayNword==$RESTDAY1) 
              {
                include('includes/Insertion.php');
              }
              else
              {
                $msgLockerDate = $TWOdaysRestdayChecker;
                include('includes/locker.php');
              }
            }
            
          }
          else
          {
            $msgLockerDate = $prevofprevdate;
            include('includes/locker.php');
          }
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