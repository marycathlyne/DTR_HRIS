<?php
    include('config.php');
?>
<?php 
    $LNAME = $FNAME = $MNAME = $RDAY = $RDAY1 = $RESTDAY = $SHIFTNAME = $EMPLOYMENTSTATUS = $result = $LATEINAMREF = $SNACKREF = "";
    $TOTAL_MINS = $STATUS_SHIFT = $LATEREFPM = $MONDAYOUT = $MONDAYINREF = "";
    $dateformatINAM = $dateformatOUTAM = $dateformatINPM = $dateformatOUTPM = $cutoffdate = $FLDCUTOFFDATE = "";

    date_default_timezone_set('Asia/Taipei');
    $currdate = date("d");
    $dateformatINPM = "";
    $totalhour = $formatted_hours  = "" ;
    $dday = "";
    $totalmin = $minperday = $totminpwd  = "";
    $totmin = 60;
    $defaulthours = 0;
    $total_HWPD = $TOTAL_MINS = $totalminperday = "";
    $datef = $overall_hours = $formatted_hours = "";
    $pday = $totalmin = $minperday = $totminpwd  = "";
    $total_HWPD = $deds = $deductions =  "";
    $WHOLEDAY_UNDERTIME = $WHOLE = "";

    if (isset ($_POST['submit'])){
        if (!empty($_POST['empid'])) {
            include('hrisconnection.php');
            include('connection.php');

            $id = $_POST['empid'];
          
            $HRISsql = "select * from EMPLOYEE LEFT JOIN SHIFTING ON( EMPLOYEE.SHIFT_SCHED = SHIFTING.SHIFTNAME ) where empid = '".$id."'";
            $HRISresult = $HRISdatabaseConnection->query($HRISsql);
            $HRISresult->fetchAll(PDO::FETCH_ASSOC);
            $empcount = $HRISresult->rowCount();

            if ($empcount>0) {
                $sqlDTR = "SELECT EXTRACT(DAY FROM tblcutoff_ref.FLDCUTOFFDATE) AS DAYZ from tblcutoff_ref  WHERE tblcutoff_ref.FLDCOMPANY='DSG' ";
                $DTRresult = $DTRdatabaseConnection->query($sqlDTR);
                while ($DTRdata = $DTRresult->fetch(PDO::FETCH_ASSOC)){
                  $cutoffdate = $DTRdata['DAYZ'];
                }

                if ($cutoffdate == 25){
                    $prevmonth =  date("m", strtotime("-1 month"));
                    if ($currdate <11) {
                        $dday = date($prevmonth. "/11/Y") ;
                    }
                    else
                    {
                        $dday = date("m/11/Y") ;
                    }
                }
                else{
                    $prevmonth =  date("m", strtotime("-1 month"));
                    if($prevmonth == 12)
                    {
                        $dday = date($prevmonth. "/26/" . date("Y",strtotime("-1 year"))) ;
                    }
                    else
                    {
                        $dday = date($prevmonth. "/26/Y") ;
                    }
                    
                }

                foreach($HRISdatabaseConnection->query($HRISsql) as $data){
                    $LNAME = utf8_encode($data['LNAME']);
                    $FNAME = utf8_encode($data['FNAME']);
                    $MNAME = utf8_encode($data['MNAME']);
                    $RDAY = $data['RESTDAY'];
                    $RDAY1 = $data['RESTDAY1'];
                    $LATEINAMREF = $data['LATEINAMREF'];
                    $LATEREFPM = $data['LATEREFPM'];
                    $MONDAYINREF = $data['MONDAYINREF'];
                    $SHIFTNAME = $data['SHIFTNAME'];
                    $LUNCHREF = $data['LUNCHREF'];
                    $MONDAYOUT = $data['MONDAYOUT'];
                    $SNACKREF = $data['SNACKREF'];
                    $TOTAL_MINS = $data['TOTAL_MINS'];
                    $STATUS_SHIFT = $data['STATUS_SHIFT'];
                    $EMPLOYMENTSTATUS = $data['EMPLOYMENTSTATUS'];
                    $result = sprintf("%s, %s %s", $LNAME, $FNAME,$MNAME); 
                }
                $RESTDAY1 = strtoupper($RDAY1);
                
                if ($RESTDAY1 != "NO" && $RESTDAY1 != null) {
                    $RESTDAY = sprintf("%s & %s", $RDAY,$RDAY1); 
                }
                else
                {
                    $RESTDAY = sprintf("%s", $RDAY);
                }

                echo "<h2>"."<small>". "NAME: " . "</small><strong>". $result."</strong><small>". ' | ' . "</small>"."</h2>";
                echo "<h2>"."<small>". "STATUS: " . "</small><strong>". $EMPLOYMENTSTATUS."</strong><small>". ' | ' . "</small>"."</h2>";
                echo "<h2>"."<small>". "REST DAY: " . "</small><strong>". $RESTDAY."</strong><small>". ' | ' . "</small>"."</h2>";
                echo "<h2>"."<small>". "SHIFT: " . "</small><strong>". $SHIFTNAME."</strong><small>". ' | ' . "</small>"."</h2>";
                
                
            }
            $DTRdatabaseConnection   = null;  
            $HRISdatabaseConnection  = null; 
        }
    }
?>     