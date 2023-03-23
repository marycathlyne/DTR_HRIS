
<table width="100%" class="table table-striped table-bordered table-hover" id="previous_table" style="color: black">
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
							date_default_timezone_set('Asia/Taipei');
							$currdate = date("d");
							$pday = $totalhour  = 0 ;
							$dday = "";
			                $prev_connection= $DTRdatabaseConnection;

							if ($currdate> 10 && $currdate <26) {
								$dday = date("m/26/Y") ;
								echo $dday;
							}
							else
							{
								$prevmonth =  date("m", strtotime("-1 month"));
								 $dday = date($prevmonth. "/11/Y") ;
							}
							if($EMPLOYMENTSTATUS=='AGENCY-GSL' || $EMPLOYMENTSTATUS=='PASECA' || $EMPLOYMENTSTATUS=='MAKABAYAN' || $EMPLOYMENTSTATUS=='CROWN')
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
		                                  CASE OUTAM
		        				       	WHEN  null THEN IIF(CASE OUTPM
		        				                            WHEN null THEN 0
		        				                            ELSE 
		        				                                 datediff (minute,  INPM,  OUTPM) 
		        				                            END is null,0,datediff (minute,  INPM,  OUTPM) ) 
		        				       	ELSE CASE OUTPM
		        				            WHEN null THEN IIF(CASE INAM
		        				                            WHEN null THEN 0
		        				                            ELSE 
		        				                                 datediff (minute,  INAM,  OUTAM) 
		        				                            END is null,0,datediff (minute,  INAM,  OUTAM) ) 
		        				            ELSE 
		        				                  IIF(CASE INAM
		        				                            WHEN null THEN 0
		        				                            ELSE 
		        				                                 datediff (minute,  INAM,  OUTPM) 
		        				                            END is null,0,datediff (minute,  INAM,  OUTPM))  
		        				            END
		        				       	END as aswhole,
		                                  IIF((IIF(CASE INAM
		                                      WHEN  null THEN 0
		                                      ELSE CASE OUTAM
		                                          WHEN null THEN 0
		                                          ELSE 
		                                              datediff (hour,  INAM,  OUTAM) 
		                                          END
		                                      END is null,0,datediff (hour,  INAM,  OUTAM)) +
		                                  IIF(CASE OUTAM
		                                      WHEN null THEN 0
		                                      ELSE CASE OUTPM
		                                          WHEN null THEN 0
		                                          ELSE
		                                              datediff(hour,INPM, OUTPM) 
		                                          END
		                                      END is null,0,datediff(hour,INPM, OUTPM) )
		                                  >8)
		                                  ,8
		                                  ,IIF(CASE INAM
		                                      WHEN  null THEN 0
		                                      ELSE CASE OUTAM
		                                          WHEN null THEN 0
		                                          ELSE 
		                                              datediff (hour,  INAM,  OUTAM) 
		                                          END
		                                      END is null,0,datediff (hour,  INAM,  OUTAM))  +
		                                      IIF(CASE OUTAM
		                                          WHEN null THEN 0
		                                          ELSE CASE OUTPM
		                                              WHEN null THEN 0
		                                              ELSE
		                                                  datediff(hour,INPM, OUTPM) 
		                                              END
		                                          END is null,0,datediff(hour,INPM, OUTPM))
		                                      ) AS HWPD,
		                                  IIF(CASE OUTAM
		                                      WHEN  null THEN 0
		                                      ELSE CASE INAM
		                                           WHEN null THEN 0
		                                           ELSE 
		                                                datediff (minute,  INAM,  OUTAM) 
		                                           END
		                                      END is null,0,datediff (minute,  INAM,  OUTAM))  +
		                                  IIF(CASE OUTPM
		                                       WHEN null THEN 0
		                                       ELSE CASE INPM
		                                            WHEN null THEN 0
		                                            ELSE
		                                                datediff(minute,INPM, OUTPM) 
		                                            END
		                                       END is null,0,datediff(minute,INPM, OUTPM)) AS MWPD,
		                                  IIF(CASE OUTAM
		                                      WHEN  null THEN 0
		                                      ELSE CASE INAM
		                                           WHEN null THEN 0
		                                           ELSE 
		                                                datediff (minute,  INAM,  OUTAM) 
		                                           END
		                                      END is null,0,datediff (minute,  INAM,  OUTAM))  AS AMVAL,
		                                  IIF(CASE OUTPM
		                                       WHEN null THEN 0
		                                       ELSE CASE INPM
		                                            WHEN null THEN 0
		                                            ELSE
		                                                datediff(minute,INPM, OUTPM) 
		                                            END
		                                       END is null,0,datediff(minute,INPM, OUTPM)) AS PMVAL,
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
		        					   datediff (minute,  INAM,  OUTPM) as whole,
		                                  IIF(REMARKS like '%LEAVE%', 1,0) AS LEAVE,
		                                  /*GET LUNCH*/
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
													from POSTTK 
													where DATESCAN BETWEEN '".$dday."' AND (SELECT tblcutoff_ref.FLDCUTOFFDATE from tblcutoff_ref WHERE tblcutoff_ref.FLDCOMPANY='AGENCY') 
													and EMPID='".$id." ' OR REMARKS like '%LEAVE%'
													order by DATESCAN ASC";
							}
							else
							{
								 $sqlDTR = "DELETE FROM POSTTK where DATESCAN BETWEEN '".$dday."' AND  (SELECT tblcutoff_ref.FLDCUTOFFDATE from tblcutoff_ref WHERE 
													tblcutoff_ref.FLDCOMPANY='DSG') 
													and EMPID='".$id." ' 
													and INAM is null 
													and OUTAM is null 
													and INPM is null
													and OUTPM is null
													and BREAKOUT is null
													and BREAKIN is null
													and REMARKS is null
													order by DATESCAN ASC";
									$DTRresultprev = $prev_connection->query($sqlDTR);
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
			                                  CASE OUTAM
			        				       	WHEN  null THEN IIF(CASE OUTPM
			        				                            WHEN null THEN 0
			        				                            ELSE 
			        				                                 datediff (minute,  INPM,  OUTPM) 
			        				                            END is null,0,datediff (minute,  INPM,  OUTPM) ) 
			        				       	ELSE CASE OUTPM
			        				            WHEN null THEN IIF(CASE INAM
			        				                            WHEN null THEN 0
			        				                            ELSE 
			        				                                 datediff (minute,  INAM,  OUTAM) 
			        				                            END is null,0,datediff (minute,  INAM,  OUTAM) ) 
			        				            ELSE 
			        				                  IIF(CASE INAM
			        				                            WHEN null THEN 0
			        				                            ELSE 
			        				                                 datediff (minute,  INAM,  OUTPM) 
			        				                            END is null,0,datediff (minute,  INAM,  OUTPM))  
			        				            END
			        				       	END as aswhole,
			                                  IIF((IIF(CASE INAM
			                                      WHEN  null THEN 0
			                                      ELSE CASE OUTAM
			                                          WHEN null THEN 0
			                                          ELSE 
			                                              datediff (hour,  INAM,  OUTAM) 
			                                          END
			                                      END is null,0,datediff (hour,  INAM,  OUTAM)) +
			                                  IIF(CASE OUTAM
			                                      WHEN null THEN 0
			                                      ELSE CASE OUTPM
			                                          WHEN null THEN 0
			                                          ELSE
			                                              datediff(hour,INPM, OUTPM) 
			                                          END
			                                      END is null,0,datediff(hour,INPM, OUTPM) )
			                                  >8)
			                                  ,8
			                                  ,IIF(CASE INAM
			                                      WHEN  null THEN 0
			                                      ELSE CASE OUTAM
			                                          WHEN null THEN 0
			                                          ELSE 
			                                              datediff (hour,  INAM,  OUTAM) 
			                                          END
			                                      END is null,0,datediff (hour,  INAM,  OUTAM))  +
			                                      IIF(CASE OUTAM
			                                          WHEN null THEN 0
			                                          ELSE CASE OUTPM
			                                              WHEN null THEN 0
			                                              ELSE
			                                                  datediff(hour,INPM, OUTPM) 
			                                              END
			                                          END is null,0,datediff(hour,INPM, OUTPM))
			                                      ) AS HWPD,
			                                  IIF(CASE OUTAM
			                                      WHEN  null THEN 0
			                                      ELSE CASE INAM
			                                           WHEN null THEN 0
			                                           ELSE 
			                                                datediff (minute,  INAM,  OUTAM) 
			                                           END
			                                      END is null,0,datediff (minute,  INAM,  OUTAM))  +
			                                  IIF(CASE OUTPM
			                                       WHEN null THEN 0
			                                       ELSE CASE INPM
			                                            WHEN null THEN 0
			                                            ELSE
			                                                datediff(minute,INPM, OUTPM) 
			                                            END
			                                       END is null,0,datediff(minute,INPM, OUTPM)) AS MWPD,
			                                  IIF(CASE OUTAM
			                                      WHEN  null THEN 0
			                                      ELSE CASE INAM
			                                           WHEN null THEN 0
			                                           ELSE 
			                                                datediff (minute,  INAM,  OUTAM) 
			                                           END
			                                      END is null,0,datediff (minute,  INAM,  OUTAM))  AS AMVAL,
			                                  IIF(CASE OUTPM
			                                       WHEN null THEN 0
			                                       ELSE CASE INPM
			                                            WHEN null THEN 0
			                                            ELSE
			                                                datediff(minute,INPM, OUTPM) 
			                                            END
			                                       END is null,0,datediff(minute,INPM, OUTPM)) AS PMVAL,
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
			        					   datediff (minute,  INAM,  OUTPM) as whole,
			                                  IIF(REMARKS like '%LEAVE%', 1,0) AS LEAVE,
			                                  /*GET LUNCH*/
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
														from POSTTK 
														where DATESCAN BETWEEN '".$dday."' AND  (SELECT tblcutoff_ref.FLDCUTOFFDATE from tblcutoff_ref WHERE tblcutoff_ref.FLDCOMPANY='DSG') 
														and EMPID='".$id." ' 
														order by DATESCAN ASC";
							} 
							$pday = $totalmin = $minperday = $totminpwd = $minperday = 0;
			                $totmin = 60;
			                $defaulthours = 0;
			                $total_HWPD = $deds = $deductions =  0;
			                $datef = $overall_hours = "";


			                $DTRresultprev = $prev_connection->query($sqlDTR);
			                while ($DTRdata = $DTRresultprev->fetch(PDO::FETCH_ASSOC))
			                {
			                	$deductions =  0;
			                	$totalminperday = 0;
			                    $DATESCAN = $DTRdata['DATESCAN'];
			                    $INAM = $DTRdata['INAM'];
			                    $OUTAM = $DTRdata['OUTAM'];
			                    $INPM = $DTRdata['INPM'];
			                    $OUTPM = $DTRdata['OUTPM'];
			                    $BREAKIN = $DTRdata['BREAKIN'];
			                    $BREAKOUT = $DTRdata['BREAKOUT'];
			                    $REMARKS = $DTRdata['REMARKS'];
			                    $AM = $DTRdata['AM'];
			                    $PM = $DTRdata['PM'];
			                	$LUNCH = $DTRdata['LUNCH'];
			                	$BREAK = $DTRdata['BREAK'];
			                	$WHOLE = $DTRdata['WHOLE'];

			                    include('sections/_format_time.php');

			                    
							    $xplode5f = explode(" ", $INAM);
							    
							    if($INAM == null)
							    {
							      $timef ="";
							      $DTINAMf = "";
							    } else
							    {
							      $timef = $xplode[0];
							      $datef = new DateTime($timef);
							      $dateformatINAM = $datef->format('Y-m-d');
							      $DTINAMf = $datef->format("h:i A");
							    }

							    $LateRefDATE = $dateformatINAM . ' ' . $LATEINAMREF;

								$date1 = $LateRefDATE;
								$date2 = $INAM;
								$difference = round((strtotime($date2) - strtotime($date1)) /60);

			                    if ($LUNCH > $LUNCHREF) {
			                    	$deductions += $LUNCH - $LUNCHREF;
			            		} 
			            		if ($BREAK > $SNACKREF) 
			        			{
			        				$deductions += $BREAK - $SNACKREF;
			            		}

			            		// $totalminperday =  $WHOLE - $deductions;

			            		if(is_null($WHOLE)) {
			        				$totalminperday = $AM + $PM - $deductions;
			        			}
			        			else
			        			{
			        				$totalminperday = ($WHOLE - 60) - $deductions ;
			        			}

			            		if ($totalminperday<$TOTAL_MINS) 
			            		{
			        				$totalminperday =  $totalminperday;
			        				$total_HWPD += $totalminperday;
			        			}
			        			else
			        			{
			        				$totalminperday =  $TOTAL_MINS;
			        				$total_HWPD += $TOTAL_MINS;

			        				// $totalminperday =  $TOTAL_MINS;
			        				// $total_HWPD += $TOTAL_MINS;
			        				// $deds = $totalminperday;
			        			}
			        		

			                    // if ($DTRdataCUR['LEAVE'] =='1') {
			                    //     $totalmin+=8;
			                    // }
			                   switch ($STATUS_SHIFT) {
			                    	case 0://REGULAR SHIFT
			                    		$defaulthours = 8;

			                    		break;
			                    	case 1://FLEXI SHIFT
							        	$defaulthours = 10;	
			                    		break;
			                    	case 2://NIGHT SHIFT
			                    		$defaulthours = 8;
			                    		break;
			                    	default:
			                    		# code...
			                    		break;
			                    }

			                    //$minperday = floor($totalminperday / 60).':'.($totalminperday -   floor($totalminperday / 60) * 60);
			                    $totminpwd += $totalminperday;

								$hours = floor($totalminperday / 60);
								$min = $totalminperday - ($hours * 60);

								$formatted = sprintf("%02d:%02d", $hours, $min); 

			                    echo  "<tr>".
			                          "<td>".$DTRdata['EMPID']."</td>".
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

			                $overall_hours = floor($totminpwd/$defaulthours / 60).'.'.($totminpwd -   floor($totminpwd / 60) * 60);

			                }

			?>  
		</tbody>
</table>