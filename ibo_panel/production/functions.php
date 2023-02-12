<?php
//include "config.php";
//////////////////////////////////
////////////////////////////////////////
/////////////////////////////////////////// plan 1000/-
function for_finding_direct_id_plan1($d_id)
{
    global $con;
    $d_id_sel="SELECT * FROM `distributor` WHERE `s_id`='$d_id' AND `a_status`='y';";
    $d_id_que=$con->query($d_id_sel);
    $count=$d_id_que->num_rows;
    return($count);
    
}
function for_amount_insert_by_orbit_plan1($d_id,$amount,$level)
{
    global $con, $date, $time;
    $dis_sel="SELECT * FROM `distributor` WHERE `d_id`='$d_id'";
    $dis_que=$con->query($dis_sel);
    $dis_fet=$dis_que->fetch_assoc();
    $plan_in="SELECT d_id,plan1,o1 FROM `plan_income_manage` WHERE `d_id`='$d_id'";
    $plan_in_que=$con->query($plan_in);
    $plan_in_fet=$plan_in_que->fetch_assoc();
    $planspp=$plan_in_fet[plan1]+$amount;
    
    if($dis_fet[a_plan]=='1')
    {
        if($plan_in_fet[plan1]<=6000)
        {
            $planspp=$plan_in_fet[plan1]+$amount;
            if($planspp<=6000)
            {
                $ww_bal=$dis_fet[withdrawal_wallet]+$amount;
                $plan_in_t="UPDATE `plan_income_manage` SET `plan1` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$amount', '$plan_in_fet[plan1]', '$planspp', '+', 'plan 1000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o1]');";
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$amount', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Plan 1 Income', '1');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($ww_ins)===TRUE && $con->query($ww_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '1');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>6000)
            {
                $extra_bal=$planspp-6000;
                $ww_com=$amount-$extra_bal;
                $upg_bal=$dis_fet[upgrade_wallet]+$extra_bal;
                /////////////////
                $upg_ins="INSERT INTO `upgrade_wallet_history` (`uwh_id`, `d_id`, `date`, `time`, `plan_type`, `level`, `amount`, `b_bal`, `a_bal`, `note`, `type`, `orbit`) VALUES (NULL, '$d_id', '$date', '$time', 'Plan 1000rs', '$level', '$extra_bal', '$dis_fet[upgrade_wallet]', '$upg_bal', 'For Upgrading', '+', '$plan_in_fet[o1]');";
                $upg_up="UPDATE `distributor` SET `upgrade_wallet` = '$upg_bal' WHERE `distributor`.`d_id` = '$d_id';";
                ////////////////////
                $ww_bal=$dis_fet[withdrawal_wallet]+$ww_com;
                
                $plan_in_t="UPDATE `plan_income_manage` SET `plan1` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$amount', '$plan_in_fet[plan1]', '$planspp', '+', 'plan 1000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[orbit]');";
                /////////////////////////////////////
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$ww_com', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Plan 1 Income', '1');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                if($con->query($upg_ins)===TRUE && $con->query($upg_up)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($ww_ins)===TRUE && $con->query($ww_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '2');";
                    $con->query($df);
                }
                
            }
        }
        elseif($plan_in_fet[plan1]>6000 && $plan_in_fet[plan1]<=8000)
        {
            $planspp=$plan_in_fet[plan1]+$amount;
            if($planspp<=8000)
            {
                //////////////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan1` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$amount', '$plan_in_fet[plan1]', '$planspp', '+', 'plan 1000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o1]');";
                ///////////////////////////////////////
                $upg_bal=$dis_fet[upgrade_wallet]+$amount;
                $upg_ins="INSERT INTO `upgrade_wallet_history` (`uwh_id`, `d_id`, `date`, `time`, `plan_type`, `level`, `amount`, `b_bal`, `a_bal`, `note`, `type`, `orbit`) VALUES (NULL, '$d_id', '$date', '$time', 'Plan 1000rs', '$level', '$amount', '$dis_fet[upgrade_wallet]', '$upg_bal', 'For Upgrading', '+', '$plan_in_fet[o1]');";
                $upg_up="UPDATE `distributor` SET `upgrade_wallet` = '$upg_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($upg_ins)===TRUE && $con->query($upg_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '3');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>8000)
            {
                $extra_bal=$planspp-8000;
                $upg_com=$amount-$extra_bal;
                $upg_bal=$dis_fet[upgrade_wallet]+$upg_com;
                ////////////////////////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan1` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$amount', '$plan_in_fet[plan1]', '$planspp', '+', 'plan 1000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[orbit]');";
                ///////////////////////////////////////////////////
                $upg_ins="INSERT INTO `upgrade_wallet_history` (`uwh_id`, `d_id`, `date`, `time`, `plan_type`, `level`, `amount`, `b_bal`, `a_bal`, `note`, `type`, `orbit`) VALUES (NULL, '$d_id', '$date', '$time', 'Plan 1000rs', '$level', '$upg_com', '$dis_fet[upgrade_wallet]', '$upg_bal', 'For Upgrading', '+', '$plan_in_fet[orbit]');";
                $upg_up="UPDATE `distributor` SET `upgrade_wallet` = '$upg_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                ///////////for reserve_fund
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf1]+$extra_bal;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '1', '$d_id', '$date', '$time', '$extra_bal', '$rf_fet[rf1]', '$rf_a_bal', '+', 'Commission');";
                $rf_up="UPDATE `reserve_fund` SET `rf1` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                
                
                if($con->query($upg_ins)===TRUE && $con->query($upg_up)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '4');";
                    $con->query($df);
                }
                
            }
        
        }
        elseif($plan_in_fet[plan1]>8000 && $plan_in_fet[plan1]<=9000)
        {
            $planspp=$plan_in_fet[plan1]+$amount;
            if($planspp<=9000)
            {
                //////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan1` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$amount', '$plan_in_fet[plan1]', '$planspp', '+', 'plan 1000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o1]');";
                
                ///////////for reserve_fund
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf1]+$amount;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `orbit`) VALUES (NULL, '1', '$d_id', '$date', '$time', '$amount', '$rf_fet[rf1]', '$rf_a_bal', '+', 'Commission', '$plan_in_fet[o1]');";
                $rf_up="UPDATE `reserve_fund` SET `rf1` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '5');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>9000)
            {
                $extra_bal=$planspp-9000;
                $rf_com=$amount-$extra_bal;
                
                //////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan1` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$amount', '$plan_in_fet[plan1]', '$planspp', '+', 'plan 1000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o1]');";
                
                
                ///////////for reserve_fund`    
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf1]+$rf_com;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `orbit`) VALUES (NULL, '1', '$d_id', '$date', '$time', '$rf_com', '$rf_fet[rf1]', '$rf_a_bal', '+', 'Commission', '$plan_in_fet[o1]');";
                $rf_up="UPDATE `reserve_fund` SET `rf1` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                
                ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$extra_bal;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$extra_bal', '$dis_fet[renewal_wallet]', '$renewal_bal', 'commission', '$plan_in_fet[o1]', '+');";
                $renewal_up="UPDATE `distributor` SET `renewal_wallet` = '$renewal_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                
                if($con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($renwal_ins)===TRUE && $con->query($renewal_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '6');";
                    $con->query($df);
                }
                
            }
        
        }
        elseif($plan_in_fet[plan1]>9000 && $plan_in_fet[plan1]<=10000)
        {
            $planspp=$plan_in_fet[plan1]+$amount;
            if($planspp<=10000)
            {
                //////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan1` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$amount', '$plan_in_fet[plan1]', '$planspp', '+', 'plan 1000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o1]');";
                
                 ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$amount;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$amount', '$dis_fet[renewal_wallet]', '$renewal_bal', 'commission', '$plan_in_fet[o1]', '+');";
                $renewal_up="UPDATE `distributor` SET `renewal_wallet` = '$renewal_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($renwal_ins)===TRUE && $con->query($renewal_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '7');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>10000)
            {
                $extra_bal=$planspp-10000;
                $b_amount=$amount-$extra_bal;
                ////////////////////////////////
                ///////////////////////////////////
                /////////////////////////////////////
                //////////for entering under 10000 balance
                $b_plan=$plan_in_fet[plan1]+$b_amount;
                
                //////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan1` = '$b_plan' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$b_amount', '$plan_in_fet[plan1]', '$b_plan', '+', 'plan 1000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o1]');";
                
                
                ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$b_amount;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$b_amount', '$dis_fet[renewal_wallet]', '$renewal_bal', 'commission', '$plan_in_fet[o1]', '+');";
                $renewal_up="UPDATE `distributor` SET `renewal_wallet` = '$renewal_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($renwal_ins)===TRUE && $con->query($renewal_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '8');";
                    $con->query($df);
                }
                
                ////////////////////for entering after 10000 balance
                
                ////////////orbit complete
                
                ////////for renewing ID
                for_renewal_income_distribute($d_id);
                //////////////////////////
                $orbit=$plan_in_fet[o1]+1;
                $plan_iv_e="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '10000', '10000', '0', '-', 'New Orbit Starting', '', '', '', '', '$orbit');";
                
                $plan_in_t="UPDATE `plan_income_manage` SET `plan1` = '$extra_bal' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$extra_bal', '0', '$extra_bal', '+', 'plan 1000rs', '', '$d_id', 'y', '$level', '$orbit');";
                $ww_bal=$dis_fet[withdrawal_wallet]+$extra_bal;
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$extra_bal', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Plan 1 Income', '1');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                $orbit_up="UPDATE `plan_income_manage` SET `o1` = '$orbit' WHERE `plan_income_manage`.`d_id` = '$d_id';";
                if($con->query($plan_iv_e)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($ww_ins)===TRUE && $con->query($ww_up)===TRUE && $con->query($orbit_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '9');";
                    $con->query($df);
                }
                
            }
        
        }
    }
    elseif($dis_fet[a_plan]>'1')
    {
        if($plan_in_fet[plan1]<=8000)
        {
            $planspp=$plan_in_fet[plan1]+$amount;
            if($planspp<=8000)
            {
                $ww_bal=$dis_fet[withdrawal_wallet]+$amount;
                $plan_in_t="UPDATE `plan_income_manage` SET `plan1` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$amount', '$plan_in_fet[plan1]', '$planspp', '+', 'plan 1000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o1]');";
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$amount', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Plan 1 Income', '1');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($ww_ins)===TRUE && $con->query($ww_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '10');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>8000)
            {
                $extra_bal=$planspp-8000;
                $ww_com=$amount-$extra_bal;
                
                ///////////for reserve_fund
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf1]+$extra_bal;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `orbit`) VALUES (NULL, '1', '$d_id', '$date', '$time', '$extra_bal', '$rf_fet[rf1]', '$rf_a_bal', '+', 'Commission', '$plan_in_fet[o1]');";
                $rf_up="UPDATE `reserve_fund` SET `rf1` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                ////////////////////
                $ww_bal=$dis_fet[withdrawal_wallet]+$ww_com;
                
                $plan_in_t="UPDATE `plan_income_manage` SET `plan1` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$amount', '$plan_in_fet[plan1]', '$planspp', '+', 'plan 1000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[orbit]');";
                /////////////////////////////////////
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$ww_com', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Plan 1 Income', '1');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                if($con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($ww_ins)===TRUE && $con->query($ww_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '11');";
                    $con->query($df);
                }
                
            }
        }
        elseif($plan_in_fet[plan1]>8000 && $plan_in_fet[plan1]<=9000)
        {
            $planspp=$plan_in_fet[plan1]+$amount;
            if($planspp<=9000)
            {
                //////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan1` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$amount', '$plan_in_fet[plan1]', '$planspp', '+', 'plan 1000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o1]');";
                
                ///////////for reserve_fund
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf1]+$amount;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `orbit`) VALUES (NULL, '1', '$d_id', '$date', '$time', '$amount', '$rf_fet[rf1]', '$rf_a_bal', '+', 'Commission', '$plan_in_fet[o1]');";
                $rf_up="UPDATE `reserve_fund` SET `rf1` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '12');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>9000)
            {
                $extra_bal=$planspp-9000;
                $rf_com=$amount-$extra_bal;
                
                //////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan1` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$amount', '$plan_in_fet[plan1]', '$planspp', '+', 'plan 1000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o1]');";
                
                
                ///////////for reserve_fund
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf1]+$rf_com;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `orbit`) VALUES (NULL, '1', '$d_id', '$date', '$time', '$rf_com', '$rf_fet[rf1]', '$rf_a_bal', '+', 'Commission', '$plan_in_fet[o1]');";
                $rf_up="UPDATE `reserve_fund` SET `rf1` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                
                ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$extra_bal;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$extra_bal', '$dis_fet[renewal_wallet]', '$renewal_bal', 'commission', '$plan_in_fet[o1]', '+');";
                $renewal_up="UPDATE `distributor` SET `renewal_wallet` = '$renewal_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                
                if($con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($renwal_ins)===TRUE && $con->query($renewal_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '13');";
                    $con->query($df);
                }
                
            }
        
        }
        elseif($plan_in_fet[plan1]>9000 && $plan_in_fet[plan1]<=10000)
        {
            $planspp=$plan_in_fet[plan1]+$amount;
            if($planspp<=10000)
            {
                //////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan1` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$amount', '$plan_in_fet[plan1]', '$planspp', '+', 'plan 1000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o1]');";
                
                 ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$amount;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$amount', '$dis_fet[renewal_wallet]', '$renewal_bal', 'commission', '$plan_in_fet[o1]', '+');";
                $renewal_up="UPDATE `distributor` SET `renewal_wallet` = '$renewal_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($renwal_ins)===TRUE && $con->query($renewal_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '14');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>10000)
            {
                $extra_bal=$planspp-10000;
                $b_amount=$amount-$extra_bal;
                ////////////////////////////////
                ///////////////////////////////////
                /////////////////////////////////////
                //////////for entering under 10000 balance
                $b_plan=$plan_in_fet[plan1]+$b_amount;
                
                //////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan1` = '$b_plan' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$b_amount', '$plan_in_fet[plan1]', '$b_plan', '+', 'plan 1000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o1]');";
                
                
                ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$b_amount;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$b_amount', '$dis_fet[renewal_wallet]', '$renewal_bal', 'commission', '$plan_in_fet[o1]', '+');";
                $renewal_up="UPDATE `distributor` SET `renewal_wallet` = '$renewal_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($renwal_ins)===TRUE && $con->query($renewal_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '15');";
                    $con->query($df);
                }
                
                ////////////////////for entering after 10000 balance
                
                ////////////orbit complete
                
                //////////////////////for renewing id
                for_renewal_income_distribute($d_id);
                //////////////////////////
                $orbit=$plan_in_fet[o1]+1;
                $plan_iv_e="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '10000', '10000', '0', '-', 'New Orbit Starting', '', '', '', '', '$orbit');";
                
                $plan_in_t="UPDATE `plan_income_manage` SET `plan1` = '$extra_bal' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '1', '$date', '$time', '$extra_bal', '0', '$extra_bal', '+', 'plan 1000rs', '', '$d_id', 'y', '$level', '$orbit');";
                $ww_bal=$dis_fet[withdrawal_wallet]+$extra_bal;
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$extra_bal', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Plan 1 Income', '1');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                $orbit_up="UPDATE `plan_income_manage` SET `o1` = '$orbit' WHERE `plan_income_manage`.`d_id` = '$d_id';";
                if($con->query($plan_iv_e)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($ww_ins)===TRUE && $con->query($ww_up)===TRUE && $con->query($orbit_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '16');";
                    $con->query($df);
                }
                
            }
        
        }
    }
}

