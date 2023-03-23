<!DOCTYPE html>
<html lang="en">
<head>
  <title>Gaisano Mall of Davao</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="css/bootstrap.css">-->
  <link rel="stylesheet" href="css/style.css"> 
  <link id="bootstrap-style" href="css-template/bootstrap.min.css" rel="stylesheet">
  <link href="css-template/bootstrap-responsive.min.css" rel="stylesheet">
  <link id="base-style" href="css-template/style.css" rel="stylesheet">
  <link id="base-style-responsive" href="css-template/style-responsive.css" rel="stylesheet">
  <style type="text/css">
    body { background: url(img/bg-login.jpg) !important; }
  </style>
  <script type="text/javascript">
   function checkNumber(that){
   if(isNaN(that.value)) 
     { 
       that.value =""
       that.focus(); 
       return (false); 
     }
     var clickbtn = $("#empid").text();  
  }
  </script>
</head>
<body>
<br/><br/>
  <div class="container-fluid" >
    <form class="form-horizontal" method="POST" action="" autocomplete="off">
      <div class="box-content">
        <div class="box-header">
        <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Daily Time Record Inquiry</h2>
        <div class="box-icon">
          <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
          <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
          <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
        </div>
      </div>
      <div class="control-group">
        <br/>
        <input id="appendedInputButton" name="empid" size="16" type="text" onkeyup="checkNumber(this);" maxlength="11" autofocus ><button class="btn" type="submit" name="submit" value="OK" >Go!</button>
      </div>
        <table class="table table-striped table-bordered table-condensed">
            <thead>
              <?php
                  include('pages/connection.php')
                ?>
                
                <?php 
                  $LNAME = $FNAME = $MNAME = $RDAY = $SHIFTNAME = $EMPLOYMENTSTATUS = "";

                  if (isset ($_POST['submit'])){
                    if (!empty($_POST['empid'])) {
                      $id = $_POST['empid'];
                      $LNAME = $FNAME = $MNAME = $RDAY = $RESTDAY1 = $SHIFTNAME = $EMPLOYMENTSTATUS = "";
                      $DTRsql = "SELECT * FROM tbltempemployee where EMPID = '".$id."'";
                      $DTRresult = $DTRdatabaseConnection->query($DTRsql);
                      $rows = $DTRresult->fetchAll();
                      $empcount = count($rows);

                      if ($empcount>0) {
                        $DTRsql = "SELECT * FROM tbltempemployee where EMPID = '".$id."'";
                        foreach($DTRdatabaseConnection->query($DTRsql) as $data){
                        $LNAME = utf8_encode($data['LNAME']);
                        $FNAME = utf8_encode($data['FNAME']);
                        $MNAME = utf8_encode($data['MNAME']);
                        $RDAY = $data['RESTDAY'];
                        $SHIFTNAME = $data['SHIFTNAME'];
                        $EMPLOYMENTSTATUS = $data['EMPLOYMENTSTATUS'];
                        $result = sprintf("%s, %s %s", $LNAME, $FNAME,$MNAME); 
                         echo "<tr>".
                                "<th style='font-size:18px'> NAME: ". $result."</th>".
                                "<th> " . "</th>".
                              "</tr>".
                              "<tr>".
                                "<th style='font-size:18px'> RESTDAY: ". $RDAY ."</th>".
                                "<th style='font-size:18px'> SHIFT: ". $SHIFTNAME."</th>".
                              "</tr>";
                        }
                      }
                    }
                  }
                  $databaseConnection = null
                ?>                          
            </thead>
        </table>
      </div>
      <div class="box-content">
        <div class="rows">
          <ul class="nav nav-tabs" id="myTab">
              <li class="active">
                  <a href="#home" role="tab" data-toggle="tab">
                      <icon class="fa fa-home"></icon> CURRENT
                  </a>
              </li>
              <li>
                  <a href="#assigned" role="tab" data-toggle="tab">
                      <i class="fa fa-user"></i> PREVIOUS
                  </a>
              </li>
          </ul>
      
          <!-- Tab panes -->
          <div class="tab-content">
              <div class="tab-pane fade active in" id="home">
                  <div class="rows">
                      <div class="panel panel-default">
                          <div class="panel-body">
                              <?php 
                                  include('../includes/tables/tblcurrent.php');
                              ?>
                          </div>
                      </div> 
                  </div>  
              </div>
              <div class="tab-pane fade" id="assigned">
                  <div class="rows">
                      <div class="panel panel-default">
                          <div class="panel-body">
                              <?php 
                                  include('../includes/tables/tblprevious.php');
                              ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div><!--END OF ROWS-->
      </div>
      <a href="./index.php" class="btn" style="background-color: ">BACK</a>
    </form>
  </div>
  <!-- start: JavaScript-->


    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/jquery-migrate-1.0.0.min.js"></script>
    <script src="js/jquery-ui-1.10.0.custom.min.js"></script>
  
    <script src="js/jquery.ui.touch-punch.js"></script>
  
    <script src="js/modernizr.js"></script>
  
    <script src="js/bootstrap.min.js"></script>
  
    <script src="js/jquery.cookie.js"></script>
  
    <script src='js/fullcalendar.min.js'></script>
  
    <script src='js/jquery.dataTables.min.js'></script>

    <script src="js/excanvas.js"></script>
  <script src="js/jquery.flot.js"></script>
  <script src="js/jquery.flot.pie.js"></script>
  <script src="js/jquery.flot.stack.js"></script>
  <script src="js/jquery.flot.resize.min.js"></script>
  
    <script src="js/jquery.chosen.min.js"></script>
  
    <script src="js/jquery.uniform.min.js"></script>
    
    <script src="js/jquery.cleditor.min.js"></script>
  
    <script src="js/jquery.noty.js"></script>
  
    <script src="js/jquery.elfinder.min.js"></script>
  
    <script src="js/jquery.raty.min.js"></script>
  
    <script src="js/jquery.iphone.toggle.js"></script>
  
    <script src="js/jquery.uploadify-3.1.min.js"></script>
  
    <script src="js/jquery.gritter.min.js"></script>
  
    <script src="js/jquery.imagesloaded.js"></script>
  
    <script src="js/jquery.masonry.min.js"></script>
  
    <script src="js/jquery.knob.modified.js"></script>
  
    <script src="js/jquery.sparkline.min.js"></script>
  
    <script src="js/counter.js"></script>
  
    <script src="js/retina.js"></script>

    <script src="js/custom.js"></script>
  <!-- end: JavaScript-->
</body>
</html>
