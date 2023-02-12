
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

    <title>Future Care </title>

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
                <h5>Transfer to Other Merchandiser Withdrawal Wallet</h5>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="tile-stats">
                  
                  <div class="count"><i class="fa fa-money"></i> <?php echo $d_detail[withdrawal_wallet]+0;?> </div>
                  <h3>Withdrawal Wallet</h3>
                </div>
              </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Transfer Wallet</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form action="confirm_transfer_wallet.php" method="post">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>To ID</th>
                    <td><input type="text" name="to_d_id" class="form-control " required></td>
                </tr>
                <tr>
                    <th>Amount To Transfer</th>
                    <td><input type="number" min="500" max="<?php echo $d_detail[withdrawal_wallet]+0;?>" name="amount" class="form-control " required></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" name="transfer_amount"></td>
                </tr>
            </table>
            </form>
            </div>
            </div>
            </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Transfer History</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
            <br>
        <table class="table table-striped table-bordered" value ="<h2>Withdrawl history</h2>" id="datatable">
            <thead><tr><th>Sr. no.</th><th>Date / Time</th><th>Amount</th><th>From ID</th><th>To ID</th></tr></thead>
            <tbody>
            <?php
            $a=0;
            $g="SELECT * FROM `withdrawal_wallet_history` WHERE `d_id`='$_SESSION[d_id]' AND `note`='transfered'";
            $dc=$con->query($g);
            while($d=$dc->fetch_assoc())
            { $a++; ?>
            <tr>
                <td><?php echo $a;?></td>
                <td><?php echo $d[date]." / ".$d[time];?></td>
                <th><?php echo $d[amount];?></th>
                <td><?php if($d[from_d_id]!=""){?> DS<?php  echo $d[from_d_id];}?></td>
                <td><?php if($d[to_d_id]!=""){?> DS<?php echo $d[to_d_id];}?></td>
            </tr>
            <?php
            }?></tbody>
        </table>
                  </div>
                </div>
              </div>
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
