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
                <h3>distributor Detail</h3>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>distributor Detail</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     
                     <table class="table table-striped table-bordered">
                          <?php 
                            
                                $e="SELECT * FROM `distributor` WHERE `d_id`='$_GET[d_id]'";
                                $d=$con->query($e);
                              
                                $R=mysqli_fetch_assoc($d); ?>
                          
                <tr><th>ID No.</th><td><?php echo $R["d_id"]; ?></td></tr>
                <tr><th>Sponser ID</th><td><?php echo $R["s_id"]; ?></td></tr>
                <tr><th>Name</th><td><?php echo $R["name"]; ?></td></tr>
                <tr><th>Mobile</th><td><?php echo $R["mobile"]; ?></td></tr>
                
                <tr><th>D.O.B</th><td><?php echo $R["dob"]; ?></td></tr>
                <tr><th>Addreass</th><td><?php echo $R["addreass"]; ?></td></tr>
                <tr><th>City, State</th><td><?php echo $R["city"].", ".$R["state"]; ?></td></tr>
                <tr><th>Pancard No.</th><td><?php echo $R["pancard_no"]; ?></td></tr>
                <tr><th>Adhar Card No.</th><td><?php echo $R["adhar_card_no"]; ?></td></tr>
                <tr><th>Registration Date/time</th><td><?php echo $R['r_date']." / ".$R['r_time']; ?></td></tr>
                <tr><th>Active Status (date/time)</th><td><?php  if($R[a_status]=='y')
                                        { ?> </a> <?php echo "<button type='button' class='btn btn-success'>Active</button>"; }
                                    else {?> <button type="button" class="btn btn-danger">Not Active</button> 
                                    <?php    
                                    } 
                                    echo " ".$R['a_date']." / ".$R['a_time'];
                                    ?></td></tr>
                
                <tr><th>Withdrawal Wallet</th><td><?php echo $R['withdrawal_wallet']+0; ?> &nbsp;&nbsp;<a href="add_remove_withdrawal_wallet.php?d_id=<?php echo $R['d_id']; ?>">Add/Remove</a></td></tr>
                <tr><th>Pin Wallet 50000Rs</th><td><?php echo $R['pin_wallet']+0; ?> &nbsp;&nbsp;<a href="add_remove_pin.php?d_id=<?php echo $R['d_id']; ?>">Add/Remove</a></td></tr>
                
                          
                    </table>
                    
                    <br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                    <h2>ID Block / Unblock </h2>
                     <?php 
                    
                                if($R[block_status]!='N')
                                {?>
                                <form action="process_id_deactivate.php" method="get">
                                    <input type="hidden" name="d_id" value="<?php echo $R[d_id];?>">
                                    <input type="text" name="b_note">
                                    
                                    <input type="submit" name="status" class='btn btn-danger' value="deactivate">
                                </form>
                                <?php }
                                else{ ?> 
                                <form action="process_id_deactivate.php" method="get">
                                    <input type="hidden" name="d_id" value="<?php echo $R[d_id];?>">
                                    <input type="text" name="b_note">
                                    <input type="submit" name="status" class='btn btn-success' value="activate">
                                </form>
                                <?php }
                                ?>
                                <a href="block_reason_list.php?d_id=<?php echo $R[d_id];?>">Block History</a>
                                <br>&nbsp;<br>&nbsp;<br>&nbsp;
                                <h2>Edit Distributor Profile </h2>
                    <a href="process_edit_profile.php?d_id=<?php echo $R[d_id];?>"><button type='button' class='btn btn-success'>Edit </button></a>


                    <br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                    <h2>Aadhar Pan Bank Details</h2>
                    
                    <table id="datatable" class="table table-striped table-bordered">
                        
                    <?php $a="SELECT * FROM `kyc_adhar` WHERE `d_id`='$_GET[d_id]' and `status`='c'";
                          $s=$con->query($a);
                          $d=mysqli_fetch_assoc($s)?> 
                        <tr>
                            <th>Aadhar</th>
                            <td><?php if($s->num_rows==0){ echo "The Associate KYC has not been approved";} 
                                else{?> <a href="../../../ibo_panel/production/adhar_card_img/<?php echo $_GET[d_id];?>f.jpg"  target="_blank">Click here to view adhar card front image</a><br><a href="../../../ibo_panel/production/adhar_card_img/<?php echo $_GET[d_id];?>b.jpg"  target="_blank">Click here to view adhar card back image</a><?php } ?></td>
                                
                          <td><?php if($s->num_rows!=0){ ?><a href="kyc_adhar.php?d_id=<?php echo $R[d_id];?>"><button type='button' class='btn btn-danger'>Reject</button></a><?php } ?></td>
                          
                          
                          
                        </tr>
                        <?php $b="SELECT * FROM `kyc_pan` WHERE `d_id`='$_GET[d_id]' and `status`='c'";
                          $t=$con->query($b);
                          $e=mysqli_fetch_assoc($t)?>
                        <tr>
                            <th>Pan</th>
                            <td><?php if($t->num_rows==0){ echo "The Associate KYC has not been approved";} 
                                else{?> <a href="../../../ibo_panel/production/pan_card_img/<?php echo $_GET[d_id];?>.jpg"  target="_blank">Click here to view adhar card front image</a><?php } ?></td>
                          <td><?php if($t->num_rows!=0){ ?><a href="kyc_pan.php?d_id=<?php echo $R[d_id];?>"><button type='button' class='btn btn-danger'>Reject</button></a><?php } ?></td>
                        </tr>
                        <?php $c="SELECT * FROM `kyc_bank` WHERE `d_id`='$_GET[d_id]' and `status`='c'";
                          $u=$con->query($c);
                          $f=mysqli_fetch_assoc($u)?>
                        <tr>
                            <th>Bank</th>
                            <td><?php if($u->num_rows==0){ echo "The Associate KYC has not been approved";} 
                                else{?> <a href="../../../ibo_panel/production/bank_img/<?php echo $_GET[d_id];?>.jpg" target="_blank">Click here to view Bank Passbook image</a><?php } ?></td>
                          <td><?php if($u->num_rows!=0){ ?><a href="kyc_bank.php?d_id=<?php echo $R[d_id];?>"><button type='button' class='btn btn-danger'>Reject</button></a><?php } ?></td>
                        </tr>
                     </table>  
                  
                    
                  
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
