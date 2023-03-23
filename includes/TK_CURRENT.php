<?php
  $DTRresult = $DTRdatabaseConnection->query($sqlDTR);
  while ($DTRdata = $DTRresult->fetch(PDO::FETCH_ASSOC)){
    $INAM = $DTRdata['INAM'];
    $OUTAM = $DTRdata['OUTAM'];
    $INPM = $DTRdata['INPM'];
    $OUTPM = $DTRdata['OUTPM'];
    $BREAKIN = $DTRdata['BREAKIN'];
    $BREAKOUT = $DTRdata['BREAKOUT'];
    $BREAKIN = $DTRdata['BREAKIN'];
    $BREAKOUT = $DTRdata['BREAKOUT'];
    $INOT = $DTRdata['OVERTIMEIN'];
    $OUTOT = $DTRdata['OVERTIMEOUT'];
    $REMARKS = $DTRdata['REMARKS'];

    $xplode = explode(' ', $INAM);
    $xplode1 = explode(' ', $OUTAM);
    $xplode2 = explode(' ', $INPM);
    $xplode3 = explode(' ', $OUTPM);
    $xplode4 = explode(' ', $BREAKOUT);
    $xplode5 = explode(' ', $BREAKIN);
    $xplode6 = explode(' ', $INOT);
    $xplode7 = explode(' ', $OUTOT);
    
    if($INAM == null){
     $time ="";
     $DTINAM = "";
    } else{
     $time = $xplode[1];
     $date = new DateTime($time);
     $DTINAM = $date->format('h:i A');
    }     
    if($OUTAM == null){
      $time1 ="";
      $DTOUTAM = "";
    } else{
     $time1 = $xplode1[1];
     $date1 = new DateTime($time1);
     $DTOUTAM = $date1->format('h:i A');
    }
    if($INPM == null){
     $time2 ="";
     $DTINPM = "";
    } else{
      $time2 = $xplode2[1];
      $date2 = new DateTime($time2);
      $DTINPM = $date2->format('h:i A');
    }
    if($OUTPM == null){
       $time3 ="";
       $DTOUTPM="";
    } else{
       $time3 = $xplode3[1];
       $date3 = new DateTime($time3);
       $DTOUTPM = $date3->format('h:i A');
    }
    if($BREAKOUT == null){
     $time4 ="";
     $DTBREAKOUT="";
    } else{
     $time4 = $xplode4[1];
     $date4 = new DateTime($time4);
     $DTBREAKOUT = $date4->format('h:i A');
    }
    if($BREAKIN == null){
     $time5 ="";
     $DTBREAKIN = "";
    } else{
      $time5 = $xplode5[1];
      $date5 = new DateTime($time5);
      $DTBREAKIN = $date5->format('h:i A');
    }
    if($INOT == null){
     $time6 ="";
     $DTINOT = "";
    } else{
      $time6 = $xplode6[1];
      $date6 = new DateTime($time6);
      $DTINOT = $date6->format('h:i A');
    }
    if($OUTOT == null){
     $time7 ="";
     $DTOUTOT = "";
    } else{
      $time7 = $xplode7[1];
      $date7 = new DateTime($time7);
      $DTOUTOT = $date7->format('h:i A');
    }
  }
?>

 <?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>