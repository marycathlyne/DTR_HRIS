
<?php

  $inam = $outam = $inpm = $outpm = $breakout = $breakin = $inot = $outot = "";
  $DTINAM = $DTOUTAM = $DTINPM = $DTOUTPM = $DTBREAKIN = $DTBREAKOUT = $DTOTIN = $DTOTOUT = $REMARKS = "";
  $lname = $fname = $mname = $sftsched = "";
  $sqlHris="";
  $msgLockerDate = $msg = $Lockmsg = $labellock = "";
  $emppix = "";
  $lockvalue = $otvalue = $LockMessagevalue = $NIGHTSHIFT = 0;
  $buttonNight = "";
  $PREVINAM = $PREVOUTAM = $PREVINPM = $PREVOUTPM = $PREVBREAKIN = $PREVBREAKOUT = $PREVOVERTIMEIN = $PREVOVERTIMEOUT = $PREVREMARK =  "";
  
  //variable used for shifting info
  $shftname = $shftinref = $shftlateref = "";
  if(isset($_POST['submit'])) 
  {
    if (empty($_POST["empid"])) 
    {
      
    } 
    else 
    {
      $id = $_POST["empid"];
      
      $currdateVSRDLOGFROMCount = $currdateVSRDLOGTOCount = 0;
      date_default_timezone_set('Asia/Taipei');
      $dateT = new DateTime('Asia/Taipei');

      $sfhtlateref=$dateT;
      $sfhthalfdayref=$dateT;
      $labellock = $_POST['btnclick'];
      $currdate = date("m-d-Y");
      $currtime = date("m-d-Y h:i A");
      //for checking yesterday day
      $prevdate =  date("m-d-Y", strtotime("-1 day"));
      $previousdayNword = date("l",strtotime("-1 day"));
      $previousdayNword = strtoupper($previousdayNword);
      //for checking previous of the yesterday
      $prevofprevdate =  date("m-d-Y", strtotime("-2 day"));
      $previousofpreviousdayNword = date("l",strtotime("-2 day"));
      $previousofpreviousdayNword = strtoupper($previousofpreviousdayNword);
      //2 days restday 
      //checking for the day before the 2 restday of the two days restday
      $TWOdaysRestdayChecker =  date("m-d-Y", strtotime("-3 day"));
      $TWOdaysRestdayCheckerdayNword = date("l",strtotime("-3 day"));
      $TWOdaysRestdayCheckerdayNword = strtoupper($TWOdaysRestdayCheckerdayNword);
      $todayNword = date("l");
      $todayNword = strtoupper($todayNword);

      // echo $currtime;
      //getting all the employtees information
      $sqlHris = "SELECT * FROM EMPLOYEE WHERE EMPID='". $id ."'";
      $HRISresult = $HRISdatabaseConnection->query($sqlHris);
      while ($HRISdata = $HRISresult->fetch(PDO::FETCH_ASSOC))
      {
        $lname = utf8_encode($HRISdata['LNAME']);
        $fname = utf8_encode($HRISdata['FNAME']);
        $mname = utf8_encode($HRISdata['MNAME']);
        $emppix = $HRISdata['PIX'];
        $RESTDAY = $HRISdata['RESTDAY'];
        $RESTDAY1 = $HRISdata['RESTDAY1'];
        $sftsched = $HRISdata['SHIFT_SCHED'];
        $lockvalue = $HRISdata['LOCK'];
        $otvalue = $HRISdata['OT'];
      }

      $sqlHris = "SELECT * FROM EMPLOYEE WHERE EMPID='". $id ."'";
      $HRISresult = $HRISdatabaseConnection->query($sqlHris);
      $empidrows = $HRISresult->fetchAll();
      $empid_exist_count = count($empidrows);
      
      if ($empid_exist_count > 0) 
      {
        //getting all the employtees information
        $sqlHris = "SELECT * FROM SHIFTING WHERE SHIFTNAME='". $sftsched ."'";
        $HRISresult = $HRISdatabaseConnection->query($sqlHris);
        while ($HRISdata = $HRISresult->fetch(PDO::FETCH_ASSOC))
        {
          $sfhtlateref = $HRISdata['LATEREFAM'];
          $sfhthalfdayref = $HRISdata['LATEREFPM'];

        }
        $sqlDTR = "SELECT * FROM TK WHERE EMPID='". $id ."' AND DATESCAN='". $prevdate ."'";
        $DTRresult = $DTRdatabaseConnection->query($sqlDTR);
        $prevrows = $DTRresult->fetchAll();
        $prevnum_rows = count($prevrows);
        //cho $prevnum_rows;
        if ($prevnum_rows>0) 
        {
          include('includes/TK_PREVIOUS.php');  
        }
        if ($lockvalue == 0)//check if LOCK or NOT
        {
          $sqlDTR = "SELECT * FROM MSG WHERE EMPID='".$id."' AND MSGDATE='". $currdate ."'";
          $MSGresult = $DTRdatabaseConnection->query($sqlDTR); 
          $currrows = $MSGresult->fetchAll();
          $msgLockercount = count($currrows);
          if ($msgLockercount>0) {
            $sqlDTR = "SELECT * FROM MSG WHERE EMPID='".$id."' AND MSGDATE='". $currdate ."'";
            $MSGresult = $DTRdatabaseConnection->query($sqlDTR); 
            while ($MSGDATA = $MSGresult->fetch(PDO::FETCH_ASSOC))
            {
              $datameSS = $MSGDATA['MESG'];
              $LockMessagevalue = $MSGDATA['MSGACTIVE'];
            }
          }
          if ($LockMessagevalue==1) 
          {
            $sqlDTR = "SELECT * FROM MSG WHERE EMPID='".$id."' AND MSGDATE='". $currdate ."'";
            $MSGresult = $DTRdatabaseConnection->query($sqlDTR); 
            while ($MSGDATA = $MSGresult->fetch(PDO::FETCH_ASSOC))
            {
              $datameSS = $MSGDATA['MESG'];
            }
            $msg = 'LOCK!';
            $Lockmsg = $datameSS;
          }
          else
          {
            if ($msgLockercount>0) {
              $Lockmsg = $datameSS;
            }
            $sqlDTR = "SELECT * FROM TK WHERE EMPID='".$id."' AND DATESCAN='". $currdate ."'";
            $DTRresult = $DTRdatabaseConnection->query($sqlDTR);
            $currrows = $DTRresult->fetchAll();
            $currcount = count($currrows);

            if ($_POST['btnclick']=='OUTPM' && $PREVOUTPM==NULL && $currcount<=0) 
            {
              $buttonNight = 'OUTPM';
              include('includes/NIGHTSHIFT.php');
              $NIGHTSHIFT = 1;
            }
            else if ($_POST['btnclick']=='OUTAM' && $PREVOUTPM==NULL && $currcount<=0)
            {
              $buttonNight = 'OUTAM';
              include('includes/NIGHTSHIFT.php');
              $NIGHTSHIFT = 1;
            }
            else if ($_POST['btnclick']=='INPM' && $PREVINAM!=NULL &&  $PREVOUTAM!=NULL && $PREVOUTPM==NULL && $currcount<=0 && $prevnum_rows>0)
            {
              $buttonNight = 'INPM';
              include('includes/NightShift.php');
              $NIGHTSHIFT = 1;
            }
            else if ($_POST['btnclick']=='BREAKOUT' && $PREVOUTPM==NULL && $currcount<=0)
            {
              $buttonNight = 'BREAKOUT';
              include('includes/NightShift.php');
              $NIGHTSHIFT = 1;
            }
            else if ($_POST['btnclick']=='BREAKIN' && $PREVOUTPM==NULL && $currcount<=0)
            {
              $buttonNight = 'BREAKIN';
              include('includes/NightShift.php');
              $NIGHTSHIFT = 1;
            }
            else if ($_POST['btnclick']=='INOT' && $PREVOUTPM!=NULL  && $currcount<=0)
            {
              $buttonNight = 'INOT';
              include('includes/NightShift.php');
              $NIGHTSHIFT = 1;
            }
            else if ($_POST['btnclick']=='OUTOT' && $PREVOUTPM!=NULL && $currcount<=0)
            {
              $buttonNight = 'OUTOT';
              include('includes/NightShift.php');
              $NIGHTSHIFT = 1;
            }
            else
            {

              $sqlDTR = "SELECT * FROM POSTTK WHERE EMPID='".$id."' " ;
              $DTRresult = $DTRdatabaseConnection->query($sqlDTR);
              //$prevcount = $DTRresult->fetchColumn(); 
              $currrows = $DTRresult->fetchAll();
              $posttkcount = count($currrows);

              $sqlDTR = "SELECT * FROM TK WHERE EMPID='".$id."' " ;
              $DTRresult = $DTRdatabaseConnection->query($sqlDTR);
              //$prevcount = $DTRresult->fetchColumn(); 
              $currrows = $DTRresult->fetchAll();
              $tkcount = count($currrows);

              $sqlDTR = "SELECT * FROM TK WHERE EMPID='".$id."' AND DATESCAN='". $prevdate ."' " ;
              $DTRresult = $DTRdatabaseConnection->query($sqlDTR);
              //$prevcount = $DTRresult->fetchColumn(); 
              $currrows = $DTRresult->fetchAll();
              $prevcount = count($currrows);

              $sqlDTR = "SELECT * FROM TK WHERE EMPID='".$id."' AND DATESCAN='". $prevofprevdate ."'";
              $DTRresult = $DTRdatabaseConnection->query($sqlDTR);
              //$prevofprevcount = $DTRresult->fetchColumn(); 
              $currrows = $DTRresult->fetchAll();
              $prevofprevcount = count($currrows);

              /* Check all the */
              $temp_date = $currdate;
              $field = 'CHANGERD';
              include('includes/Restday_log_Counter.php');
              $currdateVSRDLOGTOCount = count($currrows);

              $temp_date = $currdate;
              $field = 'DUTYRD';
              include('includes/Restday_log_Counter.php');
              $currdateVSRDLOGFROMCount = count($currrows);

              $temp_date = $prevdate;
              $field = 'CHANGERD';
              include('includes/Restday_log_Counter.php');
              $PREVdateVSRDLOGTOCount = count($currrows);

              $temp_date = $prevdate;
              $field = 'DUTYRD'; 
              include('includes/Restday_log_Counter.php');
              $PREVdateVSRDLOGFROMCount = count($currrows);

              $temp_date = $prevofprevdate;
              $field = 'CHANGERD';
              include('includes/Restday_log_Counter.php');
              $PREVofPREVdateVSRDLOGTOCount = count($currrows);

              $temp_date = $prevofprevdate;
              $field = 'DUTYRD';
              include('includes/Restday_log_Counter.php');
              $PREVofPREVdateVSRDLOGFROMCount = count($currrows);

              if($RESTDAY1 == 'NO' || $RESTDAY1 == 'No')
              {
                if($currdateVSRDLOGTOCount==1 && $currdateVSRDLOGFROMCount<1)
                {
                  $msg = 'Change Rest Day!';
                  $Lockmsg = 'You cannot swipe during your Restday!';
                }
                else if($currdateVSRDLOGTOCount<1 && $currdateVSRDLOGFROMCount==1)
                {
                  if($PREVdateVSRDLOGTOCount==1 && $PREVdateVSRDLOGFROMCount<1)
                  {//Restday yesterday so need to check if previous of yesterday kung nag absent
                    if($PREVofPREVdateVSRDLOGTOCount==1 && $PREVofPREVdateVSRDLOGFROMCount<1)
                    {//Restday niya previous of yesterday
                      include('includes/Insertion.php');
                    }
                    else if($PREVofPREVdateVSRDLOGFROMCount<1 && $PREVofPREVdateVSRDLOGFROMCount==1)
                    {//Dili niya Restday previous of yesterday so dapat naa siyay agi
                      if ($prevcount>0) 
                      {
                        include('includes/Insertion.php');
                      }
                      else
                      {
                        $msgLockerDate = $prevofprevdate;
                        include('includes/locker.php');
                      } 
                    }
                    else
                    {
                      $msgLockerDate = $prevdate;
                      include('includes/locker.php');
                    }
                  }
                  else if($PREVdateVSRDLOGFROMCount<1 && $PREVdateVSRDLOGFROMCount==1)
                  {//Not Restday Yesterday so dapat naa siyay agi gahapon
                    if ($prevcount>0) 
                    {
                      include('includes/Insertion.php');
                    }
                    else
                    {
                      $msgLockerDate = $prevdate;
                      include('includes/locker.php');
                    } 
                  }
                  else
                  {//CORRECTED!
                    include('includes/previous_checker.php');
                  }
                }
                else
                {
                  include('includes/NoChangeRestdayLog.php');
                }
              }
              else
              {//This section is for two days restday 
                if($currdateVSRDLOGTOCount==1 && $currdateVSRDLOGFROMCount<1)
                {
                  $msg = 'Change Rest Day!';
                  $Lockmsg = 'You cannot swipe during your Restday!';
                }
                else if($currdateVSRDLOGTOCount<1 && $currdateVSRDLOGFROMCount==1)
                {
                  $msg = 'Sorry for Inconvenience. The system is not yet able to cater Change Restday for two days Restday!';
                }
                else
                {
                  include('includes/NoChangeRestdayLog.php');
                }
              }
            }
          }
          if($NIGHTSHIFT == 1)
          {
            $sqlDTR = "SELECT * FROM TK WHERE EMPID='". $id ."' AND DATESCAN='". $prevdate ."'";
            include('includes/TK_CURRENT.php');  
          }
          else
          {
            $sqlDTR = "SELECT * FROM TK WHERE EMPID='". $id ."' AND DATESCAN='". $currdate ."'";
            include('includes/TK_CURRENT.php');  
          }
        }
        else
        {                          
          $msg = 'LOCK!';
          $Lockmsg = 'Employee Status Locked, Report to HR';
        }
      }
      else
      {
        $msg = 'NO DATA FOUND';
        $Lockmsg = 'Barcode not Found!';
      }
    }

  } 
  $DTRdatabaseConnection = null;
  $HRISdatabaseConnection = null;
?>  