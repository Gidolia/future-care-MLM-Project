<?php
include "config.php";

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
    
    if($dis_fet[a_plan]>='2')
    {
        if($plan_in_fet[plan2]<=12000)
        {
            $planspp=$plan_in_fet[plan2]+$amount;
            if($planspp<=12000)
            {
                $ww_bal=$dis_fet[withdrawal_wallet]+$amount;
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'Global 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$amount', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Global 2', '2');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($ww_ins)===TRUE && $con->query($ww_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '1');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>12000)
            {
                $extra_bal=$planspp-12000;
                $ww_com=$amount-$extra_bal;
                $upg_bal=$dis_fet[upgrade_wallet]+$extra_bal;
                /////////////////
                $upg_ins="INSERT INTO `upgrade_wallet_history` (`uwh_id`, `d_id`, `date`, `time`, `plan_type`, `level`, `amount`, `b_bal`, `a_bal`, `note`, `type`, `orbit`) VALUES (NULL, '$d_id', '$date', '$time', 'Global 2000rs', '$level', '$extra_bal', '$dis_fet[upgrade_wallet]', '$upg_bal', 'For Upgrading', '+', '$plan_in_fet[o2]');";
                $upg_up="UPDATE `distributor` SET `upgrade_wallet` = '$upg_bal' WHERE `distributor`.`d_id` = '$d_id';";
                ////////////////////
                $ww_bal=$dis_fet[withdrawal_wallet]+$ww_com;
                
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'Global 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[orbit]');";
                /////////////////////////////////////
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$ww_com', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Global 2', '2');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                if($con->query($upg_ins)===TRUE && $con->query($upg_up)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($ww_ins)===TRUE && $con->query($ww_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '2');";
                    $con->query($df);
                }
                
            }
        }
        elseif($plan_in_fet[plan2]>12000 && $plan_in_fet[plan2]<=16000)
        {
            $planspp=$plan_in_fet[plan2]+$amount;
            if($planspp<=16000)
            {
                //////////////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'Global 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                ///////////////////////////////////////
                $upg_bal=$dis_fet[upgrade_wallet]+$amount;
                $upg_ins="INSERT INTO `upgrade_wallet_history` (`uwh_id`, `d_id`, `date`, `time`, `plan_type`, `level`, `amount`, `b_bal`, `a_bal`, `note`, `type`, `orbit`) VALUES (NULL, '$d_id', '$date', '$time', 'Global 2000rs', '$level', '$amount', '$dis_fet[upgrade_wallet]', '$upg_bal', 'For Upgrading', '+', '$plan_in_fet[o2]');";
                $upg_up="UPDATE `distributor` SET `upgrade_wallet` = '$upg_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($upg_ins)===TRUE && $con->query($upg_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '3');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>16000)
            {
                $extra_bal=$planspp-16000;
                $upg_com=$amount-$extra_bal;
                $upg_bal=$dis_fet[upgrade_wallet]+$upg_com;
                ////////////////////////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'Global 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[orbit]');";
                ///////////////////////////////////////////////////
                $upg_ins="INSERT INTO `upgrade_wallet_history` (`uwh_id`, `d_id`, `date`, `time`, `plan_type`, `level`, `amount`, `b_bal`, `a_bal`, `note`, `type`, `orbit`) VALUES (NULL, '$d_id', '$date', '$time', 'Global 2000rs', '$level', '$upg_com', '$dis_fet[upgrade_wallet]', '$upg_bal', 'For Upgrading', '+', '$plan_in_fet[orbit]');";
                $upg_up="UPDATE `distributor` SET `upgrade_wallet` = '$upg_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                ///////////for reserve_fund
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf1]+$extra_bal;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`) VALUES (NULL, '1', '$d_id', '$date', '$time', '$extra_bal', '$rf_fet[rf1]', '$rf_a_bal', '+', 'Global 2000rs');";
                $rf_up="UPDATE `reserve_fund` SET `rf1` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                
                
                if($con->query($upg_ins)===TRUE && $con->query($upg_up)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '4');";
                    $con->query($df);
                }
                
            }
        
        }
        elseif($plan_in_fet[plan2]>16000 && $plan_in_fet[plan2]<=18000)
        {
            $planspp=$plan_in_fet[plan2]+$amount;
            if($planspp<=18000)
            {
                //////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'Global 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                
                ///////////for reserve_fund
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf1]+$amount;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `orbit`) VALUES (NULL, '1', '$d_id', '$date', '$time', '$amount', '$rf_fet[rf1]', '$rf_a_bal', '+', 'Global 2000rs', '$plan_in_fet[o2]');";
                $rf_up="UPDATE `reserve_fund` SET `rf1` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '5');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>18000)
            {
                $extra_bal=$planspp-18000;
                $rf_com=$amount-$extra_bal;
                
                //////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'Global 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                
                
                ///////////for reserve_fund`    
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf1]+$rf_com;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `orbit`) VALUES (NULL, '1', '$d_id', '$date', '$time', '$rf_com', '$rf_fet[rf1]', '$rf_a_bal', '+', 'Global 2000rs', '$plan_in_fet[o2]');";
                $rf_up="UPDATE `reserve_fund` SET `rf1` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                
                ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$extra_bal;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$extra_bal', '$dis_fet[renewal_wallet]', '$renewal_bal', 'Global 2000rs', '$plan_in_fet[o2]', '+');";
                $renewal_up="UPDATE `distributor` SET `renewal_wallet` = '$renewal_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                
                if($con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($renwal_ins)===TRUE && $con->query($renewal_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '6');";
                    $con->query($df);
                }
                
            }
        
        }
        elseif($plan_in_fet[plan2]>18000 && $plan_in_fet[plan2]<=20000)
        {
            $planspp=$plan_in_fet[plan2]+$amount;
            if($planspp<=20000)
            {
                //////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'Global 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                
                 ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$amount;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$dis_fet[renewal_wallet]', '$renewal_bal', 'Global 2000rs', '$plan_in_fet[o2]', '+');";
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
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$b_amount', '$plan_in_fet[plan2]', '$b_plan', '+', 'Global 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                
                
                ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$b_amount;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$b_amount', '$dis_fet[renewal_wallet]', '$renewal_bal', 'Global 2000rs', '$plan_in_fet[o2]', '+');";
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
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$extra_bal', '0', '$extra_bal', '+', 'Global 2000rs', '', '$d_id', 'y', '$level', '$orbit');";
                $ww_bal=$dis_fet[withdrawal_wallet]+$extra_bal;
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$extra_bal', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Global 2', '1');";
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
    elseif($dis_fet[a_plan]>'1')
    {
        if($plan_in_fet[plan2]<=16000)
        {
            $planspp=$plan_in_fet[plan2]+$amount;
            if($planspp<=16000)
            {
                $ww_bal=$dis_fet[withdrawal_wallet]+$amount;
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'Global 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$amount', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Global 2', '1');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($ww_ins)===TRUE && $con->query($ww_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '10');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>16000)
            {
                $extra_bal=$planspp-16000;
                $ww_com=$amount-$extra_bal;
                
                ///////////for reserve_fund
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf1]+$extra_bal;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `orbit`) VALUES (NULL, '1', '$d_id', '$date', '$time', '$extra_bal', '$rf_fet[rf1]', '$rf_a_bal', '+', 'Commission', '$plan_in_fet[o2]');";
                $rf_up="UPDATE `reserve_fund` SET `rf1` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                ////////////////////
                $ww_bal=$dis_fet[withdrawal_wallet]+$ww_com;
                
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'Global 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[orbit]');";
                /////////////////////////////////////
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$ww_com', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Global 2', '1');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                if($con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($ww_ins)===TRUE && $con->query($ww_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '11');";
                    $con->query($df);
                }
                
            }
        }
        elseif($plan_in_fet[plan2]>16000 && $plan_in_fet[plan2]<=18000)
        {
            $planspp=$plan_in_fet[plan2]+$amount;
            if($planspp<=18000)
            {
                //////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'Global 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                
                ///////////for reserve_fund
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf1]+$amount;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `orbit`) VALUES (NULL, '1', '$d_id', '$date', '$time', '$amount', '$rf_fet[rf1]', '$rf_a_bal', '+', 'Commission', '$plan_in_fet[o2]');";
                $rf_up="UPDATE `reserve_fund` SET `rf1` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '12');";
                    $con->query($df);
                }
                
            }
            elseif($planspp>18000)
            {
                $extra_bal=$planspp-18000;
                $rf_com=$amount-$extra_bal;
                
                //////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'Global 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                
                
                ///////////for reserve_fund
                $rf_sel="SELECT * FROM `reserve_fund` WHERE `rf_id`='1';";
                $rf_que=$con->query($rf_sel);
                $rf_fet=$rf_que->fetch_assoc();
                $rf_a_bal=$rf_fet[rf1]+$rf_com;
                $rf_ins="INSERT INTO `reserve_fund_history` (`rfh_id`, `rf_type`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `orbit`) VALUES (NULL, '1', '$d_id', '$date', '$time', '$rf_com', '$rf_fet[rf1]', '$rf_a_bal', '+', 'Commission', '$plan_in_fet[o2]');";
                $rf_up="UPDATE `reserve_fund` SET `rf1` = '$rf_a_bal' WHERE `reserve_fund`.`rf_id` = 1;";
                
                ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$extra_bal;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$extra_bal', '$dis_fet[renewal_wallet]', '$renewal_bal', 'commission', '$plan_in_fet[o2]', '+');";
                $renewal_up="UPDATE `distributor` SET `renewal_wallet` = '$renewal_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                
                if($con->query($rf_ins)===TRUE && $con->query($rf_up)===TRUE && $con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($renwal_ins)===TRUE && $con->query($renewal_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '13');";
                    $con->query($df);
                }
                
            }
        
        }
        elseif($plan_in_fet[plan2]>18000 && $plan_in_fet[plan2]<=20000)
        {
            $planspp=$plan_in_fet[plan2]+$amount;
            if($planspp<=20000)
            {
                //////////////////////////////
                $plan_in_t="UPDATE `plan_income_manage` SET `plan2` = '$planspp' WHERE `plan_income_manage`.`d_id` = '$d_id';";
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$plan_in_fet[plan2]', '$planspp', '+', 'Global 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                
                 ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$amount;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$amount', '$dis_fet[renewal_wallet]', '$renewal_bal', 'commission', '$plan_in_fet[o2]', '+');";
                $renewal_up="UPDATE `distributor` SET `renewal_wallet` = '$renewal_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($renwal_ins)===TRUE && $con->query($renewal_up)===TRUE)
                {}
                else{
                     $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '14');";
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
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$b_amount', '$plan_in_fet[plan2]', '$b_plan', '+', 'Global 2000rs', '', '$d_id', 'y', '$level', '$plan_in_fet[o2]');";
                
                
                ////////////////////////for renewal fund
                $renewal_bal=$dis_fet[renewal_wallet]+$b_amount;
                $renwal_ins="INSERT INTO `renewal_wallet_history` (`rwh_id`, `d_id`, `plan_type`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `note`, `orbit`, `type`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$b_amount', '$dis_fet[renewal_wallet]', '$renewal_bal', 'commission', '$plan_in_fet[o2]', '+');";
                $renewal_up="UPDATE `distributor` SET `renewal_wallet` = '$renewal_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                
                if($con->query($plan_in_t)===TRUE && $con->query($plan_iv_h)===TRUE && $con->query($renwal_ins)===TRUE && $con->query($renewal_up)===TRUE)
                {}
                else{
                    $df="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', '15');";
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
            
                $plan_iv_h="INSERT INTO `plan_income_manage_history` (`pimh_id`, `d_id`, `plan_no`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `note`, `com_note`, `of_d_id`, `commission`, `level`, `orbit`) VALUES (NULL, '$d_id', '2', '$date', '$time', '$extra_bal', '0', '$extra_bal', '+', 'Global 2000rs', '', '$d_id', 'y', '$level', '$orbit');";
                $ww_bal=$dis_fet[withdrawal_wallet]+$extra_bal;
                $ww_ins="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$d_id', '$date', '$time', '$extra_bal', '$dis_fet[withdrawal_wallet]', '$ww_bal', '+', 'Global 2', '1');";
                $ww_up="UPDATE `distributor` SET `withdrawal_wallet` = '$ww_bal' WHERE `distributor`.`d_id` = '$d_id';";
                
                $orbit_up="UPDATE `plan_income_manage` SET `o2` = '$orbit' WHERE `plan_income_manage`.`d_id` = '$d_id';";
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



$s_glo="SELECT * FROM `global_support_system_bal` WHERE `gssb_id`='1'";
$q_glo=$con->query($s_glo);
$glo_bal_fet=$q_glo->fetch_assoc();
//echo $glo_bal_fet[g2];
if($glo_bal_fet[g2]>0){
    $sel="SELECT * FROM `distributor` WHERE `a_plan`>='2' AND `global_status`='y';";
    $fvb=$con->query($sel);
    $b_count=$fvb->num_rows;
    echo $b_count."Total person<br>";
    $per_member_amount=$glo_bal_fet[g2]/$b_count;
    echo $per_member_amount."per person amount";
    while($fds=$fvb->fetch_assoc())
    {
        for_amount_insert_by_orbit_plan2($fds[d_id],$per_member_amount,'0');
        echo $fds[d_id]."<br>";
      /*  $wallet=$fds[withdrawal_wallet]+$per_member_amount;
        $rfe="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`, `global_type`) VALUES (NULL, '$fds[d_id]', '$date', '$time', '$per_member_amount', '$fds[withdrawal_wallet]', '$wallet', '+', 'Global 2', '', '', '', '1');";
        $rfd="UPDATE `distributor` SET `withdrawal_wallet` = '$wallet' WHERE `distributor`.`d_id` = '$fds[d_id]';";
        
        
        
        if($con->query($rfe)===TRUE && $con->query($rfd)===TRUE){
            echo "<br>Success ".$fds[d_id];
        }
        else{
            echo "<br>Failed ".$fds[d_id];
        }*/
    }
    $glo_up="UPDATE `global_support_system_bal` SET `g2` = '0' WHERE `global_support_system_bal`.`gssb_id` = 1;";
    $glo_ent="INSERT INTO `global_bal_history` (`gbh_id`, `global_type`, `date`, `time`, `bal`, `b_bal`, `a_bal`, `type`, `d_id`, `note`, `s_note`) VALUES (NULL, '2', '$date', '$time', '$glo_bal_fet[g2]', '$glo_bal_fet[g2]', '0', '-', '', 'Daily Distributed', '');";
    $gbl="INSERT INTO `global_income_distributed` (`gid_id`, `g_type`, `d_id`, `date`, `time`, `amount`, `note`, `no_person`, `per_member_amount`) VALUES (NULL, '2', '', '$date', '$time', '$glo_bal_fet[g2]', '', '$b_count', '$per_member_amount');";
    if($con->query($glo_up)===TRUE && $con->query($glo_ent)===TRUE && $con->query($gbl)===TRUE){
            echo "<br>Success ".$fds[d_id];
        }
        else{
            echo "<br>Failed ".$fds[d_id];
        }
        
    $selw="SELECT * FROM `distributor` WHERE `a_plan`='2'";
    $fvbw=$con->query($selw);
    //echo $per_member_amount;
    while($fdsw=$fvbw->fetch_assoc())
    {
        
        $rfdw="UPDATE `distributor` SET `global_status` = 'y' WHERE `distributor`.`d_id` = '$fdsw[d_id]';";
        if($con->query($rfdw)===TRUE){
           
        }
        
    }echo "<script>alert('Success! Global Income distributed'); location.href='index.php';</script>";
}else{
    echo "<script>alert('No Global Amount Available'); location.href='index.php';</script>";
}


?>