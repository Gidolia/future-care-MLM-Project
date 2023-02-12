
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

    <title>Index || Future Care </title>

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
        
            
            <h2 style="text-align: left;background-color:#6DE9FF;"><marquee><span class="" style="color: rgb(230, 21, 28);"><strong>Welcome To Future Care</strong></span></marquee></h2>

          
          <br />
            <div class="row">
              <div class="col-md-6 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Dashboard <small>Basic Information</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <table class="table">
                        <tr>
                            <th>ID</th><td><?php echo $_SESSION[d_id];?></td>
                        </tr>
                        <tr><th>Name</th><td><?php echo $d_detail[name];?></td></tr>
                        <tr><th>Active Plan</th><td><?php 
                        switch ($d_detail[a_plan]) {
                          case "1":
                            echo "<button type='button' class='btn btn-round btn-success'>Star</button>";
                            break;
                          case "2":
                            echo "<button type='button' class='btn btn-round btn-success'>Silver</button>";
                            break;
                          case "3":
                            echo "<button type='button' class='btn btn-round btn-success'>Gold</button>";
                            break;
                          default:
                            echo "<button type='button' class='btn btn-round btn-danger'>Not Active</button>";
                        }
                        ?></td></tr>
                        <tr><th>Renewed ID</th><td><?php echo $d_detail[renewed_id];?></td></tr>
                        <tr><th>Your Joining Link</th><td>
                            <?php if($d_detail[a_status]=="y"){?>
                            <input type="text" value="https://futurecare.co.in/ibo_panel/production/login/registration.php?d_id=<?php echo $_SESSION[d_id];?>" id="myInput">
<button onclick="myFunction()">Copy Joining Link</button><?php }
else{echo "You can not refer Any one First Activate Your ID";}
?>

</td></tr>
                        <tr>
                            <th>Application</th><td><a href="app-debug.apk"><button type='button' class='btn btn-round btn-success'>Download Application</button></a></td>
                        </tr>
                    </table>
                    <script>
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);
  
  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
