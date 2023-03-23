<?php
	
	switch ($buttonNight) 
	{
		case 'OUTPM':
			if ($PREVOUTPM != NULL) {
			  $msg = 'Naka swipe naka sa OUT PM!';
			}
			else
			{
			  if (($PREVINAM ==NULL && $PREVINPM!=NULL)   || ($PREVINAM !=NULL && $PREVINPM!=NULL) ) {
			    $sql = "UPDATE TK SET OUTPM = '". $dateT->format('Y-m-d H:i') ."' WHERE EMPID='". $id ."' and DATESCAN='".$prevdate."' ";
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
			    $msg = 'Dili pwede mag OUT PM kung walay IN AM/IN PM!';
			  }
			}
			break;
		case 'OUTAM':
			if ($PREVOUTAM != NULL) {
			  $msg = 'Naka swipe naka sa OUT AM!';
			}
			else
			{
			  if ($PREVINAM !=NULL) {
			    $sql = "UPDATE TK SET OUTAM = '". $dateT->format('Y-m-d H:i') ."' WHERE EMPID='". $id ."' and DATESCAN='".$prevdate."' ";
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
			    $msg = 'Dili pwede mag OUT AM kung walay IN AM!';
			  }
			}
			break;
		case 'INPM':
			if ($PREVINPM != NULL) {
			  $msg = 'Naka swipe naka sa IN PM!';
			}
			else
			{
			  if ($PREVOUTAM !=NULL) {
			    $sql = "UPDATE TK SET INPM = '". $dateT->format('Y-m-d H:i') ."' WHERE EMPID='". $id ."' and DATESCAN='".$prevdate."' ";
			    // echo $sql;
			    try 
			    {
			      if ($DTRdatabaseConnection->query($sql)) 
			      {
			         $msg = 'Record Updated!';
			      }
			    } catch(PDOException $e) {
			      echo 'ERROR: ' . $e->getMessage();
			    }
			  }
			  else
			  {
			    $msg = 'Dili pwede mag IN PM kung walay OUT AM!';
			  }
			}
			break;
		case 'BREAKOUT':
			if ($PREVBREAKOUT != NULL) {
			  $msg = 'Naka swipe naka sa BREAKOUT!';
			}
			else if($PREVOUTPM != NULL)
			{
			  $msg = 'Dili pwede mag BREAK OUT kung naka OUT PM naka!';
			}
			else
			{
			  if ($PREVINPM !=NULL) {
			    $sql = "UPDATE TK SET BREAKOUT = '". $dateT->format('Y-m-d H:i') ."' WHERE EMPID='". $id ."' and DATESCAN='".$prevdate."' ";
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
			    $msg = 'Dili pwede mag BREAK OUT kung walay IN PM!';
			  }
			}
			break;
		case 'BREAKIN':
			if ($PREVBREAKIN != NULL) {
			  $msg = 'Naka swipe naka sa BREAK IN!';
			}
			else if($PREVOUTPM != NULL)
			{
			  $msg = 'Dili pwede mag BREAK OUT kung naka OUT PM naka!';
			}
			else
			{
			  if ($PREVBREAKOUT !=NULL) {
			    $sql = "UPDATE TK SET BREAKIN = '". $dateT->format('Y-m-d H:i') ."' WHERE EMPID='". $id ."' and DATESCAN='".$prevdate."' ";
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
			    $msg = 'Dili pwede mag BREAK IN kung walay BREAK OUT!';
			  }
			}
			break;
		case 'INOT':
			if ($otvalue>0) {
			  if ($PREVDTOVERTIMEIN != NULL) {
			    $msg = 'Naka swipe naka sa OVERTIMEIN!';
			  }
			  else if ($PREVOUTPM == NULL) {
			    $msg = 'Dili pwede mag OVERTIMEIN Kung wala pa ka OUTPM!';
			  }
			  else{

			    $sql = "UPDATE TK SET OVERTIMEIN = '". $dateT->format('Y-m-d H:i') ."' WHERE EMPID='". $id ."' and DATESCAN='". $prevdate ."' ";
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
			break;
		case 'OUTOT':
		  	if ($otvalue>0) {
		    	if ($PREVOVERTIMEOUT != NULL) {
		      	$msg = 'Naka swipe naka sa OVERTIME OUT!';
		    }
		    else{
		      	if ($PREVOVERTIMEIN != NULL) {
		        	$sql = "UPDATE TK SET OVERTIMEOUT = '". $dateT->format('Y-m-d H:i') ."' WHERE EMPID='". $id ."' and DATESCAN='". $prevdate."' ";
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
			        $msg = 'Dili pwede mag OVERTIME OUT kung walay OVERTIME IN!';
			      }
			    } 
		  	}
		  	else
		  	{
		    	$msg = 'Dili ka allowed mag Overtime!';
		    	$Lockmsg = 'Contact HR Personnel!';
		  	}
			break;
		default:
			# code...
			break;
	}

?>

 <?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>