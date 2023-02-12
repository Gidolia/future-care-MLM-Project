
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

    <title>Future Care || Wallet Request History</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <link href="extra.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            
            <?php include "include/sidebar.php";?>
            
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <?php include "include/header.php";?>
        <!-- /top navigation -->


        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Withdrawal Wallet Request</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
            <div class="col-md-6 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Request Withdraw</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     &nbsp;&nbsp;&nbsp;Note :: 5% Txn Charge will be applied when you withdraw amount on your bank account.
                    <form class="form-horizontal form-label-left" method="post">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">My Wallet Balance</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          
                          <?php echo $d_detail[withdrawal_wallet]+0;?>
                        </div>
                      </div>  
                      
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Amount</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="number" class="form-control" name="amount" min="1000" max="<?php echo $d_detail[withdrawal_wallet]+0;?>" required>
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                          <input type="submit" class="btn btn-success" value="Withdraw Request" name="withdraw_request">
                        </div>
                      </div>
                     </form>

                    </div>
                  </div>
                </div>
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Withdrawal Request History</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        
                              <?php
                             
        $g="SELECT * FROM `withdrawal_request` WHERE `d_id`='$_SESSION[d_id]'";
        $dc=$con->query($g);
        ?>
        <table class="table table-striped table-bordered table-responsive" id="datatable">
            <thead><tr><th>Sr. no.</th><th>Date/Time</th><th>Amount</th><th>TXN Charge 5%</th><th>Net Amount</th><th>Status</th><th>Clear Date</th><th>TXN ID</th></tr></thead>
            <?php
            $a=0;
            $t1=0;
            $t2=0;
            while($d=$dc->fetch_assoc())
            { $a++; 
           
            ?>
            <tr>
                <td><?php echo $a;?></td>
                <td><?php echo $d[r_date]." / ".$d[r_time];?></td>
                
                
                <td><?php echo $d[amount];?></td>
                <td><?php echo $d[txn_charge];?></td>
                <th><?php echo $d[net_amount];?></th>
                <td>
                   <?php if($d[status]=="p"){
                   ?><button class="btn btn-warning">Pending</button>
                   <?php }
                   elseif($d[status]=="r"){?>
                       <button class="btn btn-danger">Rejected</button>
                  <?php }
                   else{?>
                   <button class="btn btn-success">Completed</button>
                   <?php } ?>
                </td>
                <td><?php echo $d[c_date];?></td>
                <td><?php echo $d[txn_id];?></td>
            </tr>
            <?php
            }?>
        </table>
                  </div>
                </div>
              </div>
                
                
            </div>
            </div>
<?php
if(isset($_POST[withdraw_request]))
{
    if($_POST[amount]>1000)
    {
        $wallet=$d_detail[withdrawal_wallet]-$_POST[amount];
        if($wallet>=0){
            $lm="INSERT INTO `withdrawal_wallet_history` (`wwh_id`, `d_id`, `date`, `time`, `amount`, `b_bal`, `a_bal`, `type`, `note`, `plan_type`, `from_d_id`, `to_d_id`) VALUES (NULL, '$_SESSION[d_id]', '$date', '$time', '$_POST[amount]', '$d_detail[withdrawal_wallet]', '$wallet', '-', 'Withdrawal', '', '', '');";
            $up="UPDATE `distributor` SET `withdrawal_wallet` = '$wallet' WHERE `distributor`.`d_id` = '$_SESSION[d_id]';";
            $txn_charge=$_POST[amount]*5/100;
            $net_amt=$_POST[amount]-$txn_charge;
            
            $sd="INSERT INTO `withdrawal_request` (`wr_id`, `d_id`, `amount`, `r_date`, `r_time`, `status`, `c_date`, `c_time`, `txn_id`, `txn_charge`, `net_amount`) VALUES (NULL, '$_SESSION[d_id]', '$_POST[amount]', '$date', '$time', 'p', '', '', '', '$txn_charge', '$net_amt');";
            if($con->query($up)===TRUE && $con->query($lm)===TRUE && $con->query($sd)===TRUE)
            {
                 echo "<script>alert('Success! Your Withdrawal Requested Successfully'); location.href='withdrawal_request_history.php';</script>";
            }
        }else{
             echo "<script>alert('You Dont Have ballance'); location.href='withdrawal_request_history.php';</script>";
        }
    }
    else{
        echo "<script>alert('Amount Should be greater then 1000/-'); location.href='withdrawal_request_history.php';</script>";
    }
}
?>       
            
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include "include/footer.php";?>
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
    
    
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>
