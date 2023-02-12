<?php
include "config.php";
include "functions.php";
if(isset($_POST[accept]))
{
                      $ref="SELECT * FROM `activate_id_pin` WHERE `aip_id`='$_POST[aip_id]'";
                      $df=$con->query($ref);
                      $d=$df->fetch_assoc();
  
    if(distribute_level_income($d_id, $amount, $aip_id)=="Success")
    {
        $rd="UPDATE `activate_id_pin` SET `plot_no` = '$_POST[plot_no]' WHERE `activate_id_pin`.`aip_id` = '$_POST[aip_id]';";
        
        $rf="UPDATE `activate_id_pin` SET `project_name` = '$_POST[project_name]' WHERE `activate_id_pin`.`aip_id` = '$_POST[aip_id]';";
        
        $gh="INSERT INTO `plot_details_history` (`pdh_id`, `aip_id`, `d_id`, `amount`, `b_amount`, `a_amount`, `date`, `time`) VALUES (NULL, '$_POST[aip_id]', '$d[d_id]', '$d[pin_type]', '0', '$d[pin_type]', '$date', '$time');";
        if($con->query($rd)===TRUE && $con->query($rf)===TRUE && $con->query($gh)===TRUE)
        {
            echo "success";
        }
        else{
            echo "fail";
        }
    }
    else{
        echo "already Cleared";
    }
}


?>