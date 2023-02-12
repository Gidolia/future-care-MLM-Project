<?php 
//include "config.php";
function distribute_level_income($d_id, $amount, $pr_id)
{
    global $con, $date, $time;
    $edfgdcv="SELECT * FROM `payment_request` WHERE `pr_id`='$_GET[pr_id]'";
    $fvdcv=$con->query($edfgdcv);
    $fetdcv=$fvdcv->fetch_assoc();
    if($fetdcv[commission_distributed]!='y')
    {
    $sql="UPDATE `payment_request` SET `commission_distributed` = 'y' WHERE `payment_request`.`pr_id` = '$pr_id';";
    
    $d_dd="SELECT * FROM `distributor` WHERE `d_id`='$d_id'";
    $scf=$con->query($d_dd);
    $dd_fet=$scf->fetch_assoc();
    if($dd_fet[a_status]=='y')
    {
        $first="N";
    }
    else{
        $first="Y";
        $sql .="UPDATE `distributor` SET `a_status` = 'y' WHERE `distributor`.`d_id` = '$d_id';";
        $sql .="UPDATE `distributor` SET `a_date` = '$date' WHERE `distributor`.`d_id` = '$d_id';";
        $sql .="UPDATE `distributor` SET `a_time` = '$time' WHERE `distributor`.`d_id` = '$d_id';";
    }
    ////////////////////level one
    $d_dd1="SELECT * FROM `distributor` WHERE `d_id`='$dd_fet[s_id]'";
    $scf1=$con->query($d_dd1);
    $dd_fet1=$scf1->fetch_assoc();
    $lv1_com=$amount*10/100;
    $admin1=$lv1_com*5/100;
    $tds1=$lv1_com*5/100;
    $pro_sav1=$lv1_com*10/100;
    
    $tot_com=$lv1_com-$admin1-$tds1-$pro_sav1;
    $w_bal=$dd_fet1[withdrawal_wallet]+$tot_com;
    $admin1_bal=$dd_fet1[admin]+$admin1;
    $tds1_bal=$dd_fet1[tds]+$tds1;
    $pro_save1=$dd_fet1[property_saving]+$pro_sav1;
    
    
    $sql .="INSERT INTO `level_income` (`li_id`, `d_id`, `date`, `time`, `amount`, `level`, `of_d_id`, `pr_id`, `new_id`, `admin_charge`, `tds_charge`, `final_amount`) VALUES (NULL, '$dd_fet1[d_id]', '$date', '$time', '$lv1_com', '1', '$d_id', '$pr_id', '$first', '$admin1', '$tds1', '$tot_com');";
    $sql .="UPDATE `distributor` SET `admin` = '$admin1' WHERE `distributor`.`d_id` = '$dd_fet1[d_id]';";
    $sql .="INSERT INTO `admin_charge` (`ac_id`, `d_id`, `date`, `time`, `admin`, `b_admin`, `a_admin`, `of_amount`, `type`) VALUES (NULL, '$dd_fet1[d_id]', '$date', '$time', '$admin1', '$dd_fet1[admin]', '$admin1_bal', '$lv1_com', '+');";
    
    $sql .="UPDATE `distributor` SET `tds` = '$tds1' WHERE `distributor`.`d_id` = '$dd_fet1[d_id]';";
    $sql .="INSERT INTO `tds_collected_history` (`tch_id`, `d_id`, `date`, `time`, `tds`, `b_tds`, `a_tds`, `of_amount`, `type`) VALUES (NULL, '$dd_fet1[d_id]', '$date', '$time', '$tds1', '$dd_fet1[tds]', '$tds1_bal', '$lv1_com', '+');";
    
    $sql .="UPDATE `distributor` SET `property_saving` = '$pro_save1' WHERE `distributor`.`d_id` = '$dd_fet1[d_id]';";
    
    $sql .="INSERT INTO `property_saving_history` (`psh_id`, `d_id`, `date`, `time`, `pro_saving`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$dd_fet1[d_id]', '$date', '$time', '$pro_sav1', '$dd_fet1[property_saving]', '$pro_save1', '+', '');";
    
    
    $sql .="UPDATE `distributor` SET `withdrawal_wallet` = '$w_bal' WHERE `distributor`.`d_id` = '$dd_fet1[d_id]';";
    $sql .="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `note`, `type`) VALUES (NULL, '$dd_fet1[d_id]', '$date', '$time', '$tot_com', '$dd_fet1[withdrawal_wallet]', '$w_bal', 'Level Income', '+');";
    
    ////////////////////level two
    $d_dd2="SELECT * FROM `distributor` WHERE `d_id`='$dd_fet1[s_id]'";
    $scf2=$con->query($d_dd2);
    $dd_fet2=$scf2->fetch_assoc();
    $lv2_com=$amount*5/100;
    $admin2=$lv2_com*5/100;
    $tds2=$lv2_com*5/100;
    $pro_sav2=$lv2_com*10/100;
    $tot_com2=$lv2_com-$admin2-$tds2-$pro_sav2;
    $w_bal2=$dd_fet2[withdrawal_wallet]+$tot_com2;
    $admin2_bal=$dd_fet2[admin]+$admin2;
    $tds2_bal=$dd_fet2[tds]+$tds2;
    $pro_save2=$dd_fet2[property_saving]+$pro_sav2;
    $sql .="INSERT INTO `level_income` (`li_id`, `d_id`, `date`, `time`, `amount`, `level`, `of_d_id`, `pr_id`, `new_id`, `admin_charge`, `tds_charge`, `final_amount`) VALUES (NULL, '$dd_fet2[d_id]', '$date', '$time', '$lv2_com', '2', '$d_id', '$pr_id', '$first', '$admin2', '$tds2', '$tot_com2');";
    $sql .="UPDATE `distributor` SET `admin` = '$admin2' WHERE `distributor`.`d_id` = '$dd_fet2[d_id]';";
    $sql .="INSERT INTO `admin_charge` (`ac_id`, `d_id`, `date`, `time`, `admin`, `b_admin`, `a_admin`, `of_amount`, `type`) VALUES (NULL, '$dd_fet2[d_id]', '$date', '$time', '$admin2', '$dd_fet2[admin]', '$admin2_bal', '$lv2_com', '+');";
    
    $sql .="UPDATE `distributor` SET `tds` = '$tds2' WHERE `distributor`.`d_id` = '$dd_fet2[d_id]';";
    $sql .="INSERT INTO `tds_collected_history` (`tch_id`, `d_id`, `date`, `time`, `tds`, `b_tds`, `a_tds`, `of_amount`, `type`) VALUES (NULL, '$dd_fet2[d_id]', '$date', '$time', '$tds2', '$dd_fet2[tds]', '$tds2_bal', '$lv2_com', '+');";
    
    $sql .="UPDATE `distributor` SET `property_saving` = '$pro_save2' WHERE `distributor`.`d_id` = '$dd_fet2[d_id]';";
    
    $sql .="INSERT INTO `property_saving_history` (`psh_id`, `d_id`, `date`, `time`, `pro_saving`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$dd_fet2[d_id]', '$date', '$time', '$pro_sav2', '$dd_fet2[property_saving]', '$pro_save2', '+', '');";
    
    $sql .="UPDATE `distributor` SET `withdrawal_wallet` = '$w_bal2' WHERE `distributor`.`d_id` = '$dd_fet2[d_id]';";
    $sql .="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `note`, `type`) VALUES (NULL, '$dd_fet2[d_id]', '$date', '$time', '$tot_com2', '$dd_fet2[withdrawal_wallet]', '$w_bal2', 'Level Income', '+');";
    
    ////////////////////level three
    $d_dd3="SELECT * FROM `distributor` WHERE `d_id`='$dd_fet2[s_id]'";
    $scf3=$con->query($d_dd3);
    $dd_fet3=$scf3->fetch_assoc();
    $lv3_com=$amount*4/100;
    $admin3=$lv3_com*5/100;
    $tds3=$lv3_com*5/100;
    $pro_sav3=$lv3_com*10/100;
    $tot_com3=$lv3_com-$admin3-$tds3-$pro_sav3;
    $w_bal3=$dd_fet3[withdrawal_wallet]+$tot_com3;
    $admin3_bal=$dd_fet3[admin]+$admin3;
    $tds3_bal=$dd_fet3[tds]+$tds3;
    $pro_save3=$dd_fet3[property_saving]+$pro_sav3;
    $sql .="INSERT INTO `level_income` (`li_id`, `d_id`, `date`, `time`, `amount`, `level`, `of_d_id`, `pr_id`, `new_id`, `admin_charge`, `tds_charge`, `final_amount`) VALUES (NULL, '$dd_fet3[d_id]', '$date', '$time', '$lv3_com', '3', '$d_id', '$pr_id', '$first', '$admin3', '$tds3', '$tot_com3');";
    $sql .="UPDATE `distributor` SET `admin` = '$admin3' WHERE `distributor`.`d_id` = '$dd_fet3[d_id]';";
    $sql .="INSERT INTO `admin_charge` (`ac_id`, `d_id`, `date`, `time`, `admin`, `b_admin`, `a_admin`, `of_amount`, `type`) VALUES (NULL, '$dd_fet3[d_id]', '$date', '$time', '$admin3', '$dd_fet3[admin]', '$admin3_bal', '$lv3_com', '+');";
    
    $sql .="UPDATE `distributor` SET `tds` = '$tds3' WHERE `distributor`.`d_id` = '$dd_fet3[d_id]';";
    $sql .="INSERT INTO `tds_collected_history` (`tch_id`, `d_id`, `date`, `time`, `tds`, `b_tds`, `a_tds`, `of_amount`, `type`) VALUES (NULL, '$dd_fet3[d_id]', '$date', '$time', '$tds3', '$dd_fet3[tds]', '$tds3_bal', '$lv3_com', '+');";
    
    $sql .="UPDATE `distributor` SET `property_saving` = '$pro_save3' WHERE `distributor`.`d_id` = '$dd_fet3[d_id]';";
    
    $sql .="INSERT INTO `property_saving_history` (`psh_id`, `d_id`, `date`, `time`, `pro_saving`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$dd_fet3[d_id]', '$date', '$time', '$pro_sav3', '$dd_fet3[property_saving]', '$pro_save3', '+', '');";
    
    $sql .="UPDATE `distributor` SET `withdrawal_wallet` = '$w_bal3' WHERE `distributor`.`d_id` = '$dd_fet3[d_id]';";
    $sql .="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `note`, `type`) VALUES (NULL, '$dd_fet3[d_id]', '$date', '$time', '$tot_com3', '$dd_fet3[withdrawal_wallet]', '$w_bal3', 'Level Income', '+');";
    
    if($con->multi_query($sql) === TRUE){
        while ($con->next_result()) {;}
        return "Success";
    }
    else{
        return "fail";
    }
    }else{return "Success";}
}
//echo distribute_level_income(4, 50000, 3);


//////////////////////////start total new messages/////////////////////
function new_messages()
{
    global $con, $date;
    $r=0;
    $s="SELECT * FROM `web_contacts` WHERE `date`='$date'";
    $rs=$con->query($s);
    while($ss=$rs->fetch_assoc())
    {
        $r++;
    }
    return $r;
///////////////////////////////end total new message///////////////////////
} 

//////////////////////////start total new messages/////////////////////
function new_booking()
{
    global $con, $date;
    $r=0;
    $s="SELECT * FROM `web_booking` WHERE `date`='$date'";
    $rs=$con->query($s);
    while($ss=$rs->fetch_assoc())
    {
        $r++;
    }
    return $r;
///////////////////////////////end total new message///////////////////////
} 

