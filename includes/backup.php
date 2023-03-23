<?php
  if($currdateVSRDLOGTOCount>0)
  {
    //NAAY NAKITA NGA RECORD SA RDLOG RDLOGTO, BUSA DLI SIYA KASWIPE KAY RESTDAY NYA KARON
    $msg = 'Change Rest Day!';
    $Lockmsg = 'You cannot swipe during your Restday!';
  }
  else if ($currdateVSRDLOGFROMCount>0) 
  {
    //NAAY NAKITA NGA RECORD SA RDLOG RDLOGFROM, BUSA MAKASWIPE SIYA KAY 
    //NAGCHANGERESTDAY SYA BISAN RESTDAY UNTA NYA KARON
    if($PREVdateVSRDLOGTOCount >0) //KUNG NAAY MAKITA PASABOT RESTDAY NIYA GAHAPON 
    {//DONE
      if ($prevofprevcount>0) 
      {                            
        include('includes/Insertion.php');
      }
      else
      {
        include('includes/previous_of_previous_checker.php');
      }
    }
    else if($PREVdateVSRDLOGFROMCount >0)//KUNG NAAY MAKITA PASABOT DILI NYA RESTDAY GAHAPON SO DAPAT NAA SIYAY AGI
    {
      if ($prevcount>0) 
      {
        if ($prevofprevcount>0) 
        {
          include('includes/Insertion.php');
        }
        else
        {
          include('includes/previous_of_previous_checker.php');
        }
      }
      else
      {
        include('includes/previous.php');
      }
    }
    else//PASABOT KAILANGAN NIMU ECHECK ANG IYAHANG RESTDAY SA HRIS
    {
      if($todayNword==$RESTDAY || $todayNword==$RESTDAY1)
      {
        $msg = 'Restday!';
        $Lockmsg = 'You cannot swipe during your Restday!';
      }
      else
      {
        if ($previousdayNword==$RESTDAY || $previousdayNword==$RESTDAY1) 
        {
          if ($prevofprevcount>0) 
          {
            include('includes/Insertion.php');
          }
          else
          {
            include('includes/previous_of_previous_checker.php');
          }
        }
        else
        {
          if ($prevcount>0) 
          {
            if ($prevofprevcount>0) 
            {
              include('includes/Insertion.php');
            }
            else
            {
              include('includes/previous_of_previous_checker.php');
            }
          }
          else
          {
            include('includes/previous_of_previous_checker.php');
          } 
        }
      }
    }
  }
  else
  {
    if($PREVdateVSRDLOGTOCount >0) //KUNG NAAY MAKITA PASABOT RESTDAY NIYA GAHAPON 
    {
      if ($prevofprevcount>0) 
      {
        include('includes/Insertion.php');
      }
      else
      {
        include('includes/previous_of_previous_checker.php');
      }
    }
    else if($PREVdateVSRDLOGFROMCount >0)
    {//DONE CHECKING!
      //pasabot dli niya restday yesterday so dapat naa syay datescan
      if ($prevcount>0) 
      {
        //pasabot naa syay datescan 
        include('includes/previous_of_previous_checker.php');
      }
      else
      {//lock sya kay dapat 
        $msgLockerDate = $prevdate;
        include('includes/locker.php');
      } 
    }
    else
    {//DONE CHECKING!
      //check everything!
      include('includes/NoChangeRestdayLog.php');
    }
  }
?>

 <?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>