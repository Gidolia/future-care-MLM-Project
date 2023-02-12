<?php
include "config.php";

if(isset($_POST[submit]))
{
    switch ($_POST[pw]) {
      case "1":
        $d="pw_1";
        $amount="1000";
        break;
      case "2":
        $d="pw_2";
        $amount="2000";
        break;
      case "3":
        $d="pw_3";
        $amount="4000";
        break;
      case "4":
        $d="pw_4";
        $amount="8000";
        break;
      case "5":
        $d="pw_5";
        $amount="16000";
        break;
      case "6":
        $d="pw_6";
        $amount="32000";
        break;
      case "7":
        $d="pw_7";
        $amount="64000";
        break;
      case "8":
        $d="pw_8";
        $amount="128000";
        break;
      case "9":
        $d="pw_9";
        $amount="256000";
        break;
      case "10":
        $d="pw_10";
        $amount="512000";
        break;
      case "11":
        $d="pw_11";
        $amount="1024000";
        break;
      
    }
    $wwl_bal=$d_detail[withdrawal_wallet]-$amount;
    if($wwl_bal>=0)
    {
    
        
        $ins_bal="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$_SESSION[d_id]', '$date', '$time', '$amount', '$d_detail[withdrawal_wallet]', '$wwl_bal', '-', 'Buy Pin', '', '', '', '');";
        $rg="UPDATE `distributor` SET `withdrawal_wallet` = '$wwl_bal' WHERE `distributor`.`d_id` = '$_SESSION[d_id]';";
        $a_pin=$d_detail[$d]+$_POST[qty];
        
        $sel="INSERT INTO `pw_history` (`pwh_id`, `d_id`, `pw_type`, `date`, `time`, `pin`, `b_pin`, `a_pin`, `type`, `note`) VALUES (NULL, '$_SESSION[d_id]', '$_POST[pw]', '$date', '$time', '$_POST[qty]', '$d_detail[$d]', '$a_pin', '+', 'Pin Purchased');";
        $up="UPDATE `distributor` SET `$d` = '$a_pin' WHERE `distributor`.`d_id` = '$_SESSION[d_id]';";
        if($con->query($ins_bal)===TRUE && $con->query($rg)===TRUE &&$con->query($sel)===TRUE && $con->query($up)===TRUE)
        {
            	echo "<script>alert('Success! Pin Purchased Successfully');
        		location.href='pin_wallet.php';</script>";
        }
        else{
            echo "<script>alert('Failed! Plz Try Again');
        		location.href='pin_wallet.php';</script>";
        }
    }else{
        echo "<script>alert('Failed! You Dont Have a Balance To Buy Pin');
        		location.href='pin_wallet.php';</script>";
    }


}


?>