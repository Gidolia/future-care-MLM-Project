<?php
include "config.php";

    $temp=array();
    $dser="SELECT * FROM `distributor`";
    $edfcd=$con->query($dser);
    while($d=$edfcd->fetch_assoc()){
        $sed="SELECT * FROM `distributor` WHERE `s_id`='$d[d_id]' AND `a_status`='y'";
        $sdp=$con->query($sed);
        if($sdp->num_rows>=11){
            $temp[]=$d[d_id];
        }
    }
    
    $suc_sel="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1'";
    $suc_que=$con->query($suc_sel);
    $suc_fet=$suc_que->fetch_assoc();
    
 $tot_p=count($temp);
// echo $tot_p;
//die;
$per_amt=$suc_fet['security_bal']/$tot_p;
for($x=0; $x<=$tot_p-1; $x++){
    $dserw="SELECT * FROM `distributor` WHERE `d_id`='$temp[$x]'";
    $edfcdw=$con->query($dserw);
    $d_fetg=$edfcdw->fetch_assoc();
    $abal=$d_fetg[withdrawal_wallet]+$per_amt;
    $ins_r="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$temp[$x]', '$date', '$time', '$per_amt', '$d_fetg[withdrawal_wallet]', '$abal', '+', 'Security', '', '', '', '');";
    $upd_d="UPDATE `distributor` SET `withdrawal_wallet` = '$abal' WHERE `distributor`.`d_id` = '$temp[$x]';";
    $con->query($ins_r);
    $con->query($upd_d);
}
$upd="UPDATE `security_system_bal` SET `security_bal` = '0' WHERE `security_system_bal`.`ssb_id` = 1;";
$ins="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `total_id`) VALUES (NULL, '', '$date', '$time', '$suc_fet[security_bal]', '$suc_fet[security_bal]', '0', '-', 'Security Distributed', '$tot_p');";
$con->query($upd);
$con->query($ins);
echo "<script>alert('Success! Security Income distributed'); location.href='index.php';</script>";