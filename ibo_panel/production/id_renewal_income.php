
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

    <title>Future Care || Renewal Income</title>

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
                <h3>Renewed ID Income</h3>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Your Renew Income </h2>
                  
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 
                      <script> function urlHandler(value) {                               
    window.location.assign(`${value}`);
}</script>
                    <form method="post" class="form-horizontal form-label-left" action="confirm_generate_pin.php">
                    <div class="form-group">
                    <?php    switch ($_GET[pin_type]) {
  case "1":
    $a="selected";
    break;
  case "2":
     $b="selected";
    break;
  case "3":
     $c="selected";
    break;
    case "4":
     $d="selected";
    break;
    case "5":
     $e="selected";
    break;
    case "6":
     $f="selected";
    break;
    case "7":
     $g="selected";
    break;
    case "8":
     $h="selected";
    break;
    case "9":
     $i="selected";
    break;
    case "10":
     $j="selected";
    break;
    case "11":
     $k="selected";
    break;
 
}?>
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Select Pin Type</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <select class="form-control" id="url" onchange="urlHandler(this.value)">
                        <option value="id_renewal_income.php?pin_type=1" <?php echo $a;?>>Star</option>
                        <option value="id_renewal_income.php?pin_type=2" <?php echo $b;?>>Silver</option>
                        <option value="id_renewal_income.php?pin_type=3" <?php echo $c;?>>Gold</option>
                        <option value="id_renewal_income.php?pin_type=4" <?php echo $d;?>>Diamond</option>
                        <option value="id_renewal_income.php?pin_type=5" <?php echo $e;?>>Platinum</option>
                        <option value="id_renewal_income.php?pin_type=6" <?php echo $f;?>>Pearl</option>
                        <option value="id_renewal_income.php?pin_type=7" <?php echo $g;?> >Emerald</option>
                        <option value="id_renewal_income.php?pin_type=8" <?php echo $h;?>>Ruby</option>
                        <option value="id_renewal_income.php?pin_type=9" <?php echo $i;?>>Saphire</option>
                        <option value="id_renewal_income.php?pin_type=10" <?php echo $j;?>>Crown</option>
                        <option value="id_renewal_income.php?pin_type=11" <?php echo $k;?>>Legend</option>
                    </select>
                          </span>
                        </div>
                      </div>
                    
                </form>
            <br>
        <table class="table table-striped table-bordered jambo_table"  id="datatable">
            <thead><tr class="headings"><th>Sr. no.</th><th>Date / Time</th><th>Amount</th><th>Of ID</th><th>Level</th></tr></thead>
            <?php
            $a=0;
            $g="SELECT * FROM `renewal_wallet_history` WHERE `d_id`='$_SESSION[d_id]' AND `plan_type`='$_GET[pin_type]' AND `type`='+'";
            $dc=$con->query($g);
            while($d=$dc->fetch_assoc())
            { $a++; 
            ?>
            <tr>
                <td><?php echo $a;?></td>
                <td><?php echo $d[date]." / ".$d[time];?></td>
                
                <th><?php echo $d[amount];?></th>
                <td>FC<?php echo $d[of_d_id];?></td>
                <td><?php echo $d[level];?></td>
               
            </tr>
            <?php
            }?>
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
