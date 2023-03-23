<?php
session_set_cookie_params(0);
SESSION_START();

if(isset($_SESSION['current_user'])){
		//if(empty($_SESSION['current_user'])){
			//echo 'Please Login, use the first page! copy this to your browser: 10.10.99.17:3360/gaisanoIP/PHP/';
			//exit();
			//echo '<script>alert("You are login.")</script>';
			if(time() - $_SESSION['timeout'] > 500){		
				header("location: expires.php");
				//echo ("<p>Please open page: <a href='index.php'>10.10.99.16</a></p>");
				//header("location: index.php");
				exit();
			}
		}else{
			echo '<script>alert("Please Login.")</script>';
			echo ("<p>Please open page: <a href='index.php'>10.10.99.16</a></p>");
			exit();
	}
?>

 <?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>