function distribute_pw_1_activate_id($d_id)
{
    global $con, $date, $time;
    $d_id_sel="SELECT * FROM `distributor` WHERE `d_id`='$d_id'";
    $d_id_que=$con->query($d_id_sel);
    $d_id_fet=$d_id_que->fetch_assoc();
    $pin_bal=$d_id_fet[pw_1]-1;
    if($pin_bal>=0)
    {
        $pin_u="UPDATE `distributor` SET `pw_1` = '$pin_bal' WHERE `distributor`.`d_id` = '$d_id';";
        $pin_ins="INSERT INTO `pw_history` (`pwh_id`, `d_id`, `pw_type`, `date`, `time`, `pin`, `b_pin`, `a_pin`, `type`, `note`) VALUES (NULL, '$d_id', '1', '$date', '$time', '1', '$d_id_fet[pw_1]', '$pin_bal', '-', 'ID Activation');";
        
        $rtnb="UPDATE `distributor` SET `a_status` = 'y' WHERE `distributor`.`d_id` = '$d_id';";
        $cdd="UPDATE `distributor` SET `a_plan` = '1' WHERE `distributor`.`d_id` = '$d_id';";
        $hidd="INSERT INTO `distributor_upgrade_history` (`duh_id`, `d_id`, `plan_type`, `date`, `time`) VALUES (NULL, '$d_id', '1', '$date', '$time');";
        
        ///////////////////////////////for adding to admin 
        $admin_sel="SELECT * FROM `admin_wallet` WHERE `aw_id`='1'";
        $admin_que=$con->query($admin_sel);
        $admin_fet=$admin_que->fetch_assoc();
        $admin_wallet=$admin_fet[a_wallet]+100;
        $admin_ins="INSERT INTO `admin_wallet_history` (`awh_id`, `date`, `time`, `amount`, `b_amount`, `a_amount`, `d_id`, `of_plan`, `level`, `note`) VALUES (NULL, '$date', '$time', '100', '$admin_fet[a_wallet]', '$admin_wallet', '$d_id', '1', '', 'ID Activated');";
        $admin_up="UPDATE `admin_wallet` SET `a_wallet` = '$admin_wallet' WHERE `admin_wallet`.`aw_id` = 1;";
        ////////////////////////////////////for global
        $glo_sel="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1'";
        $glo_que=$con->query($glo_sel);
        $glo_fet=$glo_que->fetch_assoc();
        $glo_a_bal=$glo_fet[g1]+100;
        $glo_up="UPDATE `global_support_system_bal` SET `g1` = '$glo_a_bal' WHERE `global_support_system_bal`.`gssb_id` = 1;";
        $glo_que="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '100', '$glo_fet[g1]', '$glo_a_bal', '+', '$d_id', 'ID Activation', '');";
        
        
        if($con->query($rtnb)===TRUE && $con->query($cdd)===TRUE && $con->query($pin_u)===TRUE && $con->query($pin_ins)===TRUE && $con->query($hidd)===TRUE && $con->query($admin_ins)===TRUE && $con->query($admin_up)===TRUE && $con->query($glo_up)===TRUE && $con->query($glo_que)===TRUE)
        {
            /////////////////////////////////level1
            $d_id_sel1="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet[s_id]'";
            $d_id_que1=$con->query($d_id_sel1);
            $d_id_fet1=$d_id_que1->fetch_assoc();
            if($d_id_fet1[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet1[d_id])>=1)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet1[d_id],'400','1');
                    $rddd1="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet1[d_id]', '1', '$date', '$time', '400', 'Star Plan Commission', '1', '$d_id', '');";
                    if($con->query($rddd1)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 1');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+200;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '200', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet1[d_id]', 'Not Complete Level 1 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+200;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet1[d_id]', '$date', '$time', '200', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 1 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 1 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            /////////////////////////////////level2
            $d_id_sel2="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet1[s_id]'";
            $d_id_que2=$con->query($d_id_sel2);
            $d_id_fet2=$d_id_que2->fetch_assoc();
            if($d_id_fet2[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet2[d_id])>=1)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet2[d_id],'100','2');
                    $rddd2="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet2[d_id]', '1', '$date', '$time', '100', 'Star Plan Commission', '2', '$d_id', '');";
                    if($con->query($rddd2)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 2');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+50;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '50', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet2[d_id]', 'Not Complete Level 2 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+50;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet2[d_id]', '$date', '$time', '50', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 2 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 2 global and security');";
                    $con->query($df);
                    }
                    
                }
                
            }
            
            /////////////////////////////////level3
            $d_id_sel3="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet2[s_id]'";
            $d_id_que3=$con->query($d_id_sel3);
            $d_id_fet3=$d_id_que3->fetch_assoc();
            if($d_id_fet3[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet3[d_id])>=2)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet3[d_id],'70','3');
                    $rddd3="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet3[d_id]', '1', '$date', '$time', '70', 'Star Plan Commission', '3', '$d_id', '');";
                    if($con->query($rddd3)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 3');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+35;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '35', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet3[d_id]', 'Not Complete Level 3 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+35;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet3[d_id]', '$date', '$time', '35', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 3 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 3 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            
            /////////////////////////////////level4
            $d_id_sel4="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet3[s_id]'";
            $d_id_que4=$con->query($d_id_sel4);
            $d_id_fet4=$d_id_que4->fetch_assoc();
            if($d_id_fet4[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet4[d_id])>=2)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet4[d_id],'50','4');
                    $rddd4="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet4[d_id]', '1', '$date', '$time', '50', 'Star Plan Commission', '4', '$d_id', '');";
                    if($con->query($rddd4)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 4');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+25;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '25', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet4[d_id]', 'Not Complete Level 4 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+25;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet4[d_id]', '$date', '$time', '25', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 4 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 4 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            
            /////////////////////////////////level5
            $d_id_sel5="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet4[s_id]'";
            $d_id_que5=$con->query($d_id_sel5);
            $d_id_fet5=$d_id_que5->fetch_assoc();
            if($d_id_fet5[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet5[d_id])>=3)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet5[d_id],'40','5');
                    $rddd5="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet5[d_id]', '1', '$date', '$time', '40', 'Star Plan Commission', '5', '$d_id', '');";
                    if($con->query($rddd5)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 5');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+20;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '20', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet5[d_id]', 'Not Complete Level 5 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+20;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet5[d_id]', '$date', '$time', '20', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 5 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 5 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            
            /////////////////////////////////level6
            $d_id_sel6="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet5[s_id]'";
            $d_id_que6=$con->query($d_id_sel6);
            $d_id_fet6=$d_id_que6->fetch_assoc();
            if($d_id_fet6[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet6[d_id])>=3)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet6[d_id],'30','6');
                    $rddd6="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet6[d_id]', '1', '$date', '$time', '30', 'Star Plan Commission', '6', '$d_id', '');";
                    if($con->query($rddd6)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 6');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+15;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '15', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet6[d_id]', 'Not Complete Level 6 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+15;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet6[d_id]', '$date', '$time', '15', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 6 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 5 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            /////////////////////////////////level7
            $d_id_sel7="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet6[s_id]'";
            $d_id_que7=$con->query($d_id_sel7);
            $d_id_fet7=$d_id_que7->fetch_assoc();
            if($d_id_fet7[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet7[d_id])>=4)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet7[d_id],'30','7');
                    $rddd7="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet7[d_id]', '1', '$date', '$time', '30', 'Star Plan Commission', '7', '$d_id', '');";
                    if($con->query($rddd7)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 7');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+15;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '15', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet7[d_id]', 'Not Complete Level 7 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+15;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet7[d_id]', '$date', '$time', '15', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 7 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 5 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            /////////////////////////////////level8
            $d_id_sel8="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet7[s_id]'";
            $d_id_que8=$con->query($d_id_sel8);
            $d_id_fet8=$d_id_que8->fetch_assoc();
            if($d_id_fet8[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet8[d_id])>=4)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet8[d_id],'20','8');
                    $rddd8="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet8[d_id]', '1', '$date', '$time', '20', 'Star Plan Commission', '8', '$d_id', '');";
                    if($con->query($rddd8)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 8');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+10;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '10', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet8[d_id]', 'Not Complete Level 8 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+10;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet8[d_id]', '$date', '$time', '10', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 8 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 5 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            /////////////////////////////////level9
            $d_id_sel9="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet8[s_id]'";
            $d_id_que9=$con->query($d_id_sel9);
            $d_id_fet9=$d_id_que9->fetch_assoc();
            if($d_id_fet9[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet9[d_id])>=5)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet9[d_id],'20','9');
                    $rddd9="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet9[d_id]', '1', '$date', '$time', '20', 'Star Plan Commission', '9', '$d_id', '');";
                    if($con->query($rddd9)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 9');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+10;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '10', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet9[d_id]', 'Not Complete Level 9 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+10;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet9[d_id]', '$date', '$time', '10', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 9 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 5 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            
            /////////////////////////////////level10
            $d_id_sel10="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet9[s_id]'";
            $d_id_que10=$con->query($d_id_sel10);
            $d_id_fet10=$d_id_que10->fetch_assoc();
            //echo "<br>".$d_id_fet10[d_id];
            if($d_id_fet10[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet10[d_id])>=5)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet10[d_id],'20','10');
                    $rddd10="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet10[d_id]', '1', '$date', '$time', '20', 'Star Plan Commission', '10', '$d_id', '');";
                    if($con->query($rddd10)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 10');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+10;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '10', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet10[d_id]', 'Not Complete Level 10 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+10;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet10[d_id]', '$date', '$time', '10', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 10 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 10 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            /////////////////////////////////level11
            $d_id_sel11="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet10[s_id]'";
            $d_id_que11=$con->query($d_id_sel11);
            $d_id_fet11=$d_id_que11->fetch_assoc();
            if($d_id_fet11[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet11[d_id])>=5)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet11[d_id],'20','11');
                    $rddd11="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet11[d_id]', '1', '$date', '$time', '20', 'Star Plan Commission', '11', '$d_id', '');";
                    if($con->query($rddd11)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 11');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+10;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '10', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet11[d_id]', 'Not Complete Level 11 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+10;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet11[d_id]', '$date', '$time', '10', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 11 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 11 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
        }
        else{
            $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'function 1 failed to update');";
                $con->query($df);
        }
    }else{ echo "you dont have pin balance";}
}

