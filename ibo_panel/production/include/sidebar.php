            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>FUTURE CARE</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $d_detail[name];?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="index.php"><i class="fa fa-home"></i> Home </a>
                  </li>
                  <li><a><i class="fa fa-edit"></i> My Network <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="level1.php">Level View</a></li>
                      <li><a href="tree.php">Tree View</a></li>
                      <li><a href="network_list.php">Downline List</a></li>
                    </ul>
                  </li>
                  
                </ul>
              </div>
              <div class="menu_section">
                <h3>Profile</h3>
                <ul class="nav side-menu">
                  <li><a href="upgrade_id.php"><i class="fa fa-home"></i> Upgrade ID</a>
                  </li>
                  <li><a><i class="fa fa-bank"></i>PIN Desk<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="pin_wallet.php?pin_type=1">Pin Wallet</a></li>
                        <li><a href="transfer_pin.php">Transfer Pin</a></li>
                        <li><a href="pin_ledger.php">PIN Ledger View</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bank"></i>Withdrawal Wallet<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="withdrawal_wallet_transfer.php">Fund Transfer</a></li>
                        <li><a href="withdrawal_request_history.php">Withdrawal Request</a></li>
                        <li><a href="withdraw_wallet2_ledger.php">Withdrawal Wallet Ledger View</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bug"></i>Plan Income<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="level_income.php?pin_type=1">Level Income</a></li>
                      <li><a href="global_income.php?pin_type=1">Global Income</a></li>
                      <li><a href="id_renewal_income.php?pin_type=1">Renewal ID Income</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bug"></i> My Profile <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="profile_edit.php">Update Profile</a></li>
                      <li><a href="kyc.php">KYC</a></li>
                      <li><a href="pass_change.php">Change Password</a></li>
                      
                    </ul>
                  </li>
                  
                                
    
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login/">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>