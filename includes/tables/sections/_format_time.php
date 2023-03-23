<?php
    $xplode = explode(" ", $INAM);
    $xplode1 = explode(" ", $OUTAM);
    $xplode2 = explode(" ", $INPM);
    $xplode3 = explode(" ", $OUTPM);
    $xplode4 = explode(" ", $BREAKOUT);
    $xplode5 = explode(" ", $BREAKIN);
    
    if($INAM == null)
    {
      $time ="";
      $DTINAM = "";
    } else
    {
      $time = $xplode[1];
      $date = new DateTime($time);
      $timeaa = $xplode[0];
      $dateaa = new DateTime($timeaa);
      $dateformatINAM = $dateaa->format('Y-m-d');
      $DTINAM = $date->format("h:i A");
    }
    if($OUTAM == null)
    {
      $time1 ="";
      $DTOUTAM = "";
    } else
    {
      $time1 = $xplode1[1];
      $date1 = new DateTime($time1);
      $time01 = $xplode1[0];
      $date01 = new DateTime($time01);
      $dateformatOUTAM = $date01->format('Y-m-d');
      $DTOUTAM = $date1->format("h:i A");
    }
    if($INPM == null){
      $time2 ="";
      $DTINPM = "";
    } else
    {
      $time2 = $xplode2[1];
      $date2 = new DateTime($time2);
      $time02 = $xplode2[0];
      $date02 = new DateTime($time02);
      $dateformatINPM = $date02->format('Y-m-d');
      $DTINPM = $date2->format("h:i A");
    }
    if($OUTPM == null)
    {
      $time3 ="";
      $DTOUTPM="";
    } else
    {
      $time3 = $xplode3[1];
      $date3 = new DateTime($time3);
      $time03 = $xplode3[0];
      $date03 = new DateTime($time03);
      $dateformatOUTPM = $date03->format('Y-m-d');
      $DTOUTPM = $date3->format("h:i A");
    }
    if($BREAKOUT == null)
    {
      $time4 ="";
      $DTBREAKOUT="";
    } else
    {
      $time4 = $xplode4[1];
      $date4 = new DateTime($time4);
      $dateformatBREAKOUT = $date4->format('Y-m-d');
      $DTBREAKOUT = $date4->format("h:i A");
    }
    if($BREAKIN == null)
    {
      $time5 ="";
      $DTBREAKIN = "";
    } else
    {
      $time5 = $xplode5[1];
      $date5 = new DateTime($time5);
      $dateformatBREAKIN = $date5->format('Y-m-d');
      $DTBREAKIN = $date5->format("h:i A");
    }
  
    
?>