function for_renewal_income_distribute($d_id)
{
    global $con, $date, $time;
    $d_id_sel="SELECT * FROM `distributor` WHERE `d_id`='$d_id';";
    $d_id_que=$con->query($d_id_sel);
    $d_fet=$d_id_que->fetch_assoc();
    
    
    $d_up_re="UPDATE `distributor` SET `renewal_wallet` = '0' WHERE `distributor`.`d_id` = '$d_id';";
    $d_history="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '1', '$date', '$time', '1000', '$d_fet[renewal_wallet]', '0', 'ID Renewed', '', '-');";
    if($con->query($d_up_re)===TRUE && $con->query($d_history)===TRUE)
    {
        ////////////////////////////////////////level 1 10%
        $d_id_sel1="SELECT * FROM `distributor` WHERE `d_id`='$d_fet[s_id]';";
        $d_id_que1=$con->query($d_id_sel1);
        $d_fet1=$d_id_que1->fetch_assoc();
        $d_w_bal1=$d_fet1[withdrawal_wallet]+100;
        $w_up1="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal1' WHERE `distributor`.`d_id` = $d_fet1[d_id];";
        $w_ins1="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet1[d_id]', '$date', '$time', '100', '$d_fet1[withdrawal_wallet]', '$d_w_bal1', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins1="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet1[d_id]', '1', '1', '100', '$date', '$time', '$d_id');";
        $con->query($w_up1);
        $con->query($w_ins1);
        $con->query($r_ins1);
        ////////////////////////////////////////level 2 10%
        $d_id_sel2="SELECT * FROM `distributor` WHERE `d_id`='$d_fet1[s_id]';";
        $d_id_que2=$con->query($d_id_sel2);
        $d_fet2=$d_id_que2->fetch_assoc();
        $d_w_bal2=$d_fet2[withdrawal_wallet]+100;
        $w_up2="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal2' WHERE `distributor`.`d_id` = $d_fet2[d_id];";
        $w_ins2="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet2[d_id]', '$date', '$time', '100', '$d_fet2[withdrawal_wallet]', '$d_w_bal2', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins2="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet2[d_id]', '2', '1', '100', '$date', '$time', '$d_id');";
        $con->query($w_up2);
        $con->query($w_ins2);
        $con->query($r_ins2);
        ////////////////////////////////////////level 3 10%
        $d_id_sel3="SELECT * FROM `distributor` WHERE `d_id`='$d_fet2[s_id]';";
        $d_id_que3=$con->query($d_id_sel3);
        $d_fet3=$d_id_que3->fetch_assoc();
        $d_w_bal3=$d_fet3[withdrawal_wallet]+100;
        $w_up3="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal3' WHERE `distributor`.`d_id` = $d_fet3[d_id];";
        $w_ins3="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet3[d_id]', '$date', '$time', '100', '$d_fet3[withdrawal_wallet]', '$d_w_bal3', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins3="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet3[d_id]', '3', '1', '100', '$date', '$time', '$d_id');";
        $con->query($w_up3);
        $con->query($w_ins3);
        $con->query($r_ins3);
        ////////////////////////////////////////level 4 3%
        $d_id_sel4="SELECT * FROM `distributor` WHERE `d_id`='$d_fet3[s_id]';";
        $d_id_que4=$con->query($d_id_sel4);
        $d_fet4=$d_id_que4->fetch_assoc();
        $d_w_bal4=$d_fet4[withdrawal_wallet]+30;
        $w_up4="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal4' WHERE `distributor`.`d_id` = $d_fet4[d_id];";
        $w_ins4="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet4[d_id]', '$date', '$time', '30', '$d_fet4[withdrawal_wallet]', '$d_w_bal4', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins4="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet4[d_id]', '4', '1', '30', '$date', '$time', '$d_id');";
        $con->query($w_up4);
        $con->query($w_ins4);
        $con->query($r_ins4);
        ////////////////////////////////////////level 5 3%
        $d_id_sel5="SELECT * FROM `distributor` WHERE `d_id`='$d_fet4[s_id]';";
        $d_id_que5=$con->query($d_id_sel5);
        $d_fet5=$d_id_que5->fetch_assoc();
        $d_w_bal5=$d_fet5[withdrawal_wallet]+30;
        $w_up5="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal5' WHERE `distributor`.`d_id` = $d_fet5[d_id];";
        $w_ins5="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet5[d_id]', '$date', '$time', '30', '$d_fet5[withdrawal_wallet]', '$d_w_bal5', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins5="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet5[d_id]', '5', '1', '30', '$date', '$time', '$d_id');";
        $con->query($w_up5);
        $con->query($w_ins5);
        $con->query($r_ins5);
        ////////////////////////////////////////level 6 3%
        $d_id_sel6="SELECT * FROM `distributor` WHERE `d_id`='$d_fet5[s_id]';";
        $d_id_que6=$con->query($d_id_sel6);
        $d_fet6=$d_id_que6->fetch_assoc();
        $d_w_bal6=$d_fet6[withdrawal_wallet]+30;
        $w_up6="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal6' WHERE `distributor`.`d_id` = $d_fet6[d_id];";
        $w_ins6="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet6[d_id]', '$date', '$time', '30', '$d_fet6[withdrawal_wallet]', '$d_w_bal6', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins6="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet6[d_id]', '6', '1', '30', '$date', '$time', '$d_id');";
        $con->query($w_up6);
        $con->query($w_ins6);
        $con->query($r_ins6);
        ////////////////////////////////////////level 7 3%
        $d_id_sel7="SELECT * FROM `distributor` WHERE `d_id`='$d_fet6[s_id]';";
        $d_id_que7=$con->query($d_id_sel7);
        $d_fet7=$d_id_que7->fetch_assoc();
        $d_w_bal7=$d_fet7[withdrawal_wallet]+30;
        $w_up7="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal7' WHERE `distributor`.`d_id` = $d_fet7[d_id];";
        $w_ins7="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet7[d_id]', '$date', '$time', '30', '$d_fet7[withdrawal_wallet]', '$d_w_bal7', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins7="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet7[d_id]', '7', '1', '30', '$date', '$time', '$d_id');";
        $con->query($w_up7);
        $con->query($w_ins7);
        $con->query($r_ins7);
        ////////////////////////////////////////level 8 3%
        $d_id_sel8="SELECT * FROM `distributor` WHERE `d_id`='$d_fet7[s_id]';";
        $d_id_que8=$con->query($d_id_sel8);
        $d_fet8=$d_id_que8->fetch_assoc();
        $d_w_bal8=$d_fet8[withdrawal_wallet]+30;
        $w_up8="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal8' WHERE `distributor`.`d_id` = $d_fet8[d_id];";
        $w_ins8="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet8[d_id]', '$date', '$time', '30', '$d_fet8[withdrawal_wallet]', '$d_w_bal8', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins8="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet8[d_id]', '8', '1', '30', '$date', '$time', '$d_id');";
        $con->query($w_up8);
        $con->query($w_ins8);
        $con->query($r_ins8);
        ////////////////////////////////////////level 9 2%
        $d_id_sel9="SELECT * FROM `distributor` WHERE `d_id`='$d_fet8[s_id]';";
        $d_id_que9=$con->query($d_id_sel9);
        $d_fet9=$d_id_que9->fetch_assoc();
        $d_w_bal9=$d_fet9[withdrawal_wallet]+20;
        $w_up9="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal9' WHERE `distributor`.`d_id` = $d_fet9[d_id];";
        $w_ins9="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet9[d_id]', '$date', '$time', '20', '$d_fet9[withdrawal_wallet]', '$d_w_bal9', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins9="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet9[d_id]', '9', '1', '20', '$date', '$time', '$d_id');";
        $con->query($w_up9);
        $con->query($w_ins9);
        $con->query($r_ins9);
        ////////////////////////////////////////level 10 2%
        $d_id_sel10="SELECT * FROM `distributor` WHERE `d_id`='$d_fet9[s_id]';";
        $d_id_que10=$con->query($d_id_sel10);
        $d_fet10=$d_id_que10->fetch_assoc();
        $d_w_bal10=$d_fet10[withdrawal_wallet]+20;
        $w_up10="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal10' WHERE `distributor`.`d_id` = $d_fet10[d_id];";
        $w_ins10="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet10[d_id]', '$date', '$time', '20', '$d_fet10[withdrawal_wallet]', '$d_w_bal10', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins10="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet10[d_id]', '10', '1', '20', '$date', '$time', '$d_id');";
        $con->query($w_up10);
        $con->query($w_ins10);
        $con->query($r_ins10);
        ////////////////////////////////////////level 11 2%
        $d_id_sel11="SELECT * FROM `distributor` WHERE `d_id`='$d_fet10[s_id]';";
        $d_id_que11=$con->query($d_id_sel11);
        $d_fet11=$d_id_que11->fetch_assoc();
        $d_w_bal11=$d_fet11[withdrawal_wallet]+20;
        $w_up11="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal11' WHERE `distributor`.`d_id` = $d_fet11[d_id];";
        $w_ins11="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet11[d_id]', '$date', '$time', '20', '$d_fet11[withdrawal_wallet]', '$d_w_bal11', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins11="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet11[d_id]', '11', '1', '20', '$date', '$time', '$d_id');";
        $con->query($w_up11);
        $con->query($w_ins11);
        $con->query($r_ins11);
        ////////////////////////////////////////level 12 2%
        $d_id_sel12="SELECT * FROM `distributor` WHERE `d_id`='$d_fet11[s_id]';";
        $d_id_que12=$con->query($d_id_sel12);
        $d_fet12=$d_id_que12->fetch_assoc();
        $d_w_bal12=$d_fet12[withdrawal_wallet]+20;
        $w_up12="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal12' WHERE `distributor`.`d_id` = $d_fet12[d_id];";
        $w_ins12="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet12[d_id]', '$date', '$time', '20', '$d_fet12[withdrawal_wallet]', '$d_w_bal12', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins12="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet12[d_id]', '12', '1', '20', '$date', '$time', '$d_id');";
        $con->query($w_up12);
        $con->query($w_ins12);
        $con->query($r_ins12);
        ////////////////////////////////////////level 13 2%
        $d_id_sel13="SELECT * FROM `distributor` WHERE `d_id`='$d_fet12[s_id]';";
        $d_id_que13=$con->query($d_id_sel13);
        $d_fet13=$d_id_que13->fetch_assoc();
        $d_w_bal13=$d_fet13[withdrawal_wallet]+20;
        $w_up13="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal13' WHERE `distributor`.`d_id` = $d_fet13[d_id];";
        $w_ins13="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet13[d_id]', '$date', '$time', '20', '$d_fet13[withdrawal_wallet]', '$d_w_bal13', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins13="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet13[d_id]', '13', '1', '20', '$date', '$time', '$d_id');";
        $con->query($w_up13);
        $con->query($w_ins13);
        $con->query($r_ins13);
        ////////////////////////////////////////level 14 2%
        $d_id_sel14="SELECT * FROM `distributor` WHERE `d_id`='$d_fet13[s_id]';";
        $d_id_que14=$con->query($d_id_sel14);
        $d_fet14=$d_id_que14->fetch_assoc();
        $d_w_bal14=$d_fet14[withdrawal_wallet]+20;
        $w_up14="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal14' WHERE `distributor`.`d_id` = $d_fet14[d_id];";
        $w_ins14="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet14[d_id]', '$date', '$time', '20', '$d_fet14[withdrawal_wallet]', '$d_w_bal14', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins14="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet14[d_id]', '14', '1', '20', '$date', '$time', '$d_id');";
        $con->query($w_up14);
        $con->query($w_ins14);
        $con->query($r_ins14);
        ////////////////////////////////////////level 15 2%
        $d_id_sel15="SELECT * FROM `distributor` WHERE `d_id`='$d_fet14[s_id]';";
        $d_id_que15=$con->query($d_id_sel15);
        $d_fet15=$d_id_que15->fetch_assoc();
        $d_w_bal15=$d_fet15[withdrawal_wallet]+20;
        $w_up15="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal15' WHERE `distributor`.`d_id` = $d_fet15[d_id];";
        $w_ins15="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet15[d_id]', '$date', '$time', '20', '$d_fet15[withdrawal_wallet]', '$d_w_bal15', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins15="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet15[d_id]', '15', '1', '20', '$date', '$time', '$d_id');";
        $con->query($w_up15);
        $con->query($w_ins15);
        $con->query($r_ins15);
        ////////////////////////////////////////level 16 2%
        $d_id_sel16="SELECT * FROM `distributor` WHERE `d_id`='$d_fet15[s_id]';";
        $d_id_que16=$con->query($d_id_sel16);
        $d_fet16=$d_id_que16->fetch_assoc();
        $d_w_bal16=$d_fet16[withdrawal_wallet]+20;
        $w_up16="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal16' WHERE `distributor`.`d_id` = $d_fet16[d_id];";
        $w_ins16="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet16[d_id]', '$date', '$time', '20', '$d_fet16[withdrawal_wallet]', '$d_w_bal16', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins16="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet16[d_id]', '16', '1', '20', '$date', '$time', '$d_id');";
        $con->query($w_up16);
        $con->query($w_ins16);
        $con->query($r_ins16);
        ////////////////////////////////////////level 17 2%
        $d_id_sel17="SELECT * FROM `distributor` WHERE `d_id`='$d_fet16[s_id]';";
        $d_id_que17=$con->query($d_id_sel17);
        $d_fet17=$d_id_que17->fetch_assoc();
        $d_w_bal17=$d_fet17[withdrawal_wallet]+20;
        $w_up17="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal17' WHERE `distributor`.`d_id` = $d_fet17[d_id];";
        $w_ins17="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet17[d_id]', '$date', '$time', '20', '$d_fet17[withdrawal_wallet]', '$d_w_bal17', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins17="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet17[d_id]', '17', '1', '20', '$date', '$time', '$d_id');";
        $con->query($w_up17);
        $con->query($w_ins17);
        $con->query($r_ins17);
        ////////////////////////////////////////level 18 2%
        $d_id_sel18="SELECT * FROM `distributor` WHERE `d_id`='$d_fet17[s_id]';";
        $d_id_que18=$con->query($d_id_sel18);
        $d_fet18=$d_id_que18->fetch_assoc();
        $d_w_bal18=$d_fet18[withdrawal_wallet]+20;
        $w_up18="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal18' WHERE `distributor`.`d_id` = $d_fet18[d_id];";
        $w_ins18="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet18[d_id]', '$date', '$time', '20', '$d_fet18[withdrawal_wallet]', '$d_w_bal18', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins18="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet18[d_id]', '18', '1', '20', '$date', '$time', '$d_id');";
        $con->query($w_up18);
        $con->query($w_ins18);
        $con->query($r_ins18);
        ////////////////////////////////////////level 19 1%
        $d_id_sel19="SELECT * FROM `distributor` WHERE `d_id`='$d_fet18[s_id]';";
        $d_id_que19=$con->query($d_id_sel19);
        $d_fet19=$d_id_que19->fetch_assoc();
        $d_w_bal19=$d_fet19[withdrawal_wallet]+10;
        $w_up19="UPDATE `distributor` SET `withdrawal_wallet` = '$d_w_bal19' WHERE `distributor`.`d_id` = $d_fet19[d_id];";
        $w_ins19="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$d_fet19[d_id]', '$date', '$time', '10', '$d_fet19[withdrawal_wallet]', '$d_w_bal19', '+', 'ID Renewed Commission', '1', '$d_id', '', '');";
        $r_ins19="INSERT INTO `renewal_income` (`ri_id`, `d_id`, `level`, `plan_type`, `amount`, `date`, `time`, `of_d_id`) VALUES (NULL, '$d_fet19[d_id]', '19', '1', '10', '$date', '$time', '$d_id');";
        $con->query($w_up19);
        $con->query($w_ins19);
        $con->query($r_ins19);
        
        
    }
}

