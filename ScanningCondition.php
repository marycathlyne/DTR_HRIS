
<?php

  $inam = $outam = $inpm = $outpm = $breakout = $breakin = $inot = $outot = "";
  $DTINAM = $DTOUTAM = $DTINPM = $DTOUTPM = $DTBREAKIN = $DTBREAKOUT = $DTOTIN = $DTOTOUT = $REMARKS = "";
  $lname = $fname = $mname = $sftsched = "";
  $sqlHris="";
  $msgLockerDate = $msg = $Lockmsg = "";
  $emppix = "";
  $lockvalue = $otvalue = $LockMessagevalue = $NIGHTSHIFT = 0;
  $labellock = "";
  $PREVINAM = $PREVOUTAM = $PREVINPM = $PREVOUTPM = $PREVBREAKIN = $PREVBREAKOUT = $PREVOVERTIMEIN = $PREVOVERTIMEOUT = $PREVREMARK =  "";
  
  //variable used for shifting info
  $shftname = $shftinref = $shftlateref = "";
  if(isset($_POST['submit'])) 
  {
    if (empty($_POST["empid"])) 
    {
      $empidErr = "Name is required";
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
      $prevdate =  date("m-d-Y", strtotime("-1 day"));
      $prevofprevdate =  date("m-d-Y", strtotime("-2 day"));
      $previousdayNword = date("l",strtotime("-1 day"));
      $previousdayNword = strtoupper($previousdayNword);
	    $previousofpreviousdayNword = date("l",strtotime("-2 day"));
      $previousofpreviousdayNword = strtoupper($previousofpreviousdayNword);
      $TWOdaysRestdayChecker =  date("m-d-Y", strtotime("-3 day"));
      $todayNword = date("l");
      $todayNword = strtoupper($todayNword);


      
      //getting all the employtees information
      $sqlHris = "SELECT * FROM EMPLOYEE WHERE EMPID='". $id ."'";
      $HRISresult = $HRISdatabaseConnection->query($sqlHris);
      while ($HRISdata = $HRISresult->fetch(PDO::FETCH_ASSOC))
      {
        $lname = $HRISdata['LNAME'];
        $fname = $HRISdata['FNAME'];
        $mname = $HRISdata['MNAME'];
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
          if ($LockMessagevalue==2) 
          {
            $sqlDTR = "SELECT * FROM MSG WHERE EMPID='".$id."' AND MSGDATE='". $currdate ."'";
            $MSGresult = $DTRdatabaseConnection->query($sqlDTR); 
            while ($MSGDATA = $MSGresult->fetch(PDO::FETCH_ASSOC))
            {
              $datameSS = $MSGDATA['MESG'];
            }
            $sql = "UPDATE EMPLOYEE SET LOCK='1' WHERE EMPID='". $id ."'";
            // echo $sql;
            try 
            {
              if ($DTRdatabaseConnection->query($sql)) 
              {
                $msg = 'LOCK!';
                $Lockmsg = $datameSS;
              }
              else  
              {
                 //$msg = 'No Record Inserted';
              }
            } 
            catch(PDOException $e) {
              echo 'ERROR: ' . $e->getMessage();
            }
          }
          else
          {
            $sqlDTR = "SELECT * FROM TK WHERE EMPID='".$id."' AND DATESCAN='". $currdate ."'";
            $DTRresult = $DTRdatabaseConnection->query($sqlDTR);
            $currrows = $DTRresult->fetchAll();
            $currcount = count($currrows);

            if ($_POST['btnclick']=='OUTPM' && $PREVOUTPM==NULL && $currcount<=0) 
            {
              include('includes/OUTPM&NIGHTSHIFT.php');
              $NIGHTSHIFT = 1;
            }
            else if ($_POST['btnclick']=='OUTAM' && $PREVOUTPM==NULL && $currcount<=0)
            {
              include('includes/OUTAM&NIGHTSHIFT.php');
              $NIGHTSHIFT = 1;
            }
            else if ($_POST['btnclick']=='INPM'  && $PREVINPM==NULL && $PREVOUTPM==NULL && $currcount<=0 && $prevnum_rows>0)
            {
              include('includes/INPM&NIGHTSHIFT.php');
              $NIGHTSHIFT = 1;
            }
            else if ($_POST['btnclick']=='BREAKOUT' && $PREVOUTPM==NULL && $currcount<=0)
            {
              include('includes/BREAKOUT&NIGHTSHIFT.php');
              $NIGHTSHIFT = 1;
            }
            else if ($_POST['btnclick']=='BREAKIN' && $PREVOUTPM==NULL && $currcount<=0)
            {
              include('includes/BREAKIN&NIGHTSHIFT.php');
              $NIGHTSHIFT = 1;
            }
            else if ($_POST['btnclick']=='INOT' && $PREVOUTPM!=NULL  && $currcount<=0)
            {
              include('includes/OVERTIMEIN&NIGHTSHIFT.php');
              $NIGHTSHIFT = 1;
            }
            else if ($_POST['btnclick']=='OUTOT' && $PREVOUTPM!=NULL && $currcount<=0)
            {
              include('includes/OVERTIMEOUT&NIGHTSHIFT.php');
              $NIGHTSHIFT = 1;
            }
            else
            {
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
              $field = 'RDLOGTO';
              include('includes/Restday_log_Counter.php');
              $currdateVSRDLOGTOCount = count($currrows);

              $temp_date = $currdate;
              $field = 'RDLOGFROM';
              include('includes/Restday_log_Counter.php');
              $currdateVSRDLOGFROMCount = count($currrows);

              $temp_date = $prevdate;
              $field = 'RDLOGTO';
              include('includes/Restday_log_Counter.php');
              $PREVdateVSRDLOGTOCount = count($currrows);

              $temp_date = $prevdate;
              $field = 'RDLOGFROM';
              include('includes/Restday_log_Counter.php');
              $PREVdateVSRDLOGFROMCount = count($currrows);

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


 <?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>