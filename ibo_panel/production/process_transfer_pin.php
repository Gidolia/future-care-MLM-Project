<?php
include "config.php";
if(isset($_POST[transfer_pin]))
{
    function isNumber($c) {
        return preg_match('/[0-9]/', $c);
    }
    
    $string=$_POST[to_d_id];
       
    $chars = '';
    $to_d_id = '';
    for ($index=0;$index<strlen($string);$index++) {
        if(isNumber($string[$index]))
        {
            $to_d_id .= $string[$index];
        }
        else {
            $chars .= $string[$index];}
    }
if($to_d_id!=$_SESSION[d_id])
{
    ////////////////////////from d_id
    
   
    
    switch ($_POST[pin_type]) {
  case "1":
     $a_pin=$d_detail[pw_1]-$_POST[pins];
     $b_pin=$d_detail[pw_1];
    break;
  case "2":
     $a_pin=$d_detail[pw_2]-$_POST[pins];
     $b_pin=$d_detail[pw_2];
    break;
  case "3":
     $a_pin=$d_detail[pw_3]-$_POST[pins];
     $b_pin=$d_detail[pw_3];
    break;
  
    }
    if($a_pin>=0)
    {
        switch ($_POST[pin_type]) {
          case "1":
             $up_que="UPDATE `distributor` SET `pw_1` = '$a_pin' WHERE `distributor`.`d_id` = $_SESSION[d_id];";
            break;
          case "2":
             $up_que="UPDATE `distributor` SET `pw_2` = '$a_pin' WHERE `distributor`.`d_id` = $_SESSION[d_id];";
            break;
          case "3":
             $up_que="UPDATE `distributor` SET `pw_3` = '$a_pin' WHERE `distributor`.`d_id` = $_SESSION[d_id];";
            break;
        }
      
        $his_que="INSERT INTO `pw_history` (`pwh_id`, `d_id`, `pw_type`, `date`, `time`, `pin`, `b_pin`, `a_pin`, `type`, `note`, `from_d_id`, `to_d_id`) VALUES (NULL, '$_SESSION[d_id]', '$_POST[pin_type]', '$date', '$time', '$_POST[pins]', '$b_pin', '$a_pin', '-', 'Transfered', '', '$to_d_id');";
        
        
        //////////////to d id
        $cd="SELECT * FROM `distributor` WHERE `d_id`='$to_d_id'";
        $sc=$con->query($cd);
        $fet=mysqli_fetch_assoc($sc);
        
        
        switch ($_POST[pin_type]) {
          case "1":
              $a_pind=$fet[pw_1]+$_POST[pins];
              $b_pind=$fet[pw_1];
             $up_quew="UPDATE `distributor` SET `pw_1` = '$a_pind' WHERE `distributor`.`d_id` = $to_d_id;";
            break;
          case "2":
              $a_pind=$fet[pw_2]+$_POST[pins];
              $b_pind=$fet[pw_2];
             $up_quew="UPDATE `distributor` SET `pw_2` = '$a_pind' WHERE `distributor`.`d_id` = $to_d_id;";
            break;
          case "3":
              $a_pind=$fet[pw_3]+$_POST[pins];
              $b_pind=$fet[pw_3];
             $up_quew="UPDATE `distributor` SET `pw_3` = '$a_pind' WHERE `distributor`.`d_id` = $to_d_id;";
            break;
        }
        $his_quew="INSERT INTO `pw_history` (`pwh_id`, `d_id`, `pw_type`, `date`, `time`, `pin`, `b_pin`, `a_pin`, `type`, `note`, `from_d_id`, `to_d_id`) VALUES (NULL, '$to_d_id', '$_POST[pin_type]', '$date', '$time', '$_POST[pins]', '$b_pind', '$a_pind', '+', 'Received', '$_SESSION[d_id]', '');";
        
        
        if($con->query($up_que)===TRUE && $con->query($his_que)===TRUE && $con->query($up_quew)===TRUE && $con->query($his_quew)===TRUE)
        {
          /*  ////////////////////for sending sms
            $message='DS'.$_SESSION[d_id].' You Have Transfer '.$_POST[pins].' Pin to DS'.$to_d_id.' Dreamsway Sure';
            send_sms($d_detail[mobile], $message, 'Pin Transfered', $_SESSION[d_id]);
    		///////////
    		////////////////////for sending sms
            $message='DS'.$_SESSION[d_id].' Your Pin wallet Debited with '.$_POST[pins].' Now Your Pin Wallet is '.$a_pin.', Dreamsway Sure';
            send_sms($d_detail[mobile], $message, 'Pin Wallet', $_SESSION[d_id]);
    		///////////
    		////////////////////for sending sms
            $message='DS'.$to_d_id.' Your Pin Credited with '.$_POST[pins].' Now Your Pin Wallet is '.$a_pind.', Dreamsway Sure';
            send_sms($fet[mobile], $message, 'Pin Transfered', $to_d_id);
    		///////////*/
            
            echo "<script>alert('Pin Transfered sucessfully'); location.href='transfer_pin.php';</script>";
        }
        else{
            $fail="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'transfering pi query');";
    	        $con->query($fail);
            echo "<script>alert('Failed ! to transfer pin plz try again'); location.href='transfer_pin.php';</script>";
        }
    }else{ echo "<script>alert('Failed ! You Dont Pins to transfer'); location.href='transfer_pin.php';</script>";
        }
}else{ echo "<script>alert('Failed ! to transfer pin plz try again'); location.href='transfer_pin.php';</script>";
        }
}