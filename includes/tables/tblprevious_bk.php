<table width="100%" class="table table-striped table-bordered table-hover" id="css_table_assigned" style="color: black">
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
            <th>REMARKS</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
      <?php  
      if (isset ($_POST['submit'])){
          if (!empty($_POST['empid'])) {
            date_default_timezone_set('Asia/Taipei');
            $currdate = date("d");

            include('../pages/config.php');
            if($EMPLOYMENTSTATUS=='AGENCY-GSL' || $EMPLOYMENTSTATUS=='PASECA' || $EMPLOYMENTSTATUS=='MAKABAYAN' || $EMPLOYMENTSTATUS=='CROWN')
            {
              $query = "select * from posttk where DATESCAN <= (SELECT tblcutoff_ref.FLDCUTOFFDATE from tblcutoff_ref WHERE tblcutoff_ref.FLDCOMPANY='AGENCY') and EMPID='".$id." '
                order by DATESCAN ASC";
            }
            else
            {
              $query = "select * from posttk where DATESCAN <= (SELECT tblcutoff_ref.FLDCUTOFFDATE from tblcutoff_ref WHERE tblcutoff_ref.FLDCOMPANY='DSG') and EMPID='".$id." '
                order by DATESCAN ASC";
            } 
            
            if($result = mysqli_query($connect, $query))
            {
                while($row = mysqli_fetch_array($result))  
                {  

                $INAM = $row['INAM'];
                $OUTAM = $row['OUTAM'];
                $INPM = $row['INPM'];
                $OUTPM = $row['OUTPM'];
                $BREAKIN = $row['BREAKIN'];
                $BREAKOUT = $row['BREAKOUT'];
                $REMARKS = $row['REMARKS'];
            
                $xplode = explode(' ', $INAM);
                $xplode1 = explode(' ', $OUTAM);
                $xplode2 = explode(' ', $INPM);
                $xplode3 = explode(' ', $OUTPM);
                $xplode4 = explode(' ', $BREAKOUT);
                $xplode5 = explode(' ', $BREAKIN);
                
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
                echo "<tr>".
                        "<td>".$row['EMPID']."</td>".
                        "<td>".$row['DATESCAN']."</td>".
                        "<td>".$DTINAM."</td>".
                        "<td>".$DTOUTAM."</td>".
                        "<td>".$DTINPM."</td>".
                        "<td>".$DTOUTPM."</td>".
                        "<td>".$DTBREAKIN."</td>".
                        "<td>".$DTBREAKOUT."</td>".
                        "<td>".$row['REMARKS']."</td>".
                    "<tr>";
                }  
                mysqli_close($connect);
            }
          }
        }
        
      ?>  
    </tbody>
</table>