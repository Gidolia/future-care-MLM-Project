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

    <title>Future Care || Network List</title>

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
        <?php include "include/sidebar.php";?>
        <!-- top navigation -->
        <?php include "include/header.php";?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Distributor LIST</h3>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Distributor List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     
                     <table  id="datatable-buttons" class="table table-striped table-bordered jambo_table" >
                      <thead>
                        <tr>
                            <th>sr no</th>
                          <th>ID</th>
                          <th>Name</th>
                          <th>S ID</th>
                          <th>mobile</th>
                          <th>password</th>
                          <th>date/time</th>
                          <th>Withdrawal</th>
                          <th>Status</th>
                          <th>A Date/Time</th>
                          <th>Delete ID</th>
                       
                          
                        </tr>
                      </thead>


                      <tbody>
                        <?php 
                                $au=1;
                                $e="SELECT * FROM `distributor`";
                                $d=$con->query($e);
                                while($R=$d->fetch_assoc()){ 
                                    
                        ?>
                                    <tr>
                                        <td <?php if($R[block_status]=='Y'){?>
                                        bgcolor="red"
                                        <?php }?>
                                        > <?php echo $au; ?></td>
                                <td>
                                   FC<?php echo $R["d_id"]; ?>
                                </td>
                                <td>
                                  <a href="d_detail.php?d_id=<?php echo $R['d_id'];?>">  <?php echo $R['name'];?></a>
                                </td>
                                <td>
                                    FC<?php echo $R["s_id"]; ?>
                                </td>
                                <td>
                                    <?php echo $R["mobile"]; ?>
                                </td>
                                <td>
                                    <?php echo $R["password"]; ?>
                                </td>
                                <td><?php echo $R["r_date"]." / ". $R["r_time"]; ?></td>
                                <td><?php echo $R["withdrawal_wallet"]; ?></td>
                                
                                
                                
                                
                                <td><?php switch ($R['a_plan']) {
                                      case "1":?>
                                      <button type="button" class="btn btn-success">Star</button>
                                        <?php 
                                        break;
                                      case "2":
                                        ?>
                                      <button type="button" class="btn btn-success">Silver</button>
                                        <?php 
                                        break;
                                      case "3":
                                        ?>
                                      <button type="button" class="btn btn-success">Gold</button>
                                        <?php 
                                        break;
                                      case "4":
                                        ?>
                                      <button type="button" class="btn btn-success">Diamond</button>
                                        <?php 
                                        break;
                                      case "5":
                                        ?>
                                      <button type="button" class="btn btn-success">Platinum</button>
                                        <?php 
                                        break;    
                                      case "6":
                                        ?>
                                      <button type="button" class="btn btn-success">Pearl</button>
                                        <?php 
                                        break;
                                      case "7":
                                        ?>
                                      <button type="button" class="btn btn-success">Emerald</button>
                                        <?php 
                                        break;
                                      default:?>
                                        <button type="button" class="btn btn-danger">Not Active</button><?php
                                    }?> 
                                    
                                   </td>
                                   <td>
                                       <?php
                                       $dd=$con->query("SELECT * FROM `pw_history` WHERE `d_id`='$R[d_id]' AND `pw_type`='1' AND `type`='-' AND `note`='ID Activation'");
                                        $rval=$dd->fetch_assoc();
                                       echo $rval['date'] ." / " ;
                                       echo $rval['time']  ;
                                       ?>
                                   </td>
                                   <td>
                                       <form method="post">
                                       <input type="hidden" name="d_id" value="<?php echo $R['d_id']; ?>">
                                       <input type="submit" name="delet" class="btn btn-danger" value="Delete ID">
                                       </form>
                                   </td>
                                 
                                </tr>
                                <?php $au++;     
                                } 
                                
                                ?>
                      </tbody>
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
    
<?php
if(isset($_POST[delet]))
{
    $sdf= "DELETE FROM `distributor` WHERE `distributor`.`d_id` = '$_POST[d_id]'";
    if($con->query($sdf)===TRUE)
    {
        echo "<script>alert('ID Deleted Successfully'); location.href='network_list.php';</script>";
    }
    else{
        echo "<script>alert('Failed! Plz Try Again'); location.href='network_list.php';</script>";
    }
}
?>
   
  </body>
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
	
</html>
