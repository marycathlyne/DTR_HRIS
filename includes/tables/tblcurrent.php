<table width="100%" class="table table-striped table-bordered table-hover" id="current_table" style="color: black">
    <thead>
        <tr>
            <th>EMPID</th>
            <th>DATESCAN</th>
            <th>INAM</th>
            <th>OUTAM</th>
            <th>INPM</th>
            <th>OUTPM</th>
            <th>BREAKOUT</th>
            <th>BREAKIN</th>
            <th>HWPD</th>
            <th>REMARKS</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        
        <?php
            if (isset ($_POST['submit']))
            {
               if (!empty($_POST['empid'])) 
               {
                  include('../pages/connection.php');

                  if($EMPLOYMENTSTATUS=='AGENCY-GSL' || $EMPLOYMENTSTATUS=='AGENCY-PASECA' || $EMPLOYMENTSTATUS=='AGENCY-MAKABAYAN' || $EMPLOYMENTSTATUS=='AGENCY-CROWN')
                  {
                     $sqlDTR = "select 
                        EMPID,
                        DATESCAN, 
                        INAM,
                        OUTAM, 
                        INPM, 
                        OUTPM, 
                        BREAKOUT,
                        BREAKIN, 
                        REMARKS, 
                        IIF(CASE INPM
                           WHEN null THEN 0
                           ELSE 
                                datediff (minute,  INPM,  OUTPM) 
                           END is null,0,datediff (minute,  INPM,  OUTPM) )  as PM,
                        IIF(CASE INAM
                           WHEN null THEN 0
                           ELSE 
                                datediff (minute,  INAM,  OUTAM) 
                           END is null,0,datediff (minute,  INAM,  OUTAM) )  as AM,
                        datediff (minute,  INAM,  OUTPM) as WHOLE,
                        IIF(REMARKS like '%LEAVE%', 1,0) AS LEAVE,
                        IIF(CASE OUTAM
                            WHEN null THEN 0
                            ELSE CASE INPM
                                 WHEN null THEN 0
                                 ELSE
                                     datediff(minute,OUTAM, INPM) 
                                 END
                        END is null,0,datediff(minute,OUTAM, INPM)) AS LUNCH,
                        IIF(CASE BREAKIN
                            WHEN null THEN 0
                            ELSE CASE BREAKOUT
                                 WHEN null THEN 0
                                 ELSE
                                     datediff(minute,BREAKOUT, BREAKIN) 
                                 END
                        END is null,0,datediff(minute,BREAKOUT, BREAKIN)) AS BREAK

                        from TK 
                        where DATESCAN > (SELECT tblcutoff_ref.FLDCUTOFFDATE from tblcutoff_ref WHERE tblcutoff_ref.FLDCOMPANY='AGENCY') 
                        AND EMPID='".$id." ' 
                        order by DATESCAN DESC";
                  }
                  else
                  {
                     $sqlDTR = "select 
                        EMPID,
                        DATESCAN, 
                        INAM,
                        OUTAM, 
                        INPM, 
                        OUTPM, 
                        BREAKOUT,
                        BREAKIN, 
                        REMARKS, 
                        IIF(CASE INPM
                           WHEN null THEN 0
                           ELSE 
                                datediff (minute,  INPM,  OUTPM) 
                           END is null,0,datediff (minute,  INPM,  OUTPM) )  as PM,
                        IIF(CASE INAM
                           WHEN null THEN 0
                           ELSE 
                                datediff (minute,  INAM,  OUTAM) 
                           END is null,0,datediff (minute,  INAM,  OUTAM) )  as AM,
                        datediff (minute,  INAM,  OUTPM) as WHOLE,
                        IIF(REMARKS like '%LEAVE%', 1,0) AS LEAVE,
                        IIF(CASE OUTAM
                            WHEN null THEN 0
                            ELSE CASE INPM
                                 WHEN null THEN 0
                                 ELSE
                                     datediff(minute,OUTAM, INPM) 
                                 END
                        END is null,0,datediff(minute,OUTAM, INPM)) AS LUNCH,
                        IIF(CASE BREAKIN
                            WHEN null THEN 0
                            ELSE CASE BREAKOUT
                                 WHEN null THEN 0
                                 ELSE
                                     datediff(minute,BREAKOUT, BREAKIN) 
                                 END
                        END is null,0,datediff(minute,BREAKOUT, BREAKIN)) AS BREAK

                        from TK 
                        where DATESCAN > (SELECT tblcutoff_ref.FLDCUTOFFDATE from tblcutoff_ref WHERE tblcutoff_ref.FLDCOMPANY='DSG') 
                        AND EMPID='".$id." ' 
                        order by DATESCAN DESC";
                  }

                  $total_HWPD = "";
                  $Result = $DTRdatabaseConnection->query($sqlDTR);
                  while ($DTRData = $Result->fetch(PDO::FETCH_ASSOC))
                  {
                    $halfdaydeductions = $deductions =  0;
                    $WHOLE = "";
                     $totalminperday = 0;
                     $DATESCAN = $DTRData['DATESCAN'];

                     $daynword = date("l",strtotime($DATESCAN));
                     $daynword = strtoupper($daynword);

                     //if ($daynword != $RDAY && $daynword != $RDAY1) 
                     //{
                        $INAM = $DTRData['INAM'];
                        $OUTAM = $DTRData['OUTAM'];
                        $INPM = $DTRData['INPM'];
                        $OUTPM = $DTRData['OUTPM'];
                        $BREAKIN = $DTRData['BREAKIN'];
                        $BREAKOUT = $DTRData['BREAKOUT'];
                        $REMARKS = $DTRData['REMARKS'];
                        $AM = $DTRData['AM'];
                        $PM = $DTRData['PM'];
                        $LUNCH = $DTRData['LUNCH'];
                        $BREAK = $DTRData['BREAK'];
                        $WHOLE = $DTRData['WHOLE'];

                        include('sections/_format_time.php');

                        $AMDifference = $PMDifference = $LATEDifference = $HALFDAYPPMTOTMININPMREF = $HALFDAYPMTOTMIN = -1;
                        $INAMRef = $OUTPMRef = -1;  //CHECK IF LATE
                        $OUTAM_VS_DAILYOUTREF = -1; //Chech if undertime (DAILY OUT REFERENCE) VS OUTAM
                        $OUTPM_VS_DAILYOUTREF = -1;
                        $INPM_VS_DAILYOUTREF = $halfdayPMdeductions = $OUTAM_VS_DAILYINREF = -1;
                        $HALFDAY_TOTAL_MINS_RENDERED_AM = $HALFDAY_TOTAL_MINS_RENDERED_PM = -1;
                        
                        /***************************************************************
                         * START
                         * PURPOSE: REFERENCES DEDUCTIONS FOR LATE
                         ***************************************************************/

                       //LATE
                        if ($INAM != null && $OUTAM != null) {
                           $INAMRef = $dateformatINAM . ' ' . $MONDAYINREF;
                           $LATEDifference = round((strtotime($INAM) - strtotime($INAMRef)) /60);
                        } 
                        
                        if ($INAM != null && $OUTAM != null && $INPM == null && $OUTPM == null ) {
                           //HALFDAY AM NO LUNCH
                           //CHECK IF OUTPM IS GREATER THAN THE OFFICIAL DAILY OUT REF TO CHECK IF UNDERTIME
                           $OUTPMRef = $dateformatOUTAM. ' ' . $MONDAYOUT;
                           $OUTAM_VS_DAILYOUTREF = round((strtotime($OUTPMRef) - strtotime($OUTAM)) /60);
                        } 
                        //HALFDAY PM 
                        //CHECK IF OUTPM IS GREATER THAN THE OFFICIAL DAILY OUT REF
                        if ($INAM == null && $OUTAM == null && $INPM != null && $OUTPM != null ) {
                           $OUTPMRef = $dateformatOUTPM. ' ' . $MONDAYOUT;
                           $INPM_VS_DAILYOUTREF = round((strtotime($OUTPMRef) - strtotime($OUTPM)) /60);
                        } 
                        
                        //WHOLEDAY
                        //CHECK IF OUTPM IS GREATER THAN THE OFFICIAL DAILY OUT REF
                        if ($INAM != null && $OUTAM != null && $INPM != null && $OUTPM != null ) {
                           $OUTPMRef = $dateformatOUTAM. ' ' . $MONDAYOUT;
                           $OUTPM_VS_DAILYOUTREF = round((strtotime($OUTPM) - strtotime($OUTPMRef)) /60);
                        }                     

                        if ($LATEDifference>0) {
                          $deductions += $LATEDifference;
                          $halfdaydeductions += $LATEDifference;
                        }

                        /***************************************************************
                         * END
                         * PURPOSE: REFERENCES FOR DEDUCTIONS
                         ***************************************************************/

                        /***************************************************************
                         * START
                         * PURPOSE: REFERENCES FOR HALFDAYS
                         ***************************************************************/
                        if ($INAM != null && $OUTPM == null ) 
                        {
                           $LateRefAMDATE = $dateformatINAM . ' ' . $LATEINAMREF;
                           $AMDifference = round((strtotime($OUTAM) - strtotime($LateRefAMDATE)) /60);
                        }

                        if ($INAM == null && $OUTAM == null  && $INPM != null && $OUTPM != null  ) {
                           $LateRefPMDATE = $dateformatINPM . ' ' . $LATEREFPM;
                           $PMDifference = round((strtotime($OUTPM) - strtotime($LateRefPMDATE)) /60);
                        }
                        
                        //HALF DAY PM TOTAL MINUTES
                        if ($INAM == null && $OUTAM == null  && $INPM != null && $OUTPM != null ) {
                           $OUTPMRef = $dateformatOUTPM. ' ' . $MONDAYOUT;
                           $HALFDAYPPMTOTMININPMREF = $dateformatINPM. ' ' . $LATEREFPM;
                           $HALFDAYPMTOTMIN = round((strtotime($OUTPMRef) - strtotime($HALFDAYPPMTOTMININPMREF)) /60);
                        } 

                        if ($OUTAM != null && $OUTAM != null && $INPM == null && $OUTPM == null ) {
                           //HALFDAY AM 
                           //CHECK IF OUTAM IS GREATER THAN THE OFFICIAL DAILY OUT REF
                           $INAMRef = $dateformatINAM. ' ' . $MONDAYINREF;
                           $HALFDAY_TOTAL_MINS_RENDERED_AM = round((strtotime($OUTAM) - strtotime($INAMRef)) /60);
                        } 

                        //HALFDAY PM
                        if ($INAM == null && $OUTAM == null && $INPM != null && $OUTPM != null ) {
                           $OUTPMRef = $dateformatOUTPM . ' ' . $MONDAYOUT;
                           $HALFDAY_TOTAL_MINS_RENDERED_PM= round((strtotime($OUTPMRef) - strtotime($INPM)) /60);
                        } 

                        //WHOLEDAY 
                        //CHECK IF OUTPM IS GREATER THAN THE OFFICIAL DAILY OUT REF
                        if ($INAM != null && $OUTAM != null && $INPM != null && $OUTPM != null ) {
                           $InAMRef = $dateformatINAM. ' ' . $MONDAYINREF;
                           $WHOLEDAY_UNDERTIME = round((strtotime($OUTPM) - strtotime($InAMRef)) /60);
                        }                     

                        
                        /***************************************************************
                         * END
                         * PURPOSE: REFERENCES FOR HALFDAYS
                         ***************************************************************/

                        if(is_null($WHOLE) )
                        {
                           //deductions
                           //HALFDAY PM
                           if ($INPM_VS_DAILYOUTREF > 0) {
                              $halfdaydeductions = $INPM_VS_DAILYOUTREF;
                           }

                           switch ($STATUS_SHIFT) 
                           {
                                case 0://REGULAR SHIFT
                                case 2://COMPRESSED
                                 if ($INAM != null && $INPM == null) {
                                    if ($OUTAM != null) 
                                    {
                                       if ($AM >= $HALFDAY_TOTAL_MINS_RENDERED_AM) {
                                          $totalminperday = $HALFDAY_TOTAL_MINS_RENDERED_AM;
                                       }
                                       else
                                       {
                                          $totalminperday = $AM;
                                       }
                                    }
                                    else
                                    {
                                       $totalminperday = "";
                                    }
                                 }
                                 else if ($INAM == null && $INPM != null) 
                                 {
                                    if ($OUTPM != null) 
                                    {
                                       if ($HALFDAY_TOTAL_MINS_RENDERED_PM >= $HALFDAYPMTOTMIN) {
                                          $totalminperday = $HALFDAYPMTOTMIN;
                                       }
                                       else
                                       {
                                          $totalminperday = $HALFDAY_TOTAL_MINS_RENDERED_PM;
                                       }
                                    }
                                    else
                                    {
                                       $totalminperday = "";
                                    }
                                    
                                 }else
                                 {
                                    $totalminperday = "";
                                 }
                                 break;
                              case 1://FLEXI SHIFT
                                 $totalminperday = $AM + $PMDifference;
                                 break;
                              case 3://NO LUNCH BREAK
                                 if (is_null($AM))
                                 {
                                    $totalminperday = "";
                                 }
                                 else
                                 {
                                    $totalminperday = $AM;
                                 }
                                 break;
                              default:
                                 # code...
                                 break;
                           }
                           if ($halfdaydeductions > 0) 
                           {
                              $totalminperday -= $halfdaydeductions;
                           }
                           $total_HWPD += $totalminperday;
                        }
                        else
                        {
                            $totalminperday = $WHOLE;   

                            switch ($STATUS_SHIFT) 
                            {
                                case 0://REGULAR SHIFT
                                case 2://COMPRESSED
                                    //WHOLEDAY DEDUCTIONS
                                    $deductions += $LUNCHREF;
                                    if ($LUNCH > $LUNCHREF) {
                                        $deductions += $LUNCH - $LUNCHREF;
                                    } 
                                    if ($BREAK > $SNACKREF) 
                                    {
                                        $deductions += $BREAK - $SNACKREF;
                                    }
                                
                                    if ($OUTAM_VS_DAILYOUTREF>0) {
                                        $deductions += $OUTAM_VS_DAILYOUTREF;
                                    }
                                    if (($totalminperday - $deductions) >= $TOTAL_MINS) {
                                        if ($deductions > $LUNCHREF) {
                                            $totalminperday =  $TOTAL_MINS - ($deductions - $LUNCHREF);
                                        }
                                        else{
                                            $totalminperday =  $TOTAL_MINS;
                                        }
                                        $total_HWPD += $totalminperday;
                                    }
                                    else
                                    {   
                                        $totalminperday =  $WHOLEDAY_UNDERTIME - $deductions;

                                        if ($totalminperday>0) 
                                        {
                                            $totalminperday =  $totalminperday;
                                        }
                                        else
                                        {
                                            $totalminperday =  "";
                                        }
                                        $total_HWPD += $totalminperday;
                                    }  
                                break;
                              case 1://FLEXI SHIFT
                                $totalminperday = $WHOLE; 

                                $deductions = $LUNCHREF;
                                if ($LUNCH > $LUNCHREF) {
                                    $deductions += $LUNCH - $LUNCHREF;
                                } 
                                if ($BREAK > $SNACKREF) 
                                {
                                    $deductions += $BREAK - $SNACKREF;
                                }

                                if (($totalminperday - $deductions) >= $TOTAL_MINS) {
                                    if ($deductions > $LUNCHREF) {
                                        $totalminperday =  $TOTAL_MINS - ($deductions - $LUNCHREF);
                                    }
                                    else{
                                        $totalminperday =  $TOTAL_MINS;
                                    }
                                    $total_HWPD += $totalminperday;
                                }
                                else
                                {   
                                    $totalminperday =  $WHOLE - $deductions;

                                    if ($totalminperday>0) 
                                    {
                                        $totalminperday =  $totalminperday;
                                    }
                                    else
                                    {
                                        $totalminperday =  "";
                                    }
                                    $total_HWPD += $totalminperday;
                                }  
                                
                                break;
                              case 3://NO LUNCH BREAK
                                 if (is_null($AM))
                                 {
                                    $totalminperday = "";
                                 }
                                 else
                                 {
                                    $totalminperday = $AM;
                                 }
                                 break;
                              default:
                                 # code...
                                 break;
                            }

                        }
                        
                        /**********************************************
                         * FINAL COMPUTATION
                         **********************************************/
                        $hours = floor($totalminperday / 60);
                        $min = $totalminperday - ($hours * 60);
                        if ($hours < 1) {
                           $hours = "";
                           $min = "";
                           $formatted = ""; 
                        }
                        else
                        {
                           $formatted = sprintf("%02d:%02d", $hours, $min); 
                        }

                        $overall_hours = $total_HWPD / 480;
                        $formatted_hours= number_format($overall_hours, 2);
                        $varhd = 0;
                        if($DTINAM == "" && $DTOUTAM == "")
                        {
                           $varhd++;
                        }

                        if($DTINPM == "" && $DTOUTPM == "")
                        {
                           $varhd++;
                        }

                        if($varhd < 1)
                        {
                           echo  "<tr>".
                           "<td>".$id."</td>".
                           "<td>".$DATESCAN."</td>".
                           "<td>".$DTINAM."</td>".
                           "<td>".$DTOUTAM."</td>".
                           "<td>".$DTINPM."</td>".
                           "<td>".$DTOUTPM."</td>".
                           "<td>".$DTBREAKOUT."</td>".
                           "<td>".$DTBREAKIN."</td>".
                           "<td>".$formatted."</td>".
                           "<td>".$REMARKS."</td>".
                        "</tr>";
                        }
                        
                     //}
                     
                  }
                  $DTRDB_Connection   = null; 
               }
            }  
        ?>
    </tbody>
  </table>
  <table width="100%" class="table table-striped table-bordered table-hover" id="prev" style="color: black;border-style: transparent">
    <thead>
        <tr>
        </tr>
    </thead>
      <tbody style="text-align: center;">
      <?php  
          if (isset ($_POST['submit']))
          {
              if (!empty($_POST['empid'])) 
              {
                echo "<tr>".
                       "<td style='font-weight:bold;font-size:16px;text-align:left'>". 'NOTE: TOTAL HOURS shown does not include LEAVE and HOLIDAYS' ."</td>".
                       "<h2>"."<td style='font-weight:bold;font-size:16px;text-align:left'>"."<small>". "Total Days Present: " . "</small>". $formatted_hours."<small>". "</small>"."</td>"."</h2>".
                   "</tr>";
               }
          }      
      ?> 
    </tbody>
  </table>