<?php
include "config.php";
include "functions.php";

if(isset($_GET[clear_payment]))
{
    while ($con->next_result()) {;}
    $edfg="SELECT * FROM `payment_request` WHERE `pr_id`='$_GET[pr_id]'";
    $fv=$con->query($edfg);
    $fet=$fv->fetch_assoc();
    
    $d_query="SELECT * FROM `distributor` WHERE `d_id`='$fet[d_id]'";
    $d_run=$con->query($d_query);
    $d_fet=$d_run->fetch_assoc();
    
    if(distribute_level_income($fet[d_id], $fet[amount], $_GET[pr_id])=="Success")
    {
        $up_pro_name="UPDATE `distributor` SET `project_name` = '$fet[project_name]' WHERE `distributor`.`d_id` = '$fet[d_id]';";
        
        $up_plot_no="UPDATE `distributor` SET `plot_no` = '$fet[project_name]' WHERE `distributor`.`d_id` = '$fet[d_id]';";
        $up_plot_total_am="UPDATE `distributor` SET `plot_total_amount` = '$fet[total_amount]' WHERE `distributor`.`d_id` = '$fet[d_id]';";
        
        $edfc="UPDATE `payment_request` SET `status` = 'S' WHERE `payment_request`.`pr_id` = '$_GET[pr_id]';";
        $vbj="UPDATE `payment_request` SET `c_time` = '$time' WHERE `payment_request`.`pr_id` = '$_GET[pr_id]';";
        
        $fpor="UPDATE `payment_request` SET `c_date` = '$date' WHERE `payment_request`.`pr_id` = '$_GET[pr_id]';";
        while ($con->next_result()) {;}
        if($con->query($edfc)===TRUE && $con->query($vbj)===TRUE && $con->query($fpor)===TRUE && $con->query($up_pro_name)===TRUE && $con->query($up_plot_no)===TRUE && $con->query($up_plot_total_am)===TRUE)
        {
            echo "<script>alert('Success! Cleared and Income Distributed'); location.href='payment_request_history.php';</script>";
        }else{
            echo "<script>alert('Failed! Plz try again1'); location.href='payment_request_history.php';</script>";
        }
    }else{
            echo "<script>alert('Failed! Plz try again function Failed'); location.href='payment_request_history.php';</script>";
        }
    /*
    $edfg="SELECT * FROM `pin_request` WHERE `pr_id`='$_GET[pr_id]'";
    $fv=$con->query($edfg);
    $fet=$fv->fetch_assoc();
    
    $d_query="SELECT * FROM `distributor` WHERE `d_id`='$fet[d_id]'";
    $d_run=$con->query($d_query);
    $d_fet=$d_run->fetch_assoc();
    if($fet[pin_wallet]=='50000')
    {
        $a_pin=$d_fet[pin_wallet_50000]+$fet[pin_qty];
        $sdsd="UPDATE `distributor` SET `pin_wallet_50000` = '$a_pin' WHERE `distributor`.`d_id` = '$fet[d_id]';";
        $pin_h_ins="INSERT INTO `pin_wallet_50000` (`pw_id`, `d_id`, `date`, `time`, `type`, `pin_qty`, `b_pin`, `a_pin`, `note`, `pr_id`, `txn_id`) VALUES (NULL, '$fet[d_id]', '$date', '$time', '+', '$fet[pin_qty]', '$d_fet[pin_wallet_50000]', '$a_pin', 'Purchased', '$_GET[pr_id]', '$fet[txn_id]');";
        
    }
    elseif($fet[pin_wallet]=='100000')
    {
        $a_pin=$d_fet[pin_wallet_100000]+$fet[pin_qty];
        $sdsd="UPDATE `distributor` SET `pin_wallet_100000` = '$a_pin' WHERE `distributor`.`d_id` = '$fet[d_id]';";
        $pin_h_ins="INSERT INTO `pin_wallet_100000` (`pw_id`, `d_id`, `date`, `time`, `type`, `pin_qty`, `b_pin`, `a_pin`, `note`, `pr_id`, `txn_id`) VALUES (NULL, '$fet[d_id]', '$date', '$time', '+', '$fet[pin_qty]', '$d_fet[pin_wallet_100000]', '$a_pin', 'Purchased', '$_GET[pr_id]', '$fet[txn_id]');";
    }
    elseif($fet[pin_wallet]=='250000')
    {
        $a_pin=$d_fet[pin_wallet_250000]+$fet[pin_qty];
        $sdsd="UPDATE `distributor` SET `pin_wallet_250000` = '$a_pin' WHERE `distributor`.`d_id` = '$fet[d_id]';";
        $pin_h_ins="INSERT INTO `pin_wallet_250000` (`pw_id`, `d_id`, `date`, `time`, `type`, `pin_qty`, `b_pin`, `a_pin`, `note`, `pr_id`, `txn_id`) VALUES (NULL, '$fet[d_id]', '$date', '$time', '+', '$fet[pin_qty]', '$d_fet[pin_wallet_250000]', '$a_pin', 'Purchased', '$_GET[pr_id]', '$fet[txn_id]');";
    }
    
        $dccv="UPDATE `pin_request` SET `status` = 'S' WHERE `pin_request`.`pr_id` = '$_GET[pr_id]';";
        
        $dar="UPDATE `pin_request` SET `c_date` = '$date' WHERE `pin_request`.`pr_id` = '$_GET[pr_id]';";
      
        $dart="UPDATE `pin_request` SET `c_time` = '$time' WHERE `pin_request`.`pr_id` = '$_GET[pr_id]';";
        
        if($con->query($dccv)===TRUE && $con->query($dar)===TRUE && $con->query($dart)===TRUE && $con->query($sdsd)===TRUE && $con->query($pin_h_ins)===TRUE)
        {
            echo "<script>alert('Success! Cleared and Income Distributed'); location.href='payment_request_history.php';</script>";
        }else{
            echo "<script>alert('Failed! Plz try again'); location.href='payment_request_history.php';</script>";
        }*/
}
?>