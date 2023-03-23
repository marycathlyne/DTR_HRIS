<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gaisano Mall of Davao</title>
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
    
    <!-- <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> -->
    <link href="dist/css/style.css" rel="stylesheet">
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
      <style type="text/css">
        body { background: url(../img/bg-login.jpg) !important; }
      </style>
     
  </head>
  <body class="nav-md">
    <div class="container-fluid">
      <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3 style="color: white">Daily Time Record Inquiry  <!--  <small>current/previous</small> --></h3>
              </div>

              <div class="title_right">
                <form class="form-horizontal" method="POST" action="" autocomplete="off">
                  <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Click Here.." id="empid" name="empid" size="16" type="text" onkeyup="checkNumber(this);" maxlength="11" autofocus ><!-- <button class="btn" type="submit" name="submit" value="OK" >Go!</button> -->
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" name="submit" value="OK" >Go!</button>
                      </span>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row"> 
              <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel" >
                  <div class="x_title">
                    <?php
                      include('../pages/query_info.php');
                    ?>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <?php
                  if (isset ($_POST['submit'])){
                    if (!empty($_POST['empid'])) {
                      echo '<table width="100%" class="table  table-bordered" id="previous_table" style="color: white;background-color: #757575;align: center;">
                      <thead >
                          <tr>
                              <th style="text-align: center;"></th>
                              <th style="text-align: center;">SUNDAY</th>
                              <th style="text-align: center;">MONDAY</th>
                              <th style="text-align: center;">TUESDAY</th>
                              <th style="text-align: center;">WEDNESDAY</th>
                              <th style="text-align: center;">THURSDAY</th>
                              <th style="text-align: center;">FRIDAY</th>
                              <th style="text-align: center;">SATURDAY</th>
                          </tr>
                      </thead>
                      <tbody style="text-align: center;">';
                  echo    "<tr>".
                              "<td> INAM </td>".
                              "<td>". date ('h:i A',strtotime($data['SUNDAYIN']))  ."</td>".
                              "<td>". date ('h:i A',strtotime($data['MONDAYIN'])) ."</td>".
                              "<td>". date ('h:i A',strtotime($data['TUESDAYIN'])) ."</td>".
                              "<td>". date ('h:i A',strtotime($data['WEDNESDAYIN'])) ."</td>".
                              "<td>". date ('h:i A',strtotime($data['THURSDAYIN'])) ."</td>".
                              "<td>". date ('h:i A',strtotime($data['FRIDAYIN'])) ."</td>".
                              "<td>". date ('h:i A',strtotime($data['SATURDAYIN'])) ."</td>".
                          "</tr>
                          <tr>".
                              "<td> OUTPM </td>".
                              "<td>". date ('h:i A',strtotime($data['SUNDAYOUT'])) ."</td>".
                              "<td>". date ('h:i A',strtotime($data['MONDAYOUT'])) ."</td>".
                              "<td>". date ('h:i A',strtotime($data['TUESDAYOUT'])) ."</td>".
                              "<td>". date ('h:i A',strtotime($data['WEDNESDAYOUT'])) ."</td>".
                              "<td>". date ('h:i A',strtotime($data['THURSDAYOUT'])) ."</td>".
                              "<td>". date ('h:i A',strtotime($data['FRIDAYOUT'])) ."</td>".
                              "<td>". date ('h:i A',strtotime($data['SATURDAYOUT'])) ."</td>".
                          "</tr>
                      </tbody>
                  </table>";
                    }}
                  ?>
                  </div>
                  <form>
                        <ul class="nav nav-tabs" id="myTab" style="font-weight: bold; font-size: 13px;color: black;">
                            <li class="active">
                                <a href="#home" role="tab" data-toggle="tab">
                                  <icon class="fa fa-arrow-left"></icon>  CURRENT CUT-OFF
                                </a>
                            </li>
                            <li>
                                <a href="#assigned" role="tab" data-toggle="tab">
                                   PREVIOUS CUT-OFF  <i class="fa fa-arrow-right"></i>
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
                    </form>
                </div>
                <a href="../index.php" class="btn btn-block btn-lg" style="background-color: #0275d8; color: white;">BACK</a>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
    </div>
    <script src="dist/js/jquery-1.11.1.min.js"></script>
    <script src="dist/js/jquery-loader.js" type="text/javascript"></script>
    <script type="text/javascript">
     $(document).on("keypress", "input", function(e){
            if(e.which == 13){
                $data = {
                  autoCheck: $('#autoCheck').is(':checked') ? 32 : false,
                  size: 32,  
                  bgColor: $('#bgColor').val(),   
                  bgOpacity: 0.5,    
                  fontColor: $('#fontColor').val(),  
                  title: 'Data Processing', 
                  isOnly: !$('#isOnly').is(':checked')
              };
              $.loader.open($data);
              //$('x_content').loader($data);
            }
        });
</script><script type="text/javascript">

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>
