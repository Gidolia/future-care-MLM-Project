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

    <title>Future Care || Upgrade ID</title>

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
     <!-- Datatables -->
    
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
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
                <h3>Upgrade ID</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Upgrade ID</h2>
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
                  
           <table class="table table-bordered">
               <tr>
                   <th>Current Plan</th>
                   <th>Upgrade Plan</th>
               </tr>
               <tr>
                   <td>
                       <?php
                       switch ($d_detail[a_plan]) {
                          case "1":
                            echo "Plan 1,000/-";
                            break;
                          case "2":
                            echo "Plan 2,000/-";
                            break;
                          case "3":
                            echo "Plan 4,000/-";
                            break;
                          case "4":
                            echo "Plan 8,000/-";
                            break;
                          case "5":
                            echo "Plan 16,000/-";
                            break;
                          case "6":
                            echo "Plan 32,000/-";
                            break;
                          case "7":
                            echo "Plan 64,000/-";
                            break;
                          case "8":
                            echo "Plan 1,28,000/-";
                            break;
                          case "9":
                            echo "Plan 2,56,000/-";
                            break;
                          case "10":
                            echo "Plan 5,12,000/-";
                            break;
                          case "11":
                            echo "Plan 10,24,000/-";
                            break;
                          default:
                            echo "You Don't have any Active Plan";
                        }
                       ?>
                   </td>
                   <td>
                       
                       <?php
                       switch ($d_detail[a_plan]) {
                          case "1":
                            if($d_detail[pw_2]>0)
                              {
                            echo "<a href='process_upgrade.php?plan=2' class='btn btn-success'>Activate ID 2,000/- Plan</a>";
                              }else{ echo "<a href='process_upgrade.php?plan=2' class='btn btn-success' onclick='return false;'>Activate ID 2,000/- Plan</a>";
                                  echo "<p style='color:red;'>You Don't have Pin to Upgrade</p>";
                              }
                            break;
                          case "2":
                            if($d_detail[pw_3]>0)
                              {
                            echo "<a href='process_upgrade.php?plan=3' class='btn btn-success'>Activate ID 4,000/- Plan</a>";
                              }else{ echo "<a href='process_upgrade.php?plan=3' class='btn btn-success' onclick='return false;'>Activate ID 4,000/- Plan</a>";
                                  echo "<p style='color:red;'>You Don't have Pin to Upgrade</p>";
                              }
                            break;
                          case "3":
                             if($d_detail[pw_4]>0)
                              {
                            echo "<a href='process_upgrade.php?plan=4' class='btn btn-success'>Activate ID 8,000/- Plan</a>";
                              }else{ echo "<a href='process_upgrade.php?plan=4' class='btn btn-success' onclick='return false;'>Activate ID 8,000/- Plan</a>";
                                  echo "<p style='color:red;'>You Don't have Pin to Upgrade</p>";
                              } 
                            
                            break;
                          case "4":
                              if($d_detail[pw_5]>0)
                              {
                            echo "<a href='process_upgrade.php?plan=5' class='btn btn-success'>Activate ID 16,000/- Plan</a>";
                              }else{ echo "<a href='process_upgrade.php?plan=5' class='btn btn-success' onclick='return false;'>Activate ID 16,000/- Plan</a>";
                                  echo "<p style='color:red;'>You Don't have Pin to Upgrade</p>";
                              }
                            
                            break;
                          case "5":
                              if($d_detail[pw_6]>0)
                              {
                            echo "<a href='process_upgrade.php?plan=6' class='btn btn-success'>Activate ID 32,000/- Plan</a>";
                              }else{ echo "<a href='process_upgrade.php?plan=6' class='btn btn-success' onclick='return false;'>Activate ID 32,000/- Plan</a>";
                                  echo "<p style='color:red;'>You Don't have Pin to Upgrade</p>";
                              }
                            
                            break;
                          case "6":
                              if($d_detail[pw_7]>0)
                              {
                            echo "<a href='process_upgrade.php?plan=7' class='btn btn-success'>Activate ID 64,000/- Plan</a>";
                              }else{ echo "<a href='process_upgrade.php?plan=7' class='btn btn-success' onclick='return false;'>Activate ID 64,000/- Plan</a>";
                                  echo "<p style='color:red;'>You Don't have Pin to Upgrade</p>";
                              }
                            break;
                          case "7":
                              if($d_detail[pw_8]>0)
                              {
                            echo "<a href='process_upgrade.php?plan=8' class='btn btn-success'>Activate ID 1,28,000/- Plan</a>";
                              }else{ echo "<a href='process_upgrade.php?plan=8' class='btn btn-success' onclick='return false;'>Activate ID 1,28,000/- Plan</a>";
                                  echo "<p style='color:red;'>You Don't have Pin to Upgrade</p>";
                              }
                            
                            break;
                          case "8":
                              if($d_detail[pw_9]>0)
                              {
                              echo "<a href='process_upgrade.php?plan=9' class='btn btn-success'>Activate ID 2,56,000/- Plan</a>";
                              }else{ echo "<a href='process_upgrade.php?plan=9' class='btn btn-success' onclick='return false;'>Activate ID 2,56,000/- Plan</a>";
                                  echo "<p style='color:red;'>You Don't have Pin to Upgrade</p>";
                              }
                            
                            break;
                          case "9":
                              if($d_detail[pw_10]>0)
                              {
                              echo "<a href='process_upgrade.php?plan=10' class='btn btn-success'>Activate ID 5,12,000/- Plan</a>";
                              }else{ echo "<a href='process_upgrade.php?plan=10' class='btn btn-success' onclick='return false;'>Activate ID 5,12,000/- Plan</a>";
                                  echo "<p style='color:red;'>You Don't have Pin to Upgrade</p>";
                              }
                            
                            break;
                          case "10":
                              if($d_detail[pw_11]>0)
                              {
                              echo "<a href='process_upgrade.php?plan=11' class='btn btn-success'>Activate ID 10,24,000/- Plan</a>";
                              }else{ echo "<a href='process_upgrade.php?plan=11' class='btn btn-success' onclick='return false;'>Activate ID 10,24,000/- Plan</a>";
                                  echo "<p style='color:red;'>You Don't have Pin to Upgrade</p>";
                              }
                            
                            break;
                          case "11":
                            echo "<a href='#' class='btn btn-warning'>MAX</a>";
                            break;
                          default:
                              if($d_detail[pw_1]>0)
                              {
                            echo "<a href='process_upgrade.php?plan=1' class='btn btn-success'>Activate ID 1,000/- Plan</a>";
                              }else{ echo "<a href='process_upgrade.php?plan=1' class='btn btn-success' onclick='return false;'>Activate ID 1,000/- Plan</a>";
                                  echo "<p style='color:red;'>You Don't have Pin to Upgrade</p>";
                              }
                        }
                       ?>
                   </td>
               </tr>
           </table>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>History Of Upgrade ID</h2>
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
                  
           <table class="table table-striped table-bordered">
               <tr>
                   <th>Sr. No.</th>
                   <th>Date / Time</th>
                   <th>Plan</th>
                   
               </tr>
               
                   <?php 
                   $a=0;
                   $yh="SELECT * FROM `distributor_upgrade_history` WHERE `d_id`='$_SESSION[d_id]'";
                   $fg=$con->query($yh);
                   while($cv=$fg->fetch_assoc())
                   {
                       $a++;
                   ?>
                <tr>
                   <td><?php echo $a;?></td>
                   <td><?php echo $cv[date]." / ".$cv[time];?></td>
                   <td><?php echo $cv[plan_type];?></td>
               </tr>
               <?php }?>
           </table>
                    
                    
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>
