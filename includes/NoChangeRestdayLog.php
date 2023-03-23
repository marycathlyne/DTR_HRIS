<?php


  if($RESTDAY1 == 'NO' || $RESTDAY1 == 'No')
	{
    if($todayNword==$RESTDAY || $todayNword==$RESTDAY1)
    {
      include('includes/previous_checker.php');
      //$msg = 'Restday!';
      $Lockmsg = 'Duty during Restday!';
      // if($currcount>0)
      // {
      //   include('includes/previous_checker.php');
      // }
      // else
      // {
      //   $msg = 'Restday!';
      //   $Lockmsg = 'You cannot swipe during your Restday!';
      // }
    }
    else
    {
      include('includes/previous_checker.php');
    } 
	}
	else 
	{
    if($todayNword==$RESTDAY || $todayNword==$RESTDAY1)
    {
       include('includes/previous_checker_tworestday.php');
      //$msg = 'Restday!';
      $Lockmsg = 'Duty during Restday!';
      // if($currcount>0)
      // {
      //   include('includes/previous_checker_tworestday.php');
      // }
      // else
      // {
      //   $msg = 'Restday!';
      //   $Lockmsg = 'You cannot swipe during your Restday!';
      // }
    }
    else
    {
      include('includes/previous_checker_tworestday.php');
    }
	}

?>

 <?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>