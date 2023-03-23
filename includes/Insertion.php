<?php
  $sqlDTR = "SELECT * FROM TK WHERE EMPID='". $id ."' AND DATESCAN='". $currdate ."'";
  include('includes/TK_CURRENT.php');  
  if ($currcount>0 && $REMARKS==NULL) 
  {
    if($_POST['btnclick']=='INAM')
    {
      if ($INAM != NULL) {
        $msg = 'Already swiped INAM!';
      }
      else if($INPM !=NULL)
      {
        $Lockmsg = 'Dli naka maka swipe kay nag halfday man ka!';
      }
      else
      {
        if ($dateT->format('H:i') < $sfhtlateref) //if now is greater than the halfday reference
        {  
          $sql = "UPDATE TK SET INAM = '". $dateT->format('Y-m-d H:i') ."' WHERE EMPID='". $id ."' and DATESCAN='". $dateT->format('m-d-Y') ."' ";
          // echo $sql;
          try 
          {
            if ($DTRdatabaseConnection->query($sql)) 
            {
              $msg = 'Successfully Swipe INAM!';
            }
            else
            {
              //$msg = 'No Record Inserted';
            }
          }  
          catch(PDOException $e) 
          {
            echo 'ERROR: ' . $e->getMessage();
          }
        }
        else
        {
          $sql = "UPDATE EMPLOYEE SET LOCK='1' WHERE EMPID='". $id ."'";
          // echo $sql;
          try 
          {
            if ($HRISdatabaseConnection->query($sql)) 
            {
              $msg = 'LOCK - LATE!';
              $Lockmsg = 'Employee Status Locked, Report to HR'; 
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
      }
    }
    else if($_POST['btnclick']=='OUTAM')
    {
      if ($OUTAM != NULL) {
        $msg = 'Naka swipe naka sa OUTAM!';
      }
      else if($INAM == NULL && $INPM == NULL)
      {
        $Lockmsg = 'Dili pwede maka OUTAM kung walay INAM!';
      }
      else if($INAM == NULL && $INPM !=NULL)
      {
        $Lockmsg = 'Dli naka maka swipe kay nag halfday man ka!';
      }
      else 
      {
        $sql = "UPDATE TK SET OUTAM = '". $dateT->format('Y-m-d H:i') ."' WHERE EMPID='". $id ."' and DATESCAN='". $dateT->format('m-d-Y') ."' ";
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
    }
    else if($_POST['btnclick']=='INPM')
    {
      if($INPM != NULL) {
        $msg = 'Naka swipe naka sa INPM!';
      }
      else
      {
        if ($OUTAM ==NULL && $INAM !=NULL) {
          $msg = 'Dili pwede mag swipe ug INPM kung wala kay OUTAM!';
        }
        else
        {
          if ($OUTAM !=NULL && $INAM !=NULL) {
            $sql = "UPDATE TK SET INPM = '". $dateT->format('Y-m-d H:i') ."' WHERE EMPID='". $id ."' and DATESCAN='". $dateT->format('m-d-Y') ."' ";
            // echo $sql;
            try 
            {
              if ($DTRdatabaseConnection->query($sql)) 
              {
                 $msg = 'Successfully Swipe!';
              }
              else
              {
                 //$msg = 'No Record Inserted';
              }
            } 
            catch(PDOException $e) 
            {
              echo 'ERROR: ' . $e->getMessage();
            }
          }
          else
          {
            $sftunable = date('H:i',strtotime('-1 hour',strtotime($sfhthalfdayref)));
            if ($dateT->format('H:i') >= $sftunable)  
            {
              if ($dateT->format('H:i') < $sfhthalfdayref ) //if now is greater than the halfday reference
              {  
                $sql = "UPDATE TK SET INPM = '". $dateT->format('Y-m-d H:i') ."' WHERE EMPID='". $id ."' and DATESCAN='". $dateT->format('m-d-Y') ."' ";
                // echo $sql;
                try 
                {
                  if ($DTRdatabaseConnection->query($sql)) 
                  {
                     $msg = 'Successfully Swipe!';
                  }
                  else
                  {
                     //$msg = 'No Record Inserted';
                  }
                } 
                catch(PDOException $e) 
                {
                  echo 'ERROR: ' . $e->getMessage();
                }
              }
              else
              {
                $sql = "UPDATE EMPLOYEE SET LOCK='1' WHERE EMPID='". $id ."'";
                // echo $sql;
                try 
                {
                  if ($HRISdatabaseConnection->query($sql)) 
                  {
                    $msg = 'LOCK - LATE HALF DAY!';
                    $Lockmsg = 'Employee Status Locked, Report to HR'; 
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
            }
            else
            {
              $Lockmsg = 'You are not allow to swipe early in INPM. go to HR.'; 
            }
          }

        }
      }
    }
    else if($_POST['btnclick']=='BREAKIN')
    {
      if ($BREAKIN != NULL) {
        $msg = 'Naka swipe naka sa BREAKIN!';
      }
      else if($OUTPM != NULL )
      {
        $msg = 'Dili pwede mag BREAKOUT kung naka OUTPM naka!';
      }
      else
      {
        if ($BREAKOUT != NULL ) 
        {
          $sql = "UPDATE TK SET BREAKIN = '". $dateT->format('Y-m-d H:i') ."' WHERE EMPID='". $id ."' and DATESCAN='". $dateT->format('m-d-Y') ."' ";
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
          $msg = 'Dili ka ka BREAKIN kay wala kay BREAKOUT!';
        }
        
      } 
    }
    else if($_POST['btnclick']=='BREAKOUT')
    {
      if ($BREAKOUT != NULL) {
        $msg = 'Naka swipe naka sa BREAKOUT!';
      }
      else if($OUTPM!=NULL)
      {
        $msg = 'Dili pwede mag BREAKOUT kung naka OUTPM naka!';
      }
      else
      {
        $sql = "UPDATE TK SET BREAKOUT = '". $dateT->format('Y-m-d H:i') ."' WHERE EMPID='". $id ."' and DATESCAN='". $dateT->format('m-d-Y') ."' ";
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
    }
    else if($_POST['btnclick']=='OUTPM')
    {
      if ($OUTPM != NULL) {
        $msg = 'Naka swipe naka sa OUTPM!';
      }else{
        if (($INAM ==NULL && $INPM!=NULL)  || ($INAM !=NULL && $INPM!=NULL) ) {
          $sql = "UPDATE TK SET OUTPM = '". $dateT->format('Y-m-d H:i') ."' WHERE EMPID='". $id ."' and DATESCAN='". $dateT->format('m-d-Y') ."' ";
          //echo $sql;
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
          $msg = 'Dili pwede mag OUT PM kung walay IN AM/IN PM!';
        }
      } 
    }
    else if($_POST['btnclick']=='INOT')
    {
      if ($otvalue>0) {
        if ($INOT != NULL) {
          $msg = 'Naka swipe naka sa OVERTIMEIN!';
        }
        else if ($OUTPM == NULL) {
          $msg = 'Dili pwede mag OVERTIMEIN Kung wala pa ka out!';
        }
        else{

          $sql = "UPDATE TK SET OVERTIMEIN = '". $dateT->format('Y-m-d H:i') ."' WHERE EMPID='". $id ."' and DATESCAN='". $dateT->format('m-d-Y') ."' ";
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
      }
      else
      {
        $msg = 'Dili ka allowed mag Overtime!';
        $Lockmsg = 'Contact HR Personnel!';
      }
      
    }
    else if($_POST['btnclick']=='OUTOT')
    {
      if ($otvalue>0) {
        if ($OUTOT != NULL) {
          $msg = 'Naka swipe naka sa OVERTIMEOUT!';
        }
        else{
          if ($INOT != NULL) {
            $sql = "UPDATE TK SET OVERTIMEOUT = '". $dateT->format('Y-m-d H:i') ."' WHERE EMPID='". $id ."' and DATESCAN='". $dateT->format('m-d-Y') ."' ";
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
            $msg = 'Dili pwede mag OVERTIMEOUT kung walay OVERTIMEIN!';
          }
        } 
      }
      else
      {
        $msg = 'Dili ka allowed mag Overtime!';
        $Lockmsg = 'Contact HR Personnel!';
      }
    }
    else
    {
      $Lockmsg = 'PINDOT SA KUNG UNSA NGA TRANSAKSYON ANG IMUHANG GUSTO!';
    }
  }
  else //Para sa INAM UG INPM(HALFDAY) CASE
  {
    if($_POST['btnclick']=='INAM' && $REMARKS==null)
    {
      if ($dateT->format('H:i') < $sfhtlateref) //if now is greater than the halfday reference
      {  
        $sql = "INSERT INTO TK(EMPID, DATESCAN, INAM) VALUES('". $id ."', '". $dateT->format('Y-m-d') ."', '". $dateT->format('Y-m-d H:i') ."')";
        // echo $sql;
        try 
        {
          if ($DTRdatabaseConnection->query($sql)) 
          {
            $msg = 'Successfully Swipe!';
          }
          else
          {
            //$msg = 'No Record Inserted';
          }
        }  
        catch(PDOException $e) 
        {
          echo 'ERROR: ' . $e->getMessage();
        }
      }
      else
      {
        $sql = "UPDATE EMPLOYEE SET LOCK='1' WHERE EMPID='". $id ."'";
        // echo $sql;
        try 
        {
          if ($HRISdatabaseConnection->query($sql)) 
          {
            $msg = 'LOCK - LATE!';
            $Lockmsg = 'Employee Status Locked, Report to HR'; 
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
    }
    else if($_POST['btnclick']=='INPM' && $REMARKS==null)
    {
      $sftunable = date('H:i',strtotime('-1 hour',strtotime($sfhthalfdayref)));
      if ($dateT->format('H:i') >= $sftunable)  
      {
        if ($dateT->format('H:i') < $sfhthalfdayref ) //if now is greater than the halfday reference
        {  
          $sql = "INSERT INTO TK(EMPID, DATESCAN, INPM) VALUES('". $id ."', '". $dateT->format('Y-m-d') ."', '". $dateT->format('Y-m-d H:i') ."')";
          // echo $sql;
          try 
          {
            if ($DTRdatabaseConnection->query($sql)) 
            {
               $msg = 'Successfully Swipe!';
            }
            else
            {
               //$msg = 'No Record Inserted';
            }
          } 
          catch(PDOException $e) 
          {
            echo 'ERROR: ' . $e->getMessage();
          }
        }
        else
        {
          $sql = "UPDATE EMPLOYEE SET LOCK='1' WHERE EMPID='". $id ."'";
          // echo $sql;
          try 
          {
            if ($HRISdatabaseConnection->query($sql)) 
            {
              $msg = 'LOCK - LATE HALF DAY!';
              $Lockmsg = 'Employee Status Locked, Report to HR'; 
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
      }
      else
      {
        $Lockmsg = 'You are not allow to swipe early in INPM. go to HR.'; 
      }
    }
    else
    {
      $Lockmsg = 'INVALID TRANSACTION!';
    }
  }
?>

 <?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>