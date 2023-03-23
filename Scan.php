<?php
  include('pages/config.php');
?>
<html lang="en">
    <head>
        <title>DTR SCANNING</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/jquery.loadingModal.css">

        <style>

            body { 
                background: url(img/bg-login.jpg) !important; 
                font-family:'Open Sans';
            }
            #wrapper {
                text-align: center;
                padding: 30px;
            }
        </style>
        <script type="text/javascript">
            
            function showModal() {
                $('body').loadingModal({text: 'Data Processing...'});

                var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
                var time = 50000;

                delay(time)
                      // .then(function() { $('body').loadingModal('animation', 'rotatingPlane').loadingModal('backgroundColor', 'red'); return delay(time);})
                      // .then(function() { $('body').loadingModal('animation', 'wave'); return delay(time);})
                      // .then(function() { $('body').loadingModal('animation', 'wanderingCubes').loadingModal('backgroundColor', 'green'); return delay(time);})
                      // .then(function() { $('body').loadingModal('animation', 'spinner'); return delay(time);})
                      // .then(function() { $('body').loadingModal('animation', 'chasingDots').loadingModal('backgroundColor', 'blue'); return delay(time);})
                      .then(function() { $('body').loadingModal('animation', 'threeBounce'); return delay(time);})
                      .then(function() { $('body').loadingModal('animation', 'circle').loadingModal('backgroundColor', 'black'); return delay(time);})
                      // .then(function() { $('body').loadingModal('animation', 'cubeGrid'); return delay(time);})
                      // .then(function() { $('body').lo`adingModal('animation', 'fadingCircle').loadingModal('backgroundColor', 'gray'); return delay(time);})
                      // .then(function() { $('body').loadingModal('animation', 'foldingCube'); return delay(time); } )
                      // .then(function() { $('body').loadingModal('color', 'black').loadingModal('text', 'Done :-)').loadingModal('backgroundColor', 'yellow');  return delay(time); } )
                      .then(function() { $('body').loadingModal('hide'); return delay(time); } )
                      .then(function() { $('body').loadingModal('destroy') ;} );
            }
            function checkNumber(that){
                if(isNaN(that.value)) 
                {     
                   that.value =""
                   that.focus(); 
                   return (false); 
                }
                var clickbtn = $("#empid").text(); 
                // showModal(); 
            }

        </script>
        <script src="js/jquery-buttons.js"></script>
        <script src="js/dtrjquery.js"></script>
    </head>
    <body onload="showModal()" >  
        <div id="body_container">
            <div class="container">
              <div class="row">
                <div class="col-md-8">
                  <img src="img/DAVAO.jpg" class="img-thumbnail" alt="" style="height:180px;width:100%" />
                    <div class="row">
                      <br/>
                      <?php
                        include('TwoDaysRestDay.php');
                      ?>
                      <div class="button-click">  
                        <label for="buttonclick" id="buttonclick">
                          <?php
                            include('includes/buttonvalue.php');
                          ?>
                        </label>
                      </div>
                      <div class="col-md-7" style="background-color:transparent;">
                        <?php include ('js/RealTime.js');?>
                        <div id="clockbox"></div>
                        <div id="clockbox2" style="float:left;color:yellow"></div>
                        <div id="clockbox3" style="float:right;color:yellow"></div>
                        <br/>
                        <label  class="labeldesign" >IN AM  </label><span id="LINAM" class="badge" ><?php echo $DTINAM;?></span></button><br/>
                        <label  class="labeldesign" >OUT AM </label><span id="LOUTAM"  class="badge"><?php echo $DTOUTAM;?></span></button><br/><br/>
                        <label  class="labeldesign" >IN PM  </label><span  id="LINPM" class="badge"><?php echo $DTINPM;?></span></button><br/>
                        <label  class="labeldesign" >OUT PM </label><span id="LOUTPM" class="badge"><?php echo $DTOUTPM;?></span></button><br/><br/>
                        <label  class="labeldesign" >BREAK OUT </label><span id="LBREAKOUT" class="badge"><?php echo $DTBREAKOUT;?></span></button><br/>
                        <label  class="labeldesign" >BREAK IN  </label><span id="LBREAKIN" class="badge"><?php echo $DTBREAKIN;?></span></button><br/><br/>
                        <label  class="labeldesign" >OVERTIME IN </label><span id="LOVERTIMEIN" class="badge"><?php echo $DTOTIN;?></span></button><br/>
                        <label  class="labeldesign" >OVERTIME OUT</label><span id="LOVERTIMEOUT" class="badge"><?php echo $DTOTOUT;?></span></button>
                      </div>
                      <div class="col-md-5" style="background-color:transparent">
                        <br/><br/><br/>
                        <div class="thumbnail">
                          <img id="Picture" src="data:image/jpeg;base64,<?php echo base64_encode( $emppix ); ?>" onerror="this.src='img/default.jpg'">
                        </div>
                      </div> 
                    </div>
                  <br/>
                  <div class="form-group">
                    <form id="SCANNING_form" name="SCANNING_form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
                      <input type="text"  id="empid" name="empid" style="text-align:center;font-size:20px" class="form-control" onkeyup="checkNumber(this);" maxlength="11" autofocus /> <!-- <button class="btn" type="submit" name="submit" value="submit">Go!</button> -->
                      <input type="hidden"  id="btnclick" name="btnclick"   value="<?php echo $labellock;?>" />
                      
                      <input type="submit" name="submit" value="Submit" style="display: none">
                      <div class="empdescrip"> 
                        <h4><label for="Fullname" id="Fullname" >
                              <?php $result = sprintf("%s, %s", $lname, $fname); 
                              if($lname != "" && $fname != ""){
                                  echo $result;
                                } ?></label></h4>
                         <br/>
                         <h5><label for="Message" style="color:red;text-align:center;" id="Message" ><?php echo $msg;?></label></h5>
                         <h5><label for="LockMessage" style="color:red;text-align:center;" id="LockMessage"><?php echo $Lockmsg;?></label></h5>
                      </div> <br/>

                    </form>
                  </div>
                </div>

                <div class="col-md-4" style="background-color:trasparent;height:180px">
                  <div class="row">
                    <button class="button" style="vertical-align:middle" name="INAM" id="INAM" value="INAM" "><span>IN AM - PASULOD GIKAN BALAY </span></button>
                    <!-- <button class="button" style="vertical-align:middle"><span>IN AM - PASULOD GIKAN BALAY </span></button> -->
                    <button class="button" style="vertical-align:middle" name="OUTAM" id="OUTAM" value="OUTAM"><span>OUT AM - PADULONG MANI-UDTO </span></button>

                    <button class="button" style="vertical-align:middle" name="INPM" id="INPM"><span>IN PM - PASULOD GIKAN NANI-UDTO </span></button>
                    <button class="button" style="vertical-align:middle" name="BREAKOUT" id="BREAKOUT"><span>BREAKOUT  - PADULONG MERYENDA</span></button>

                    <button class="button" style="vertical-align:middle" name="BREAKIN" id="BREAKIN"><span>BREAK IN - PASULOD GIKAN MERYENDA </span></button>
                    <button class="button" style="vertical-align:middle" name="OUTPM" id="OUTPM"><span>OUT PM - PA ULI SA BALAY </span></button>

                    <button class="button" style="vertical-align:middle" name="INOT" id="INOT"><span>IN OVERTIME - PASULOD PADULONG OVERTIME </span></button>
                    <button class="button" style="vertical-align:middle" name="OUTOT" id="OUTOT"><span>OUT OVERTIME - PA GAWAS GIKAN OVERTIME </span></button>
                    <a href="./production/inq.php"><button class="button" name="INQUIRE" id="INQUIRE" style="vertical-align:middle"><span href="./inquiry.php">INQUIRY </span></button></a>
					<a href="./adjustment/inq.php"><button class="button" name="DISCREPANCY" id="DISCREPANCY" style="vertical-align:middle"><span href="./inquiry.php">DISCREPANCY </span></button></a>
                  </div>
                </div>
              </div>
            </div> <!-- end od container -->
        </div><!-- end od body_container -->
         <script src="js/Buttons.js"></script>
        <!-- <script src="js/jquery-3.1.1.slim.min.js"></script> -->
        <script src="js/jquery.loadingModal.js"></script>
    </body>
</html>
 <?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>