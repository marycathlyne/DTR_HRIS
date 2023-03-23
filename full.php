<!DOCTYPE html>
<html lang="en">
<head>
  	<title>DTR SCANNING</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="css/style.css">
  	<link rel="stylesheet" href="css/bootstrap.css">
  	<script src="js/jquery-buttons.js"></script>
  	<link href="css-template/bootstrap-responsive.min.css" rel="stylesheet">
  	<link id="base-style" href="css-template/style.css" rel="stylesheet">
  	<link id="base-style-responsive" href="css-template/style-responsive.css" rel="stylesheet">
  	<script src="js/dtrjquery.js"></script>
  	<script src="js/jquery-buttons.js"></script>
	<script>
		function open_frameless(handle,url,title,width,height,xpos,ypos,centered,ontop){ 

		   xpos = (centered)?(screen.width/2)-(width/2):xpos; 
		   ypos = (centered)?(screen.height/2)-(height/2):ypos; 

		   handle=window.open("","window","fullscreen=1"); 
		   handle.blur(); 
		   window.reload();
		   window.focus(); 
		   handle.resizeTo(width,height); 
		   handle.moveTo(xpos,ypos); 

		   handle.document.open(); 
		   handle.document.write("<html><title>" +title+ "</title><frameset rows='*,0' framespacing=0 frameborder=0 border=0 ><frame name='top' src='" +url+ "' scrolling=auto><frame name='bottom' src='about:black' scrolling='no' noresize='noresize'></frameset></html>"); 
		   handle.document.close(); 

		   ontop?handle.focus():false; 
		}
	</script>
  	<style type="text/css">
    	body { background: url(img/bg-login.jpg) !important; }
  	</style>
</head>
<body>
	<div class="body_container" style="padding-top:20px;">
		<div class="container" >
			<?php
  				include('pages/get_client_info.php');

				$mac = $ipaddress = $hostname = "";
				$ipaddress = get_ip_address();
				$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
				if($ipaddress=='::1')
				{
				    $REMOTE_ADDR=$hostname;
				    $ip= $REMOTE_ADDR;
				    $ipaddress = GetHostByName($ip);
				    
				}
				$mac = GetMAC();
				
			?>
			

			<div class="box span12">
				<div class="box-content" >
		            <table class="table table-bordered table-striped table-condensed" style="background-color:#CD2539;color:#fff">
		                <thead >
		                  <tr>
		                  	<p id="demo"></p>
		                    <th style="text-align:right;"><h4 style="font-weight:bold;">Your IP Address:</h4></th>
		                    <th><h4 style="font-weight:bold;color:yellow"><?php echo $ipaddress?></h4></th>                                
		                  </tr>
		                   <tr>
		                    <th style="text-align:right;"><h4 style="font-weight:bold;">COMPUTER NAME:</h4></th>
		                    <th><h4 style="font-weight:bold;color:yellow"><?php echo $hostname?></h4></th>                                
		                  </tr>
		                </thead>   
		                <tbody>
		                </tbody>
		            </table>
	           	</div>
	        </div>
			<a href="javascript:var popup; open_frameless(popup,'http://10.10.0.89/dtr_hris/index.php','Title',10000,10000,0,0,true,true)">
				<button class="button" name="INQUIRE" id="INQUIRE" style="padding:10px;vertical-align:middle;font-size:20px">DTR SCANNING 
					<p style="font-size:14px;font-style:italic;color:yellow">[Only authorize IP Addresses can access]</p>
				</button>
			</a><br/>
			<a href="javascript:var popup; open_frameless(popup,'http://10.10.0.89/dtr_hris/inquiry.php','Title',10000,10000,0,0,true,true)">
				<button class="button" name="INQUIRE" id="INQUIRE" style="vertical-align:middle;font-size:20px;margin-top:10px">DTR INQUIRY
					<p style="font-size:14px;font-style:italic;color:yellow">[Accesible to anyone]</p>
				</button>
			</a>
		</div>
	</div>

</body>
</head>
</html>

 <?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>