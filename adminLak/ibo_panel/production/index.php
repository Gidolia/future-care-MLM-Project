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
          <!-- top tiles -->
          <?php 
                
                $e="SELECT * FROM `global_support_system_bal`";
                $d=$con->query($e);
               $R=$d->fetch_assoc();
               ////////////
                 $rfte="SELECT * FROM `security_system_bal`";
                $tet=$con->query($rfte);
               $p=$tet->fetch_assoc();
               ///////////////////
               $rftes="SELECT * FROM `reserve_fund`";
                $tets=$con->query($rftes);
               $ps=$tets->fetch_assoc();
            ?>                    
          <div class="row tile_count">
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <a href="reserved_fund_history.php?reversed_history=1">
                <div class="tile-stats">
                  
                  <div class="count"><i class="fa fa-user"></i> <?php echo $ps[rf1]+0;?> </div>
                  <h3>Reserve Fund 1</h3>
                </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <a href="global_history.php?global_history=1">
                <div class="tile-stats">
                  
                  <div class="count"><i class="fa fa-user"></i> <?php echo $ps[rf2]+0;?> </div>
                  <h3>Reserve Fund 2</h3>
                </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <a href="global_history.php?global_history=1">
                <div class="tile-stats">
                  
                  <div class="count"><i class="fa fa-user"></i> <?php echo $R[g1];?> </div>
                  <h3>Global system 1</h3>
                </div>
                </a>
              </div>
            
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                 <a href="global_history.php?global_history=2">
                <div class="tile-stats">
                  
                 <div class="count"><i class="fa fa-user"></i> <?php echo $R[g2];?></div>
                  <h3>Global system 2</h3>
                  
                </div>
                </a>
              </div>
        
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                 <a href="global_history.php?global_history=3">
                <div class="tile-stats">
                  
                 <div class="count"><i class="fa fa-user"></i> <?php echo $R[g3];?></div>
                  <h3>Global system 3</h3>
                  
                </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                   <a href="global_history.php?global_history=4">
                <div class="tile-stats">
                  
                 <div class="count"><i class="fa fa-user"></i> <?php echo $R[g4];?> </div>
                  <h3>Global system 4</h3>
                  
                </div></a>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                   <a href="global_history.php?global_history=5">
                <div class="tile-stats">
                  
                 <div class="count"><i class="fa fa-user"></i> <?php echo $R[g5];?></div>
                  <h3>Global system 5</h3>
                  
                </div></a>
              </div>
               <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6"> <a href="global_history.php?global_history=6">
                <div class="tile-stats">
                  
                 <div class="count"><i class="fa fa-user"></i> <?php echo $R[g6];?></div>
                  <h3>Global system 6</h3>
                  
                </div></a>
              </div>
               <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6"> <a href="global_history.php?global_history=7">
                <div class="tile-stats">
                  
                  <div class="count"><i class="fa fa-user"></i> <?php echo $R[g7];?> </div>
                  <h3>Global system 7</h3>
                </div></a>
              </div>
            
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                 <a href="global_history.php?global_history=8">
                <div class="tile-stats">
                  
                 <div class="count"><i class="fa fa-user"></i> <?php echo $R[g8];?> </div>
                  <h3>Global system 8</h3>
                  
                </div></a>
              </div>
        
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                 <a href="global_history.php?global_history=9">
                <div class="tile-stats">
                  
                 <div class="count"><i class="fa fa-user"></i> <?php echo $R[g9];?></div>
                  <h3>Global system 9</h3>
                  
                </div></a>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                   <a href="global_history.php?global_history=10">
                <div class="tile-stats">
                  
                 <div class="count"><i class="fa fa-user"></i> <?php echo $R[g10];?></div>
                  <h3>Global system 10</h3>
                  
                </div></a>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                   <a href="global_history.php?global_history=11">
                <div class="tile-stats">
                  
                 <div class="count"><i class="fa fa-user"></i> <?php echo $R[g11];?></div>
                  <h3>Global system 11</h3>
                  
                </div></a>
              </div>
             
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                   <a href="security_history.php?sb_id=1">
                <div class="tile-stats">
                  
                 <div class="count"><i class="fa fa-user"></i> <?php echo $p[security_bal];?></div>
                  <h3>Security Balance</h3>
                  
                </div></a>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                   <a href="security_history.php?sb_id=1">
                <div class="tile-stats">
                  
                <a href="process_distribute_global_income.php"><button class="btn btn-success">Distribute Global Income 1</button></a>
                  
                </div></a>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                   <a href="security_history.php?sb_id=1">
                <div class="tile-stats">
                  
                <a href="process_distribute global2.php"><button class="btn btn-success">Distribute Global Income 2</button></a>
                  
                </div></a>
              </div>
              
              
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                   <a href="security_history.php?sb_id=1">
                <div class="tile-stats">
                  
                <a href="process_distribute_security_income.php"><button class="btn btn-success">Security Income</button></a>
                  
                </div></a>
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
