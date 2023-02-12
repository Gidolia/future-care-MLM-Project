<?php include "config.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Future Care</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include "include/sidebar.php";?>
        <!-- top navigation -->
        <?php include "include/header.php";?>
        <!-- /top navigation -->

        <!-- page content -->
        
         
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Withdrawal Wallet</h3>
              </div>
            </div>
<?php
            $sd="SELECT * FROM `distributor` WHERE `d_id`='$_GET[d_id]'";
            $cc=$con->query($sd);
            $xzxx=$cc->fetch_assoc();
            ?>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>ADD/Remove Withdrawal Wallet</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        <h4>Withdrawal Current Wallet = <?php echo $xzxx[withdrawal_wallet]+0;?>/-</h4>
                        
                              
        <table class="table table-striped table-bordered">
            <form method="post">
            <tr>
                <td>ID</td>
                <td>FC<?php echo $_GET[d_id];?> (<?php echo $xzxx[name];?>)<input type="hidden" class="form-control" name="d_id" value="<?php echo $_GET[d_id];?>" required></td>
            </tr>
            <tr>
                <td>Operator</td>
                <td><select name="operator">
                    <option value="add">ADD</option>
                    <option value="remove">remove</option>
                </select></td>
            </tr>
            <tr>
                <td>Amount</td>
                <td><input type="number" name="amount" class="form-control"></td>
            </tr>
            <tr>
                <td>Note</td>
                <td><input type="text" name="note" class="form-control"></td>
            </tr>
            <tr>
                <td></td><td><input type="submit" class="btn btn-success" value="Submit" name="opperaa"></td>
            </tr>
            </form>
            </table>
            
            </div>
            </div>
            </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Withdrawal Wallet Ledger View</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
            <br>
            
        <table class="table table-striped table-bordered" id="datatable">
            <thead><tr><th>Sr. no.</th><th>d_id</th><th>Date / Time</th><th>Type</th><th>Amount</th><th>Note</th></tr></thead>
            <?php
            $a=0;
            $g="SELECT * FROM `withdrawal_wallet_history` WHERE `d_id`='$_GET[d_id]' ORDER BY `withdrawal_wallet_history`.`wwh_id` DESC";
            $dc=$con->query($g);
            while($d=$dc->fetch_assoc())
            { $a++; ?>
            <tr>
                <td><?php echo $a;?></td>
                <td><?php echo $d[d_id];?></td>
                <td><?php echo $d[date];?> / <?php echo $d[time];?></td>
                <td><?php echo $d[type];?></td>
                <td><?php echo $d[amount];?></td>
                 <td><?php echo $d[note];?></td>
            </tr>
            <?php
            }?>
        </table>
        
         <?php
            if(isset($_POST[opperaa]))
            {
                if($_POST[operator]=="add")
                {
                $sa="SELECT * FROM `distributor` WHERE `d_id`='$_POST[d_id]'";
                $xx=$con->query($sa);
                
                $fet=$xx->fetch_assoc();
                
                
                    $wallet=$fet[withdrawal_wallet]+$_POST[amount];
                    $r="UPDATE `distributor` SET `withdrawal_wallet` = '$wallet' WHERE `distributor`.`d_id` = '$_POST[d_id]';";
                    $r .="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$_POST[d_id]', '$date', '$time', '$_POST[amount]', '', '$wallet', '+', '$_POST[note]', '');";
                    
               
                if($con->multi_query($r)===TRUE)
                {
                	echo "<script>alert('Amount Distributed Successfully');
		location.href='add_remove_withdrawal_wallet.php?d_id=$_POST[d_id]';</script>";
                }
                else{
                    $fail="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '', 'admin', '$url', 'Add Remove Withdrawal Wallet');";
                
    	        $con->query($fail);
    	        echo "<script>alert('Failed ! Plz contact Your Developer');
		location.href='add_remove_withdrawal_wallet.php?d_id=$_POST[d_id]';</script>";
                }
                }
                elseif($_POST[operator]=="remove")
                {
                $sa="SELECT * FROM `distributor` WHERE `d_id`='$_POST[d_id]'";
                $xx=$con->query($sa);
                
                $fet=$xx->fetch_assoc();
                
                
                    $wallet=$fet[withdrawal_wallet]-$_POST[amount];
                    $r="UPDATE `distributor` SET `withdrawal_wallet` = '$wallet' WHERE `distributor`.`d_id` = '$_POST[d_id]';";
                    $r .="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`) VALUES (NULL, '$_POST[d_id]', '$date', '$time', '$_POST[amount]', '', '$wallet', '-', '$_POST[note]', '');";
                    
                    
               
                if($con->multi_query($r)===TRUE)
                {
                	echo "<script>alert('Amount Distributed Successfully');
		location.href='add_remove_withdrawal_wallet.php?d_id=$_POST[d_id]';</script>";
                }
                else{
                    $fail="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '', 'admin', '$url', 'Add Remove Withdrawal Wallet');";
                
    	        $con->query($fail);
    	        echo "<script>alert('Failed ! Plz contact Your Developer');
		location.href='add_remove_withdrawal_wallet.php?d_id=$_POST[d_id]';</script>";
                }
                }
            }
            ?>
                    
                    
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

<!-- footer content -->
        <footer>
          <div class="pull-right">
            <?php include "include/footer.php";?>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>