//////////////////////////////////
////////////////////////////////////////
/////////////////////////////////////////// plan 2000/-

function for_finding_direct_id_plan2($d_id)
{
    global $con;
    $d_id_sel="SELECT * FROM `distributor` WHERE `s_id`='$d_id' AND `a_plan`='2';";
    $d_id_que=$con->query($d_id_sel);
    $count=$d_id_que->num_rows;
    return($count);
    
}
function for_amount_insert_by_orbit_plan2($d_id,$amount,$level)
{
    global $con, $date, $time;
    $dis_sel="SELECT * FROM `distributor` WHERE `d_id`='$d_id'";
    $dis_que=$con->query($dis_sel);
    $dis_fet=$dis_que->fetch_assoc();
    $plan_in="SELECT d_id,plan2,o2 FROM `plan_income_manage` WHERE `d_id`='$d_id'";
    $plan_in_que=$con->query($plan_in);
    $plan_in_fet=$plan_in_que->fetch_assoc();
    $planspp=$plan_in_fet[plan2]+$amount;
    
    if($dis_fet[a_plan]=='2')
    {
        if($plan_in_fet[plan2]<=6000)
        {
            $planspp=$plan_in_fet[plan2]+$amount;
            if($planspp<=6000)
            {
                $ww_bal=$dis_fet[withdrawal_wallet]+$amount;
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'plan 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$amount', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Plan 2 Income', '2');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($ww_ins)===TRUE && $con->query($ww_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '1');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>6000)
            {
                $extra_bal=$planspp-6000;
                $ww_com=$amount-$extra_bal;
                $upg_bal=$dis_fet[upgrade_wallet]+$extra_bal;
                /////////////////
                $upg_ins="INSERT INTO `upgrade_wallet_history` (`uwh_id`, `d_id`, `date`, `time`, `plan_type`, `level`, `amount`, `b_bal`, `a_bal`, `note`, `type`, `orbit`) VALUES (NULL, '$d_id', '$date', '$time', 'Plan 2000rs', '$level', '$extra_bal', '$dis_fet[upgrade_wallet]', '$upg_bal', 'For Upgrading', '+', '$plan_in_fet[o2]');";
                $upg_up="UPDATE `distributor` SET `upgrade_wallet` = '$upg_bal' WHERE `distributor`.`d_id` = '$d_id';";
                ////////////////////
                $ww_bal=$dis_fet[withdrawal_wallet]+$ww_com;
                
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'plan 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[orbit]');";
                /////////////////////////////////////
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$ww_com', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Plan 2 Income', '2');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                if($con->query($upg_ins)===TRUE && $con->query($upg_up)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($ww_ins)===TRUE && $con->query($ww_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '2');";
                    $con->query($df);
                }
                
            }
        }
        elseif($plan_in_fet[plan2]>6000 && $plan_in_fet[plan2]<=8000)
        {
            $planspp=$plan_in_fet[plan2]+$amount;
            if($planspp<=8000)
            {
                //////////////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'plan 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                ///////////////////////////////////////
                $upg_bal=$dis_fet[upgrade_wallet]+$amount;
                $upg_ins="INSERT INTO `upgrade_wallet_history` (`uwh_id`, `d_id`, `date`, `time`, `plan_type`, `level`, `amount`, `b_bal`, `a_bal`, `note`, `type`, `orbit`) VALUES (NULL, '$d_id', '$date', '$time', 'Plan 2000rs', '$level', '$amount', '$dis_fet[upgrade_wallet]', '$upg_bal', 'For Upgrading', '+', '$plan_in_fet[o2]');";
                $upg_up="UPDATE `distributor` SET `upgrade_wallet` = '$upg_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($upg_ins)===TRUE && $con->query($upg_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '3');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>8000)
            {
                $extra_bal=$planspp-8000;
                $upg_com=$amount-$extra_bal;
                $upg_bal=$dis_fet[upgrade_wallet]+$upg_com;
                ////////////////////////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'plan 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[orbit]');";
                ///////////////////////////////////////////////////
                $upg_ins="INSERT INTO `upgrade_wallet_history` (`uwh_id`, `d_id`, `date`, `time`, `plan_type`, `level`, `amount`, `b_bal`, `a_bal`, `note`, `type`, `orbit`) VALUES (NULL, '$d_id', '$date', '$time', 'Plan 2000rs', '$level', '$upg_com', '$dis_fet[upgrade_wallet]', '$upg_bal', 'For Upgrading', '+', '$plan_in_fet[orbit]');";
                $upg_up="UPDATE `distributor` SET `upgrade_wallet` = '$upg_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                ///////////for reserve_fund
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf2]+$extra_bal;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '2', '$d_id', '$date', '$time', '$extra_bal', '$rf_fet[rf2]', '$rf_a_bal', '+', 'Commission');";
                $rf_up="UPDATE `reserve_fund` SET `rf2` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                
                
                if($con->query($upg_ins)===TRUE && $con->query($upg_up)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '4');";
                    $con->query($df);
                }
                
            }
        
        }
        elseif($plan_in_fet[plan2]>8000 && $plan_in_fet[plan2]<=9000)
        {
            $planspp=$plan_in_fet[plan2]+$amount;
            if($planspp<=9000)
            {
                //////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'plan 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                
                ///////////for reserve_fund
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf2]+$amount;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `orbit`) VALUES (NULL, '2', '$d_id', '$date', '$time', '$amount', '$rf_fet[rf2]', '$rf_a_bal', '+', 'Commission', '$plan_in_fet[o2]');";
                $rf_up="UPDATE `reserve_fund` SET `rf2` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 2;";
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '5');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>9000)
            {
                $extra_bal=$planspp-9000;
                $rf_com=$amount-$extra_bal;
                
                //////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'plan 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                
                
                ///////////for reserve_fund`    
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf2]+$rf_com;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `orbit`) VALUES (NULL, '2', '$d_id', '$date', '$time', '$rf_com', '$rf_fet[rf2]', '$rf_a_bal', '+', 'Commission', '$plan_in_fet[o2]');";
                $rf_up="UPDATE `reserve_fund` SET `rf2` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                
                ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$extra_bal;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$extra_bal', '$dis_fet[renewal_wallet]', '$renewal_bal', 'commission', '$plan_in_fet[o2]', '+');";
                $renewal_up="UPDATE `distributor` SET `renewal_wallet` = '$renewal_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                
                if($con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($renwal_ins)===TRUE && $con->query($renewal_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '6');";
                    $con->query($df);
                }
                
            }
        
        }
        elseif($plan_in_fet[plan2]>9000 && $plan_in_fet[plan2]<=20000)
        {
            $planspp=$plan_in_fet[plan2]+$amount;
            if($planspp<=20000)
            {
                //////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'plan 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                
                 ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$amount;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$dis_fet[renewal_wallet]', '$renewal_bal', 'commission', '$plan_in_fet[o2]', '+');";
                $renewal_up="UPDATE `distributor` SET `renewal_wallet` = '$renewal_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($renwal_ins)===TRUE && $con->query($renewal_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '7');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>20000)
            {
                $extra_bal=$planspp-20000;
                $b_amount=$amount-$extra_bal;
                ////////////////////////////////
                ///////////////////////////////////
                /////////////////////////////////////
                //////////for entering under 20000 balance
                $b_plan=$plan_in_fet[plan2]+$b_amount;
                
                //////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$b_plan' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$b_amount', '$plan_in_fet[plan2]', '$b_plan', '+', 'plan 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                
                
                ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$b_amount;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$b_amount', '$dis_fet[renewal_wallet]', '$renewal_bal', 'commission', '$plan_in_fet[o2]', '+');";
                $renewal_up="UPDATE `distributor` SET `renewal_wallet` = '$renewal_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($renwal_ins)===TRUE && $con->query($renewal_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '8');";
                    $con->query($df);
                }
                
                ////////////////////for entering after 20000 balance
                
                ////////////orbit complete
                
                ////////for renewing ID
                for_renewal_income_distribute($d_id);
                //////////////////////////
                $orbit=$plan_in_fet[o2]+1;
                $plan_iv_e="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '20000', '20000', '0', '-', 'New Orbit Starting', '', '', '', '', '$orbit');";
                
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$extra_bal' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$extra_bal', '0', '$extra_bal', '+', 'plan 2000rs', '', '$d_id', 'y', '$level', '$orbit');";
                $ww_bal=$dis_fet[withdrawal_wallet]+$extra_bal;
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$extra_bal', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Plan 2 Income', '2');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                $orbit_up="UPDATE `plan_income_manage` SET `o2` = '$orbit' WHERE `plan_income_manage`.`d_id` = '$d_id';";
                if($con->query($plan_iv_e)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($ww_ins)===TRUE && $con->query($ww_up)===TRUE && $con->query($orbit_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '9');";
                    $con->query($df);
                }
                
            }
        
        }
    }
    elseif($dis_fet[a_plan]>'2')
    {
        if($plan_in_fet[plan2]<=8000)
        {
            $planspp=$plan_in_fet[plan2]+$amount;
            if($planspp<=8000)
            {
                $ww_bal=$dis_fet[withdrawal_wallet]+$amount;
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'plan 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$amount', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Plan 2 Income', '2');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($ww_ins)===TRUE && $con->query($ww_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '20');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>8000)
            {
                $extra_bal=$planspp-8000;
                $ww_com=$amount-$extra_bal;
                
                ///////////for reserve_fund
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf2]+$extra_bal;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `orbit`) VALUES (NULL, '2', '$d_id', '$date', '$time', '$extra_bal', '$rf_fet[rf2]', '$rf_a_bal', '+', 'Commission', '$plan_in_fet[o2]');";
                $rf_up="UPDATE `reserve_fund` SET `rf2` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                ////////////////////
                $ww_bal=$dis_fet[withdrawal_wallet]+$ww_com;
                
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'plan 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[orbit]');";
                /////////////////////////////////////
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$ww_com', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Plan 2 Income', '2');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                if($con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($ww_ins)===TRUE && $con->query($ww_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '22');";
                    $con->query($df);
                }
                
            }
        }
        elseif($plan_in_fet[plan2]>8000 && $plan_in_fet[plan2]<=9000)
        {
            $planspp=$plan_in_fet[plan2]+$amount;
            if($planspp<=9000)
            {
                //////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'plan 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                
                ///////////for reserve_fund
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf2]+$amount;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `orbit`) VALUES (NULL, '2', '$d_id', '$date', '$time', '$amount', '$rf_fet[rf2]', '$rf_a_bal', '+', 'Commission', '$plan_in_fet[o2]');";
                $rf_up="UPDATE `reserve_fund` SET `rf2` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '22');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>9000)
            {
                $extra_bal=$planspp-9000;
                $rf_com=$amount-$extra_bal;
                
                //////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'plan 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                
                
                ///////////for reserve_fund
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf2]+$rf_com;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `orbit`) VALUES (NULL, '2', '$d_id', '$date', '$time', '$rf_com', '$rf_fet[rf2]', '$rf_a_bal', '+', 'Commission', '$plan_in_fet[o2]');";
                $rf_up="UPDATE `reserve_fund` SET `rf2` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                
                ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$extra_bal;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$extra_bal', '$dis_fet[renewal_wallet]', '$renewal_bal', 'commission', '$plan_in_fet[o2]', '+');";
                $renewal_up="UPDATE `distributor` SET `renewal_wallet` = '$renewal_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                
                if($con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($renwal_ins)===TRUE && $con->query($renewal_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '23');";
                    $con->query($df);
                }
                
            }
        
        }
        elseif($plan_in_fet[plan2]>9000 && $plan_in_fet[plan2]<=20000)
        {
            $planspp=$plan_in_fet[plan2]+$amount;
            if($planspp<=20000)
            {
                //////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'plan 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                
                 ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$amount;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$dis_fet[renewal_wallet]', '$renewal_bal', 'commission', '$plan_in_fet[o2]', '+');";
                $renewal_up="UPDATE `distributor` SET `renewal_wallet` = '$renewal_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($renwal_ins)===TRUE && $con->query($renewal_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '24');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>20000)
            {
                $extra_bal=$planspp-20000;
                $b_amount=$amount-$extra_bal;
                ////////////////////////////////
                ///////////////////////////////////
                /////////////////////////////////////
                //////////for entering under 20000 balance
                $b_plan=$plan_in_fet[plan2]+$b_amount;
                
                //////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$b_plan' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$b_amount', '$plan_in_fet[plan2]', '$b_plan', '+', 'plan 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                
                
                ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$b_amount;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$b_amount', '$dis_fet[renewal_wallet]', '$renewal_bal', 'commission', '$plan_in_fet[o2]', '+');";
                $renewal_up="UPDATE `distributor` SET `renewal_wallet` = '$renewal_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($renwal_ins)===TRUE && $con->query($renewal_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '25');";
                    $con->query($df);
                }
                
                ////////////////////for entering after 20000 balance
                
                ////////////orbit complete
                
                //////////////////////for renewing id
                for_renewal_income_distribute($d_id);
                //////////////////////////
                $orbit=$plan_in_fet[o2]+1;
                $plan_iv_e="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '20000', '20000', '0', '-', 'New Orbit Starting', '', '', '', '', '$orbit');";
                
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$extra_bal' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$extra_bal', '0', '$extra_bal', '+', 'plan 2000rs', '', '$d_id', 'y', '$level', '$orbit');";
                $ww_bal=$dis_fet[withdrawal_wallet]+$extra_bal;
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$extra_bal', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Plan 2 Income', '2');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                $orbit_up="UPDATE `plan_income_manage` SET `o2` = '$orbit' WHERE `plan_income_manage`.`d_id` = '$d_id';";
                if($con->query($plan_iv_e)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($ww_ins)===TRUE && $con->query($ww_up)===TRUE && $con->query($orbit_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '26');";
                    $con->query($df);
                }
                
            }
        
        }
    }
}
///////////////

