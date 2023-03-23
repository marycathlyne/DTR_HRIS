<?php 

   
        $ipcount = 0;
        $ipaddress ="";
        
        include('pages/get_client_info.php');
        include('pages/connection.php');
        include('pages/hrisconnection.php');

        $mac = $ipaddress = "";
        $ipaddress = get_ip_address();
        if($ipaddress=='::1')
        {
            $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $REMOTE_ADDR=$hostname;
            $ip= $REMOTE_ADDR;
            $ipaddress = GetHostByName($ip);
            
        }
        $mac = GetMAC();

        $sqlDTR = "SELECT * FROM IPADDRESS WHERE IPADD='".$ipaddress."'";
        $DTRresult = $DTRdatabaseConnection->query($sqlDTR);
        $iprow = $DTRresult->fetchAll();
        $ipcount = count($iprow);
        if($ipcount<1)
        {
          header('Location: pages/IPRedirect.php');    
          //$_SESSION['sessionvalue']--;
          exit();   
        }
        else
        {
            //$_SESSION['sessionvalue']++;
            header('Location: Scan.php');    
            exit();   
        }
        $DTRdatabaseConnection = null;

  ?>
 <?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>