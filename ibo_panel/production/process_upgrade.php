<?php
include "config.php";
switch ($_GET[plan]) {
      case "1":
        $a=distribute_pw_1_activate_id($_SESSION['d_id']);
        echo "plan1";
        break;
      case "2":
        $a=distribute_pw_2_activate_id($_SESSION['d_id']);
        echo "plan2";
        break;
      case "3":
        $a=distribute_pw_3_activate_id($_SESSION['d_id']);
        echo "plan3";
        break;
      case "4":
        $a=distribute_pw_4_activate_id($_SESSION['d_id']);
        echo "plan4";
        break;
      case "5":
        $a=distribute_pw_5_activate_id($_SESSION['d_id']);
        echo "plan5";
        break;
      case "6":
        $a=distribute_pw_6_activate_id($_SESSION['d_id']);
        echo "plan6";
        break;
      case "7":
        $a=distribute_pw_7_activate_id($_SESSION['d_id']);
        echo "plan7";
        break;
      case "8":
        $a=distribute_pw_8_activate_id($_SESSION['d_id']);
        echo "plan8";
        break;
      case "9":
        $a=distribute_pw_9_activate_id($_SESSION['d_id']);
        echo "plan9";
        break;
      case "10":
        $a=distribute_pw_10_activate_id($_SESSION['d_id']);
        echo "plan10";
        break;
      case "11":
        $a=distribute_pw_11_activate_id($_SESSION['d_id']);
        echo "plan11";
        break;
      default:
        echo "some thing went wrong";
    }
    echo "<script>alert('Success!');
    		location.href='upgrade_id.php';</script>";
?>