function distribute_pw_2_activate_id($d_id)
{
    global $con, $date, $time;
    $d_id_sel="SELECT * FROM `distributor` WHERE `d_id`='$d_id'";
    $d_id_que=$con->query($d_id_sel);
    $d_id_fet=$d_id_que->fetch_assoc();
    $pin_bal=$d_id_fet[pw_2]-1;
    if($pin_bal>=0)
    {
        $pin_u="UPDATE `distributor` SET `pw_2` = '$pin_bal' WHERE `distributor`.`d_id` = '$d_id';";
        $pin_ins="INSERT INTO `pw_history` (`pwh_id`, `d_id`, `pw_type`, `date`, `time`, `pin`, `b_pin`, `a_pin`, `type`, `note`) VALUES (NULL, '$d_id', '2', '$date', '$time', '1', '$d_id_fet[pw_2]', '$pin_bal', '-', 'ID Activation');";
        
        $rtnb="UPDATE `distributor` SET `a_status` = 'y' WHERE `distributor`.`d_id` = '$d_id';";
        $cdd="UPDATE `distributor` SET `a_plan` = '2' WHERE `distributor`.`d_id` = '$d_id';";
        $hidd="INSERT INTO `distributor_upgrade_history` (`duh_id`, `d_id`, `plan_type`, `date`, `time`) VALUES (NULL, '$d_id', '2', '$date', '$time');";
        
        ///////////////////////////////for adding to admin 
        $admin_sel="SELECT * FROM `admin_wallet` WHERE `aw_id`='1'";
        $admin_que=$con->query($admin_sel);
        $admin_fet=$admin_que->fetch_assoc();
        $admin_wallet=$admin_fet[a_wallet]+200;
        $admin_ins="INSERT INTO `admin_wallet_history` (`awh_id`, `date`, `time`, `amount`, `b_amount`, `a_amount`, `d_id`, `of_plan`, `level`, `note`) VALUES (NULL, '$date', '$time', '200', '$admin_fet[a_wallet]', '$admin_wallet', '$d_id', '2', '', 'ID Activated');";
        $admin_up="UPDATE `admin_wallet` SET `a_wallet` = '$admin_wallet' WHERE `admin_wallet`.`aw_id` = 1;";
        ////////////////////////////////////for global
        $glo_sel="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1'";
        $glo_que=$con->query($glo_sel);
        $glo_fet=$glo_que->fetch_assoc();
        $glo_a_bal=$glo_fet[g2]+200;
        $glo_up="UPDATE `global_support_system_bal` SET `g2` = '$glo_a_bal' WHERE `global_support_system_bal`.`gssb_id` = 1;";
        $glo_que="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '2', '$date', '$time', '200', '$glo_fet[g2]', '$glo_a_bal', '+', '$d_id', 'ID Activation', '');";
        
        
        if($con->query($rtnb)===TRUE && $con->query($cdd)===TRUE && $con->query($pin_u)===TRUE && $con->query($pin_ins)===TRUE && $con->query($hidd)===TRUE && $con->query($admin_ins)===TRUE && $con->query($admin_up)===TRUE && $con->query($glo_up)===TRUE && $con->query($glo_que)===TRUE)
        {
            /////////////////////////////////level1
            $d_id_sel1="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet[s_id]'";
            $d_id_que1=$con->query($d_id_sel1);
            $d_id_fet1=$d_id_que1->fetch_assoc();
            if($d_id_fet1[a_plan]=='2')
            {
                for_amount_insert_by_orbit_plan2($d_id_fet1[d_id],'200','1');
                $rddd1="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet1[d_id]', '2', '$date', '$time', '200', 'Silver Plan Commission', '1', '$d_id', '');";
                if($con->query($rddd1)===TRUE)
                {
                    
                }
                else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 1');";
                $con->query($df);
                }
            }else{
                for_amount_insert_by_orbit_plan2($d_id_fet1[d_id],'100','1');
                $rddd1="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet1[d_id]', '2', '$date', '$time', '100', 'Silver Plan Commission', '1', '$d_id', '');";
                if($con->query($rddd1)===TRUE)
                {
                    
                }
                else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 1');";
                $con->query($df);
                }
                
                
                $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                $secu_que1=$con->query($secu_sel1);
                $secu_fet1=$secu_que1->fetch_assoc();
                $a_secu_bal1=$secu_fet1[security_bal]+100;
                $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet1[d_id]', '$date', '$time', '100', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Upgraded');";
                $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                if($con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                {
                    
                }else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 1 and security');";
                $con->query($df);
                }
                
            }
            
            /////////////////////////////////level2
            $d_id_sel2="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet1[s_id]'";
            $d_id_que2=$con->query($d_id_sel2);
            $d_id_fet2=$d_id_que2->fetch_assoc();
            if($d_id_fet2[a_plan]=='2')
            {
                
                for_amount_insert_by_orbit_plan2($d_id_fet2[d_id],'800','2');
                $rddd2="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet2[d_id]', '2', '$date', '$time', '800', 'Silver Plan Commission', '2', '$d_id', '');";
                if($con->query($rddd2)===TRUE)
                {
                    
                }
                else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 2');";
                $con->query($df);
                }
            }else{
                for_amount_insert_by_orbit_plan2($d_id_fet2[d_id],'400','2');
                $rddd2="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet2[d_id]', '2', '$date', '$time', '400', 'Silver Plan Commission', '2', '$d_id', '');";
                if($con->query($rddd2)===TRUE)
                {
                    
                }
                else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 2');";
                $con->query($df);
                }
    
                
                $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                $secu_que1=$con->query($secu_sel1);
                $secu_fet1=$secu_que1->fetch_assoc();
                $a_secu_bal1=$secu_fet1[security_bal]+400;
                $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet2[d_id]', '$date', '$time', '400', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Upgraded');";
                $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                if($con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                {
                    
                }else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 2 global and security');";
                $con->query($df);
                }
                
            }
                
            
            
            /////////////////////////////////level3
            $d_id_sel3="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet2[s_id]'";
            $d_id_que3=$con->query($d_id_sel3);
            $d_id_fet3=$d_id_que3->fetch_assoc();
            if($d_id_fet3[a_plan]=='2')
            {
                for_amount_insert_by_orbit_plan2($d_id_fet3[d_id],'140','3');
                $rddd3="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet3[d_id]', '2', '$date', '$time', '140', 'Silver Plan Commission', '3', '$d_id', '');";
                if($con->query($rddd3)===TRUE)
                {
                    
                }
                else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 3');";
                $con->query($df);
                }
            }else{
                for_amount_insert_by_orbit_plan2($d_id_fet3[d_id],'70','3');
                $rddd3="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet3[d_id]', '2', '$date', '$time', '70', 'Silver Plan Commission', '3', '$d_id', '');";
                if($con->query($rddd3)===TRUE)
                {
                    
                }
                else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 3');";
                $con->query($df);
                }
                
                $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                $secu_que1=$con->query($secu_sel1);
                $secu_fet1=$secu_que1->fetch_assoc();
                $a_secu_bal1=$secu_fet1[security_bal]+70;
                $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet3[d_id]', '$date', '$time', '70', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Upgraded');";
                $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                if($con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                {
                    
                }else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 3 global and security');";
                $con->query($df);
                }
                
            }
            
            
            /////////////////////////////////level4
            $d_id_sel4="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet3[s_id]'";
            $d_id_que4=$con->query($d_id_sel4);
            $d_id_fet4=$d_id_que4->fetch_assoc();
            if($d_id_fet4[a_plan]=='2')
            {
                
                for_amount_insert_by_orbit_plan2($d_id_fet4[d_id],'100','4');
                $rddd4="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet4[d_id]', '2', '$date', '$time', '100', 'Silver Plan Commission', '4', '$d_id', '');";
                if($con->query($rddd4)===TRUE)
                {
                    
                }
                else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 4');";
                $con->query($df);
                }
            }else{
                
                for_amount_insert_by_orbit_plan2($d_id_fet4[d_id],'50','4');
                $rddd4="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet4[d_id]', '2', '$date', '$time', '50', 'Silver Plan Commission', '4', '$d_id', '');";
                if($con->query($rddd4)===TRUE)
                {
                    
                }
                else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 4');";
                $con->query($df);
                }
                
                $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                $secu_que1=$con->query($secu_sel1);
                $secu_fet1=$secu_que1->fetch_assoc();
                $a_secu_bal1=$secu_fet1[security_bal]+50;
                $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet4[d_id]', '$date', '$time', '50', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Upgraded');";
                $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                if($con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                {
                    
                }else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 4 global and security');";
                $con->query($df);
                }
                
            }
            
            
            /////////////////////////////////level5
            $d_id_sel5="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet4[s_id]'";
            $d_id_que5=$con->query($d_id_sel5);
            $d_id_fet5=$d_id_que5->fetch_assoc();
            if($d_id_fet5[a_plan]=='2')
            {
                
                for_amount_insert_by_orbit_plan2($d_id_fet5[d_id],'80','5');
                $rddd5="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet5[d_id]', '2', '$date', '$time', '80', 'Silver Plan Commission', '5', '$d_id', '');";
                if($con->query($rddd5)===TRUE)
                {
                    
                }
                else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 5');";
                $con->query($df);
                }
            }else{
                for_amount_insert_by_orbit_plan2($d_id_fet5[d_id],'80','5');
                $rddd5="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet5[d_id]', '2', '$date', '$time', '80', 'Silver Plan Commission', '5', '$d_id', '');";
                if($con->query($rddd5)===TRUE)
                {
                    
                }
                else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 5');";
                $con->query($df);
                }
                
                $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                $secu_que1=$con->query($secu_sel1);
                $secu_fet1=$secu_que1->fetch_assoc();
                $a_secu_bal1=$secu_fet1[security_bal]+40;
                $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet5[d_id]', '$date', '$time', '40', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Upgraded');";
                $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                if($con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                {
                    
                }else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 5 global and security');";
                $con->query($df);
                }
                
            }
            
            
            /////////////////////////////////level6
            $d_id_sel6="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet5[s_id]'";
            $d_id_que6=$con->query($d_id_sel6);
            $d_id_fet6=$d_id_que6->fetch_assoc();
            if($d_id_fet6[a_plan]=='2')
            {
                for_amount_insert_by_orbit_plan2($d_id_fet6[d_id],'60','6');
                $rddd6="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet6[d_id]', '2', '$date', '$time', '60', 'Silver Plan Commission', '6', '$d_id', '');";
                if($con->query($rddd6)===TRUE)
                {
                    
                }
                else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 6');";
                $con->query($df);
                }
            }else{
                for_amount_insert_by_orbit_plan2($d_id_fet6[d_id],'30','6');
                $rddd6="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet6[d_id]', '2', '$date', '$time', '30', 'Silver Plan Commission', '6', '$d_id', '');";
                if($con->query($rddd6)===TRUE)
                {
                    
                }
                else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 6');";
                $con->query($df);
                }
                
                $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                $secu_que1=$con->query($secu_sel1);
                $secu_fet1=$secu_que1->fetch_assoc();
                $a_secu_bal1=$secu_fet1[security_bal]+30;
                $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet6[d_id]', '$date', '$time', '30', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Upgraded');";
                $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                if($con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                {
                    
                }else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 5 global and security');";
                $con->query($df);
                }
                
            }
            
            /////////////////////////////////level7
            $d_id_sel7="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet6[s_id]'";
            $d_id_que7=$con->query($d_id_sel7);
            $d_id_fet7=$d_id_que7->fetch_assoc();
            if($d_id_fet7[a_plan]=='2')
            {
                for_amount_insert_by_orbit_plan2($d_id_fet7[d_id],'60','7');
                $rddd7="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet7[d_id]', '2', '$date', '$time', '60', 'Silver Plan Commission', '7', '$d_id', '');";
                if($con->query($rddd7)===TRUE)
                {
                    
                }
                else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 7');";
                $con->query($df);
                }
            }else{
                for_amount_insert_by_orbit_plan2($d_id_fet7[d_id],'30','7');
                $rddd7="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet7[d_id]', '2', '$date', '$time', '30', 'Silver Plan Commission', '7', '$d_id', '');";
                if($con->query($rddd7)===TRUE)
                {
                    
                }
                else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 7');";
                $con->query($df);
                }
                
                $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                $secu_que1=$con->query($secu_sel1);
                $secu_fet1=$secu_que1->fetch_assoc();
                $a_secu_bal1=$secu_fet1[security_bal]+30;
                $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet7[d_id]', '$date', '$time', '30', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Upgraded');";
                $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                if($con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                {
                    
                }else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 5 global and security');";
                $con->query($df);
                }
                
            }
            
            /////////////////////////////////level8
            $d_id_sel8="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet7[s_id]'";
            $d_id_que8=$con->query($d_id_sel8);
            $d_id_fet8=$d_id_que8->fetch_assoc();
            if($d_id_fet8[a_plan]=='2')
            {
                
                for_amount_insert_by_orbit_plan2($d_id_fet8[d_id],'40','8');
                $rddd8="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet8[d_id]', '2', '$date', '$time', '40', 'Silver Plan Commission', '8', '$d_id', '');";
                if($con->query($rddd8)===TRUE)
                {
                    
                }
                else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 8');";
                $con->query($df);
                }
            }else{
                
                for_amount_insert_by_orbit_plan2($d_id_fet8[d_id],'20','8');
                $rddd8="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet8[d_id]', '2', '$date', '$time', '20', 'Silver Plan Commission', '8', '$d_id', '');";
                if($con->query($rddd8)===TRUE)
                {
                    
                }
                else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 8');";
                $con->query($df);
                }
                
                $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                $secu_que1=$con->query($secu_sel1);
                $secu_fet1=$secu_que1->fetch_assoc();
                $a_secu_bal1=$secu_fet1[security_bal]+20;
                $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet8[d_id]', '$date', '$time', '20', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Upgraded');";
                $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                if($con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                {
                    
                }else{
                 $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 5 global and security');";
                $con->query($df);
                }
                
            }
            
            /////////////////////////////////level9
            $d_id_sel9="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet8[s_id]'";
            $d_id_que9=$con->query($d_id_sel9);
            $d_id_fet9=$d_id_que9->fetch_assoc();
            if($d_id_fet9[a_status]=='y')
            {
                if(for_finding_direct_id_plan2($d_id_fet9[d_id])>=5)
                {
                    for_amount_insert_by_orbit_plan2($d_id_fet9[d_id],'20','9');
                    $rddd9="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet9[d_id]', '1', '$date', '$time', '20', 'Star Plan Commission', '9', '$d_id', '');";
                    if($con->query($rddd9)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 9');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+10;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '10', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet9[d_id]', 'Not Complete Level 9 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+10;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet9[d_id]', '$date', '$time', '10', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 9 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 5 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            
            /////////////////////////////////level10
            $d_id_sel10="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet9[s_id]'";
            $d_id_que10=$con->query($d_id_sel10);
            $d_id_fet10=$d_id_que10->fetch_assoc();
            //echo "<br>".$d_id_fet10[d_id];
            if($d_id_fet10[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet10[d_id])>=5)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet10[d_id],'20','10');
                    $rddd10="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet10[d_id]', '1', '$date', '$time', '20', 'Star Plan Commission', '10', '$d_id', '');";
                    if($con->query($rddd10)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 10');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+10;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '10', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet10[d_id]', 'Not Complete Level 10 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+10;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet10[d_id]', '$date', '$time', '10', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 10 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 10 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            /////////////////////////////////level11
            $d_id_sel11="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet10[s_id]'";
            $d_id_que11=$con->query($d_id_sel11);
            $d_id_fet11=$d_id_que11->fetch_assoc();
            if($d_id_fet11[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet11[d_id])>=5)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet11[d_id],'20','11');
                    $rddd11="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet11[d_id]', '1', '$date', '$time', '20', 'Star Plan Commission', '11', '$d_id', '');";
                    if($con->query($rddd11)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 11');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+10;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '10', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet11[d_id]', 'Not Complete Level 11 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+10;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet11[d_id]', '$date', '$time', '10', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 11 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 11 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
        }
        else{
            $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'function 1 failed to update');";
                $con->query($df);
        }
    }else{ echo "you dont have pin balance";}
}

