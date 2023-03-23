<?php
  $sqlDTR = "SELECT * FROM TK WHERE EMPID='". $id ."' AND DATESCAN='". $prevdate ."'";
  $DTRresult = $DTRdatabaseConnection->query($sqlDTR);
  while ($DTRdata = $DTRresult->fetch(PDO::FETCH_ASSOC)){
    $PREVINAM = $DTRdata['INAM'];
    $PREVOUTAM = $DTRdata['OUTAM'];
    $PREVINPM = $DTRdata['INPM'];
    $PREVOUTPM = $DTRdata['OUTPM'];
    $PREVBREAKIN = $DTRdata['BREAKIN'];
    $PREVBREAKOUT = $DTRdata['BREAKOUT'];
    $PREVOVERTIMEIN = $DTRdata['OVERTIMEIN'];
    $PREVOVERTIMEOUT = $DTRdata['OVERTIMEOUT'];
    $PREVREMARK =  $DTRdata['REMARKS'];

    $PREVxplode = explode(' ', $PREVINAM);
    $PREVxplode1 = explode(' ', $PREVOUTAM);
    $PREVxplode2 = explode(' ', $PREVINPM);
    $PREVxplode3 = explode(' ', $PREVOUTPM);
    $PREVxplode4 = explode(' ', $PREVBREAKIN);
    $PREVxplode5 = explode(' ', $PREVBREAKOUT);
    $PREVxplode6 = explode(' ', $PREVOVERTIMEIN);
    $PREVxplode7 = explode(' ', $PREVOVERTIMEOUT);
    
    if($PREVINAM == null){
     $PREVtime ="";
     $PREVDTINAM = "";
    } else{
     $PREVtime = $PREVxplode[1];
     $PREVdate = new DateTime($PREVtime);
     $PREVDTINAM = $PREVdate->format('h:i A');
    }     
    if($PREVOUTAM == null){
      $PREVtime1 ="";
      $PREVDTOUTAM = "";
    } else{
     $PREVtime1 = $PREVxplode1[1];
     $PREVdate1 = new DateTime($PREVtime1);
     $PREVDTOUTAM = $PREVdate1->format('h:i A');
    }
    if($PREVINPM == null){
     $PREVtime2 ="";
     $PREVDTINPM = "";
    } else{
      $PREVtime2 = $PREVxplode2[1];
      $PREVdate2 = new DateTime($PREVtime2);
      $PREVDTINPM = $PREVdate2->format('h:i A');
    }
    if($PREVOUTPM == null){
       $PREVtime3 ="";
       $PREVDTOUTPM="";
    } else{
       $PREVtime3 = $PREVxplode3[1];
       $PREVdate3 = new DateTime($PREVtime3);
       $PREVDTOUTPM = $PREVdate3->format('h:i A');
    }
    if($PREVBREAKIN == null){
       $PREVtime4 ="";
       $PREVDTBREAKIN="";
    } else{
       $PREVtime4 = $PREVxplode4[1];
       $PREVdate4 = new DateTime($PREVtime4);
       $PREVDTBREAKIN = $PREVdate4->format('h:i A');
    }
    if($PREVBREAKOUT == null){
       $PREVtime5 ="";
       $PREVDTBREAKOUT="";
    } else{
       $PREVtime5 = $PREVxplode5[1];
       $PREVdate5 = new DateTime($PREVtime5);
       $PREVDTBREAKOUT = $PREVdate5->format('h:i A');
    }
    if($PREVOVERTIMEIN == null){
       $PREVtime6 ="";
       $PREVDTOVERTIMEIN="";
    } else{
       $PREVtime6 = $PREVxplode6[1];
       $PREVdate6 = new DateTime($PREVtime6);
       $PREVDTOVERTIMEIN = $PREVdate6->format('h:i A');
    }
    if($PREVOVERTIMEOUT == null){
       $PREVtime7 ="";
       $PREVDTOVERTIMEOUT="";
    } else{
       $PREVtime7 = $PREVxplode6[1];
       $PREVdate7 = new DateTime($PREVtime7);
       $PREVDTOVERTIMEOUT = $PREVdate7->format('h:i A');
    }
  }
?>

 <?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>