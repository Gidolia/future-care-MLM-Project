<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include "../../../database_connect.php";
session_start();
                //echo $_SESSION[d_id];
		     // echo $_SESSION[d_password];
    $que="SELECT * FROM `admin_password` WHERE `password`='$_SESSION[a_password]'";
    $res=$con->query($que);
		  if ($res->num_rows != 1)
		  {
		     
			   echo "<script>location.href='login.php';</script>";
		  }
		  else
		  
		  
		 
?>