</script>
                  </div>
                </div>
              </div>
            </div>
            
            
    
                  
      <h3>Basic Information</h3>            
   <div class="dash-tiles row">               
                  
        <!-- Column 1 of Row 1 -->
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <!-- Total Users Tile -->
            <div class="dash-tile dash-tile-logfe clearfix animation-pullDown">
                <div class="dash-tile-header">
                    Withdrawal Wallet
                </div>
                <div class="dash-tile-icon">
                    <img src="0d3b35c1-4fe1-4806-9bcd-5638ef94328b.jpg" class="img-circle" height="50px" width="100%">
                </div>
                <div class="dash-tile-text">
                    <?php echo $d_detail[withdrawal_wallet];?>
                </div>
            </div>
        </div>
            <!-- END Total Users Tile -->
            <!-- Total Profit Tile -->
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="dash-tile dash-tile-ocean clearfix animation-pullDown">
                <div class="dash-tile-header">
                    Upgrade Fund
                </div>
                <div class="dash-tile-icon">
                    <img src="0d3b35c1-4fe1-4806-9bcd-5638ef94328b.jpg" class="img-circle" height="50px" width="100%">
                </div>
                <div class="dash-tile-text">
                    <?php
                    
                    echo $d_detail['upgrade_wallet'];
                    
                    ?>
                                 
                    </div>
            </div>
            <!-- END Total Tickets Tile -->
        </div>
       
        <!-- Column 2 of Row 1 -->
       
    </div>
        <h3>Star Plan Income</h3>            
        <div class="dash-tiles row">
            <!--Star Global Income-->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="dash-tile dash-tile-flower clearfix animation-pullDown">
                    <div class="dash-tile-header">
                       Star Global Income
                    </div>
                    <div class="dash-tile-icon">
                        <img src="0d3b35c1-4fe1-4806-9bcd-5638ef94328b.jpg" class="img-circle" height="50px" width="100%">
                    </div>
                    <div class="dash-tile-text">
                        
                        
                        <?php
                        $seswssssdsl="SELECT * FROM `withdrawal_wallet_history` WHERE `d_id`='$_SESSION[d_id]' AND `note`='Global 1'";
                        $sda=$con->query($seswssssdsl);
                        while($global_fet=$sda->fetch_assoc())
                        {
                            $glo_to=$glo_to+$global_fet[amount];
                        }
                        
                        $vfdvfddfbvg="SELECT * FROM `upgrade_wallet_history` WHERE `d_id`='$_SESSION[d_id]' AND `plan_type`='Global 1000rs'";
                        $sdae=$con->query($vfdvfddfbvg);
                        while($global_fete=$sdae->fetch_assoc())
                        {
                            $glo_to=$glo_to+$global_fete[amount];
                        }
                        $vfdvfddfbvg="SELECT * FROM `reserve_fund_history` WHERE `d_id`='$_SESSION[d_id]' AND `note`='Global 1000rs'";
                        $sdae=$con->query($vfdvfddfbvg);
                        while($global_fete=$sdae->fetch_assoc())
                        {
                            $glo_to=$glo_to+$global_fete[amount];
                        }
                        $vfdvfddfbvg="SELECT * FROM `renewal_wallet_history` WHERE `d_id`='$_SESSION[d_id]' AND `note`='Global 1000rs'";
                        $sdae=$con->query($vfdvfddfbvg);
                        while($global_fete=$sdae->fetch_assoc())
                        {
                            $glo_to=$glo_to+$global_fete[amount];
                        }
                        
                        $totsp=$glo_to;
                        echo $glo_to;
                        $tot=$tot+$glo_to;
                        ?>
                                     
                        </div>
                </div>
                <!-- END Total Tickets Tile -->
            </div>
            
            <!--Star Level Income-->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <!-- Total Sales Tile -->
                <div class="dash-tile dash-tile-ocean clearfix animation-pullDown">
                    <div class="dash-tile-header">
                        Star Level Income
                    </div>
                    <div class="dash-tile-icon">
                        <img src="0d3b35c1-4fe1-4806-9bcd-5638ef94328b.jpg" class="img-circle" height="50px" width="100%">
                    </div>
                    <div class="dash-tile-text">
                      <?php
                      $sta_to=0;
                        $seswssssdsl="SELECT * FROM `plan_level_income` WHERE `d_id`='$_SESSION[d_id]' AND `note`='Star Plan Commission'";
                        $sda=$con->query($seswssssdsl);
                        while($sta_fet=$sda->fetch_assoc())
                        {
                            $sta_to=$sta_to+$sta_fet[amount];
                        }
                        echo $sta_to;
                        $totsp=$totsp+$sta_to;
                        $tot=$tot+$sta_to;
                        ?>                  
                    </div>
                </div>
            </div>
            
            <!--Star Reserve Fund Given-->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <!-- Total Sales Tile -->
                <div class="dash-tile dash-tile-ocean clearfix animation-pullDown">
                    <div class="dash-tile-header">
                       Star  Reserve Fund Given
                    </div>
                    <div class="dash-tile-icon">
                        <img src="0d3b35c1-4fe1-4806-9bcd-5638ef94328b.jpg" class="img-circle" height="50px" width="100%">
                    </div>
                    <div class="dash-tile-text">
                      <?php
                      $sta_tow=0;
                        $seswssssdslw="SELECT * FROM `reserve_fund_history` WHERE `d_id`='$_SESSION[d_id]' AND `rf_type`='1'";
                        $sdaw=$con->query($seswssssdslw);
                        while($sta_fetw=$sdaw->fetch_assoc())
                        {
                            $sta_tow=$sta_tow+$sta_fetw[amount];
                        }
                        echo $sta_tow;
                        //$tot=$tot+$sta_tow;
                        ?>                  
                    </div>
                </div>
            </div>
            
            <!--Star Renewal Fund-->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="dash-tile dash-tile-ocean clearfix animation-pullDown">
                    <div class="dash-tile-header">
                        Star Renewal Fund
                    </div>
                    <div class="dash-tile-icon">
                        <img src="0d3b35c1-4fe1-4806-9bcd-5638ef94328b.jpg" class="img-circle" height="50px" width="100%">
                    </div>
                    <div class="dash-tile-text">
                        
                        
                        <?php
                        
                        $vfdvfddfbvgq="SELECT * FROM `renewal_wallet_history` WHERE `d_id`='$_SESSION[d_id]' AND `type`='+'";
                        $sdaeq=$con->query($vfdvfddfbvgq);
                        while($ren_fete=$sdaeq->fetch_assoc())
                        {
                            $ren_to=$ren_to+$ren_fete[amount];
                        }
                        echo '0';
                        ?>
                                     
                        </div>
                </div>
                <!-- END Total Tickets Tile -->
            </div>
            
            <!--Security Income-->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <!-- Total Sales Tile -->
                <div class="dash-tile dash-tile-balloon clearfix animation-pullDown">
                    <div class="dash-tile-header">
                        Security Income
                    </div>
                    <div class="dash-tile-icon">
                        <img src="0d3b35c1-4fe1-4806-9bcd-5638ef94328b.jpg" class="img-circle" height="50px" width="100%">
                    </div>
                    <div class="dash-tile-text">
                        <?php
                        
                        $vfdvfddfbvgqc="SELECT * FROM `withdrawal_wallet_history` WHERE `d_id`='$_SESSION[d_id]' AND `note`='Security'";
                        $sdaeqc=$con->query($vfdvfddfbvgqc);
                        while($ren_fetec=$sdaeqc->fetch_assoc())
                        {
                            $ren_toc=$ren_toc+$ren_fetec[amount];
                        }
                        echo $ren_toc;
                        ?></div>
                </div>
            </div>
            
            <!--Total Star Income-->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <!-- Total Sales Tile -->
                <div class="dash-tile dash-tile-logfe clearfix animation-pullDown">
                    <div class="dash-tile-header">
                        Total Star Income
                    </div>
                    <div class="dash-tile-icon">
                        <img src="0d3b35c1-4fe1-4806-9bcd-5638ef94328b.jpg" class="img-circle" height="50px" width="100%">
                    </div>
                    <div class="dash-tile-text">
                      <?php
                      
                      //echo intval($totsp);
                     echo intval($totsp) + $ren_toc;
                        
                        ?>                  
                    </div>
                </div>
            </div>
         
        
        </div>
        
        
        <h3>Silver Plan Income</h3>            
        <div class="dash-tiles row">
        
        <!--Silver Global Income-->
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="dash-tile dash-tile-flower clearfix animation-pullDown">
                <div class="dash-tile-header">
                    Silver Global Income 
                </div>
                <div class="dash-tile-icon">
                    <img src="0d3b35c1-4fe1-4806-9bcd-5638ef94328b.jpg" class="img-circle" height="50px" width="100%">
                </div>
                <div class="dash-tile-text">
                    
                    
                    <?php
                    $seswssssdsl="SELECT * FROM `withdrawal_wallet_history` WHERE `d_id`='$_SESSION[d_id]' AND `note`='Global 2'";
                    $sda=$con->query($seswssssdsl);
                    while($global_fet=$sda->fetch_assoc())
                    {
                        $glo_to2=$glo_to2+$global_fet[amount];
                    }
                    
                    $vfdvfddfbvg="SELECT * FROM `upgrade_wallet_history` WHERE `d_id`='$_SESSION[d_id]' AND `plan_type`='Global 2000rs'";
                    $sdae=$con->query($vfdvfddfbvg);
                    while($global_fete=$sdae->fetch_assoc())
                    {
                        $glo_to2=$glo_to2+$global_fete[amount];
                    }
                    $vfdvfddfbvg="SELECT * FROM `reserve_fund_history` WHERE `d_id`='$_SESSION[d_id]' AND `note`='Global 2000rs'";
                    $sdae=$con->query($vfdvfddfbvg);
                    while($global_fete=$sdae->fetch_assoc())
                    {
                        $glo_to2=$glo_to2+$global_fete[amount];
                    }
                    $vfdvfddfbvg="SELECT * FROM `renewal_wallet_history` WHERE `d_id`='$_SESSION[d_id]' AND `note`='Global 2000rs'";
                    $sdae=$con->query($vfdvfddfbvg);
                    while($global_fete=$sdae->fetch_assoc())
                    {
                        $glo_to2=$glo_to2+$global_fete[amount];
                    }
                    
                    
                    echo $glo_to2;
                    $totrp=$glo_to2;
                    $tot=$tot+$glo_to2;
                    ?>
                                 
                    </div>
            </div>
            <!-- END Total Tickets Tile -->
        </div>
        
        <!--Silver Level Income-->
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <!-- Total Sales Tile -->
            <div class="dash-tile dash-tile-ocean clearfix animation-pullDown">
                <div class="dash-tile-header">
                    Silver Level Income
                </div>
                <div class="dash-tile-icon">
                    <img src="0d3b35c1-4fe1-4806-9bcd-5638ef94328b.jpg" class="img-circle" height="50px" width="100%">
                </div>
                <div class="dash-tile-text">
                  <?php
                  $sta_to=0;
                    $seswssssdsl="SELECT * FROM `plan_level_income` WHERE `d_id`='$_SESSION[d_id]' AND `note`='Silver Plan Commission'";
                    $sda=$con->query($seswssssdsl);
                    while($sta_fet=$sda->fetch_assoc())
                    {
                        $sta_to=$sta_to+$sta_fet[amount];
                    }
                    echo intval($sta_to);
                    $totrp=$totrp+intval($sta_to);
                    $tot=$tot+$sta_to;
                    ?>                  
                </div>
            </div>
        </div>
        
        <!--Silver Reserve Fund Given-->
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <!-- Total Sales Tile -->
            <div class="dash-tile dash-tile-ocean clearfix animation-pullDown">
                <div class="dash-tile-header">
                    Silver Reserve Fund Given 
                </div>
                <div class="dash-tile-icon">
                    <img src="0d3b35c1-4fe1-4806-9bcd-5638ef94328b.jpg" class="img-circle" height="50px" width="100%">
                </div>
                <div class="dash-tile-text">
                  <?php
                  $sta_tow=0;
                    $seswssssdslw="SELECT * FROM `reserve_fund_history` WHERE `d_id`='$_SESSION[d_id]' AND `rf_type`='2'";
                    $sdaw=$con->query($seswssssdslw);
                    while($sta_fetw=$sdaw->fetch_assoc())
                    {
                        $sta_tow=$sta_tow+$sta_fetw[amount];
                    }
                    echo intval($sta_tow);
                    //$tot=$tot+$sta_tow;
                    ?>                  
                </div>
            </div>
        </div>
        
        <!--Silver Renewal Fund-->
         <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="dash-tile dash-tile-ocean clearfix animation-pullDown">
                <div class="dash-tile-header">
                    Silver Renewal Fund
                </div>
                <div class="dash-tile-icon">
                    <img src="0d3b35c1-4fe1-4806-9bcd-5638ef94328b.jpg" class="img-circle" height="50px" width="100%">
                </div>
                <div class="dash-tile-text">
                    
                    
                    <?php
                    
                    $vfdvfddfbvgq="SELECT * FROM `renewal_wallet_history` WHERE `d_id`='$_SESSION[d_id]' AND `type`='+'";
                    $sdaeq=$con->query($vfdvfddfbvgq);
                    while($ren_fete=$sdaeq->fetch_assoc())
                    {
                        $ren_to=$ren_to+$ren_fete[amount];
                    }
                    echo '0';
                    ?>
                                 
                    </div>
            </div>
            <!-- END Total Tickets Tile -->
        </div>
        
        <!--Total Silver Incoem-->
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <!-- Total Sales Tile -->
            <div class="dash-tile dash-tile-logfe clearfix animation-pullDown">
                <div class="dash-tile-header">
                    Total Silver Income
                </div>
                <div class="dash-tile-icon">
                    <img src="0d3b35c1-4fe1-4806-9bcd-5638ef94328b.jpg" class="img-circle" height="50px" width="100%">
                </div>
                <div class="dash-tile-text">
                  <?php
                  
                    echo $totrp;
                    
                    ?>                  
                </div>
            </div>
        </div>
        
        </div>
        
        
        <h3>Total</h3>
        <div class="dash-tiles row">
            
        <!--Total Income-->
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <!-- Total Sales Tile -->
            <div class="dash-tile dash-tile-dark clearfix animation-pullDown">
                <div class="dash-tile-header">
                    TOTAL INCOME
                </div>
                <div class="dash-tile-icon">
                    <img src="0d3b35c1-4fe1-4806-9bcd-5638ef94328b.jpg" class="img-circle" height="50px" width="100%">
                </div>
                <div class="dash-tile-text">
                  <?php
                    //   Total Star income + total silver income
                    echo intval($tot) + $ren_toc;
                    
                    // echo intval($totsp) + $ren_toc;
                    
                    ?>                  
                </div>
            </div>
        </div>
        
        <div class="clearfix">
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