function distribute_auto_2_activate_id($d_id)
{
    global $con, $date, $time;
    $d_id_sel="SELECT * FROM `distributor` WHERE `d_id`='$d_id'";
    $d_id_que=$con->query($d_id_sel);
    $d_id_fet=$d_id_que->fetch_assoc();
    $pin_bal=$d_id_fet[upgrade_wallet]-2000.0;
    if($pin_bal>=0)
    {
        $pin_u="UPDATE `distributor` SET `upgrade_wallet` = '$pin_bal' WHERE `distributor`.`d_id` = '$d_id';";
        $usiy="INSERT INTO `upgrade_wallet_history` (`uwh_id`, `d_id`, `date`, `time`, `plan_type`, `level`, `amount`, `b_bal`, `a_bal`, `note`, `type`, `orbit`) VALUES (NULL, '$d_id', '$date', '$time', '2', '', '2000', '$d_id_fet[upgrade_wallet]', '$pin_bal', 'ID Upgarded', '-', '');";
        //$pin_ins="INSERT INTO `pw_history` (`pwh_id`, `d_id`, `pw_type`, `date`, `time`, `pin`, `b_pin`, `a_pin`, `type`, `note`) VALUES (NULL, '$d_id', '2', '$date', '$time', '1', '$d_id_fet[pw_2]', '$pin_bal', '-', 'ID Activation');";
        
        $rtnb="UPDATE `distributor` SET `a_status` = 'y' WHERE `distributor`.`d_id` = '$d_id';";
        $cdd="UPDATE `distributor` SET `a_plan` = '2' WHERE `distributor`.`d_id` = '$d_id';";
        $hidd="INSERT INTO `distributor_upgrade_history` (`duh_id`, `d_id`, `plan_type`, `date`, `time`) VALUES (NULL, '$d_id', '2', '$date', '$time');";
        
        ///////////////////////////////for adding to admin 
        $admin_sel="SELECT * FROM `admin_wallet` WHERE `aw_id`='1'";
        $admin_que=$con->query($admin_sel);
        $admin_fet=$admin_que->fetch_assoc();
        $admin_wallet=$admin_fet[a_wallet]+200;
        $admin_ins="INSERT INTO `admin_wallet_history` (`awh_id`, `date`, `time`, `amount`, `b_amount`, `a_amount`, `d_id`, `of_plan`, `level`, `note`) VALUES (NULL, '$date', '$time', '200', '$admin_fet[a_wallet]', '$admin_wallet', '$d_id', '2', '', 'ID Activated');";
        $admin_up="UPDATE `admin_wallet` SET `a_wallet` = '$admin_wallet' WHERE `admin_wallet`.`aw_id` = 1;";
        ////////////////////////////////////for global
        $glo_sel="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1'";
        $glo_que=$con->query($glo_sel);
        $glo_fet=$glo_que->fetch_assoc();
        $glo_a_bal=$glo_fet[g2]+200;
        $glo_up="UPDATE `global_support_system_bal` SET `g2` = '$glo_a_bal' WHERE `global_support_system_bal`.`gssb_id` = 1;";
        $glo_que="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '2', '$date', '$time', '200', '$glo_fet[g2]', '$glo_a_bal', '+', '$d_id', 'ID Activation', '');";
        
        
        if($con->query($rtnb)===TRUE && $con->query($cdd)===TRUE && $con->query($pin_u)===TRUE && $con->query($usiy)===TRUE && $con->query($hidd)===TRUE && $con->query($admin_ins)===TRUE && $con->query($admin_up)===TRUE && $con->query($glo_up)===TRUE && $con->query($glo_que)===TRUE)
        {
            /////////////////////////////////level1
            $d_id_sel1="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet[s_id]'";
            $d_id_que1=$con->query($d_id_sel1);
            $d_id_fet1=$d_id_que1->fetch_assoc();
            if($d_id_fet1[a_status]=='y')
            {
                if(for_finding_direct_id_plan2($d_id_fet1[d_id])>=1)
                {
                    for_amount_insert_by_orbit_plan2($d_id_fet1[d_id],'200','1');
                    $rddd1="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet1[d_id]', '2', '$date', '$time', '200', 'Silver Plan Commission', '1', '$d_id', '');";
                    if($con->query($rddd1)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 1');";
                    $con->query($df);
                    }
                }else{
                    for_amount_insert_by_orbit_plan2($d_id_fet1[d_id],'100','1');
                    $rddd1="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet1[d_id]', '2', '$date', '$time', '100', 'Silver Plan Commission', '1', '$d_id', 'Not Upgraded Your ID');";
                    if($con->query($rddd1)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 1');";
                    $con->query($df);
                    }
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+100;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet1[d_id]', '$date', '$time', '100', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 1 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 1 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            /////////////////////////////////level2
            $d_id_sel2="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet1[s_id]'";
            $d_id_que2=$con->query($d_id_sel2);
            $d_id_fet2=$d_id_que2->fetch_assoc();
            if($d_id_fet2[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet2[d_id])>=1)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet2[d_id],'800','2');
                    $rddd2="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet2[d_id]', '2', '$date', '$time', '800', 'Silver Plan Commission', '2', '$d_id', '');";
                    if($con->query($rddd2)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 2');";
                    $con->query($df);
                    }
                }else{
                    for_amount_insert_by_orbit_plan2($d_id_fet1[d_id],'400','1');
                    $rddd1="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet1[d_id]', '2', '$date', '$time', '400', 'Silver Plan Commission', '1', '$d_id', 'Not Upgraded Your ID');";
                    if($con->query($rddd1)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 1');";
                    $con->query($df);
                    }
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+400;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet2[d_id]', '$date', '$time', '400', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 2 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 2 global and security');";
                    $con->query($df);
                    }
                    
                }
                
            }
            
            /////////////////////////////////level3
            $d_id_sel3="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet2[s_id]'";
            $d_id_que3=$con->query($d_id_sel3);
            $d_id_fet3=$d_id_que3->fetch_assoc();
            if($d_id_fet3[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet3[d_id])>=2)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet3[d_id],'140','3');
                    $rddd3="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet3[d_id]', '2', '$date', '$time', '140', 'Silver Plan Commission', '3', '$d_id', '');";
                    if($con->query($rddd3)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 3');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g2]+70;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '2', '$date', '$time', '70', '$glov1[g2]', '$a_glob1', '+', '$d_id_fet3[d_id]', 'Not Complete Level 3 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g2` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+70;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet3[d_id]', '$date', '$time', '70', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 3 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 3 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            
            /////////////////////////////////level4
            $d_id_sel4="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet3[s_id]'";
            $d_id_que4=$con->query($d_id_sel4);
            $d_id_fet4=$d_id_que4->fetch_assoc();
            if($d_id_fet4[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet4[d_id])>=2)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet4[d_id],'100','4');
                    $rddd4="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet4[d_id]', '2', '$date', '$time', '100', 'Silver Plan Commission', '4', '$d_id', '');";
                    if($con->query($rddd4)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan2 level 4');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g2]+50;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '2', '$date', '$time', '50', '$glov1[g2]', '$a_glob1', '+', '$d_id_fet4[d_id]', 'Not Complete Level 4 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g2` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+50;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet4[d_id]', '$date', '$time', '50', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 4 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 4 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            
            /////////////////////////////////level5
            $d_id_sel5="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet4[s_id]'";
            $d_id_que5=$con->query($d_id_sel5);
            $d_id_fet5=$d_id_que5->fetch_assoc();
            if($d_id_fet5[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet5[d_id])>=3)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet5[d_id],'80','5');
                    $rddd5="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet5[d_id]', '2', '$date', '$time', '80', 'Silver Plan Commission', '5', '$d_id', '');";
                    if($con->query($rddd5)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 5');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+20;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '20', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet5[d_id]', 'Not Complete Level 5 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+20;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet5[d_id]', '$date', '$time', '20', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 5 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 5 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            
            /////////////////////////////////level6
            $d_id_sel6="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet5[s_id]'";
            $d_id_que6=$con->query($d_id_sel6);
            $d_id_fet6=$d_id_que6->fetch_assoc();
            if($d_id_fet6[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet6[d_id])>=3)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet6[d_id],'30','6');
                    $rddd6="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet6[d_id]', '1', '$date', '$time', '30', 'Star Plan Commission', '6', '$d_id', '');";
                    if($con->query($rddd6)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 6');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+15;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '15', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet6[d_id]', 'Not Complete Level 6 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+15;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet6[d_id]', '$date', '$time', '15', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 6 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 5 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            /////////////////////////////////level7
            $d_id_sel7="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet6[s_id]'";
            $d_id_que7=$con->query($d_id_sel7);
            $d_id_fet7=$d_id_que7->fetch_assoc();
            if($d_id_fet7[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet7[d_id])>=4)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet7[d_id],'30','7');
                    $rddd7="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet7[d_id]', '1', '$date', '$time', '30', 'Star Plan Commission', '7', '$d_id', '');";
                    if($con->query($rddd7)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 7');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+15;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '15', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet7[d_id]', 'Not Complete Level 7 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+15;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet7[d_id]', '$date', '$time', '15', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 7 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 5 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            /////////////////////////////////level8
            $d_id_sel8="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet7[s_id]'";
            $d_id_que8=$con->query($d_id_sel8);
            $d_id_fet8=$d_id_que8->fetch_assoc();
            if($d_id_fet8[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet8[d_id])>=4)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet8[d_id],'20','8');
                    $rddd8="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet8[d_id]', '1', '$date', '$time', '20', 'Star Plan Commission', '8', '$d_id', '');";
                    if($con->query($rddd8)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 8');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+10;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '10', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet8[d_id]', 'Not Complete Level 8 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+10;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet8[d_id]', '$date', '$time', '10', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 8 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 5 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            /////////////////////////////////level9
            $d_id_sel9="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet8[s_id]'";
            $d_id_que9=$con->query($d_id_sel9);
            $d_id_fet9=$d_id_que9->fetch_assoc();
            if($d_id_fet9[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet9[d_id])>=5)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet9[d_id],'20','9');
                    $rddd9="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet9[d_id]', '1', '$date', '$time', '20', 'Star Plan Commission', '9', '$d_id', '');";
                    if($con->query($rddd9)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 9');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+10;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '10', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet9[d_id]', 'Not Complete Level 9 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+10;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet9[d_id]', '$date', '$time', '10', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 9 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 5 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            
            /////////////////////////////////level10
            $d_id_sel10="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet9[s_id]'";
            $d_id_que10=$con->query($d_id_sel10);
            $d_id_fet10=$d_id_que10->fetch_assoc();
            //echo "<br>".$d_id_fet10[d_id];
            if($d_id_fet10[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet10[d_id])>=5)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet10[d_id],'20','10');
                    $rddd10="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet10[d_id]', '1', '$date', '$time', '20', 'Star Plan Commission', '10', '$d_id', '');";
                    if($con->query($rddd10)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 10');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+10;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '10', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet10[d_id]', 'Not Complete Level 10 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+10;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet10[d_id]', '$date', '$time', '10', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 10 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 10 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
            /////////////////////////////////level11
            $d_id_sel11="SELECT * FROM `distributor` WHERE `d_id`='$d_id_fet10[s_id]'";
            $d_id_que11=$con->query($d_id_sel11);
            $d_id_fet11=$d_id_que11->fetch_assoc();
            if($d_id_fet11[a_status]=='y')
            {
                if(for_finding_direct_id_plan1($d_id_fet11[d_id])>=5)
                {
                    for_amount_insert_by_orbit_plan1($d_id_fet11[d_id],'20','11');
                    $rddd11="INSERT INTO `plan_level_income` (`pli_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `note`, `level`, `of_d_id`, `c_note`) VALUES (NULL, '$d_id_fet11[d_id]', '1', '$date', '$time', '20', 'Star Plan Commission', '11', '$d_id', '');";
                    if($con->query($rddd11)===TRUE)
                    {
                        
                    }
                    else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 11');";
                    $con->query($df);
                    }
                }else{
                    $glob_sel1="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1';";
                    $glo_que1=$con->query($glob_sel1);
                    $glov1=$glo_que1->fetch_assoc();
                    $a_glob1=$glov1[g1]+10;
                    $glo1="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '1', '$date', '$time', '10', '$glov1[g1]', '$a_glob1', '+', '$d_id_fet11[d_id]', 'Not Complete Level 11 Direct Condition', '$d_id');";
                    $glo_u1="UPDATE `global_support_system_bal` SET `g1` = '$a_glob1' WHERE `global_support_system_bal`.`gssb_id` = '1';";
                    
                    $secu_sel1="SELECT * FROM `security_system_bal` WHERE `ssb_id`='1';";
                    $secu_que1=$con->query($secu_sel1);
                    $secu_fet1=$secu_que1->fetch_assoc();
                    $a_secu_bal1=$secu_fet1[security_bal]+10;
                    $secu_ins1="INSERT INTO `security_bal_history` (`sbh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '$d_id_fet11[d_id]', '$date', '$time', '10', '$secu_fet1[security_bal]', '$a_secu_bal1', '+', 'Not Complete Level 11 Direct Condition');";
                    $secu_up1="UPDATE `security_system_bal` SET `security_bal` = '$a_secu_bal1' WHERE `security_system_bal`.`ssb_id` = 1;";
                    if($con->query($glo1)===TRUE && $con->query($glo_u1)===TRUE && $con->query($secu_ins1)===TRUE && $con->query($secu_up1)===TRUE)
                    {
                        
                    }else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'plan1 level 11 global and security');";
                    $con->query($df);
                    }
                    
                }
            }
        }
        else{
            $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'function 1 failed to update');";
                $con->query($df);
        }
    }
}
distribute_auto_2_activate_id($_SESSION[d_id])
//echo plan1_amount_distribution('195837','195837','400','1','plan 1');
//distribute_pw_1_activate_id(195837);
//echo for_finding_direct_id_plan1(1);
//for_renewal_income_distribute(281695);
?>