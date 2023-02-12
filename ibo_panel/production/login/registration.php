<?php
include "../../../database_connect.php";
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>SIGN UP || Future Care</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <!-- //Meta tag Keywords -->
    <link href="//fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="all">
    
    <script>
  
    function validateForm() {
 	var ser_name = document.forms["myForm"]["s_name"].value;
	var password = document.forms["myForm"]["password"].value;
	var c_password = document.forms["myForm"]["c_password"].value;
	var mobile_no = document.forms["myForm"]["mobile_ck"].value;
	if(mobile_no=="This Mobile Number is Already Register")
	{
	    document.getElementById("text_mob").innerHTML = " This Mobile Number is Already Register ";
    return false;
	}
	if(mobile_no=="Please Check Your Mobile Number")
	{
	    document.getElementById("text_mob").innerHTML = " Please Check Your Mobile Number ";
    return false;
	}
	  if (password != c_password)
		  {
    document.getElementById("cp_msg").innerHTML = " Confirm Password didnt matched to password ";
    return false;
		  }
		  
	
	if(ser_name == "")
		{
			document.getElementById("upline_msg").innerHTML = " Please Check Upline no. ";
			return false;
		}
	if(ser_name == "Please check your upline number")
		{
			document.getElementById("upline_msg").innerHTML = " Please Check Upline no. ";
			return false;
		}
}
  
        function showHint(str) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").value = this.responseText;
    		 // document.getElementById("txtg").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "get_name.php?q=" + str, true);
        xmlhttp.send();
      
        }
        
        function showHint_mob(str) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint_mob").value = this.responseText;
                if(this.responseText != "Correct")
        				{
        					document.getElementById("text_mob").innerHTML = this.responseText;
        				}
        		else{ document.getElementById("text_mob").innerHTML = "";
        		}
                
              }
            };
            xmlhttp.open("GET", "get_hint_mob.php?q=" + str, true);
            xmlhttp.send();
          
        }

    </script>

</head>

<body>
    <div class="w3l-signinform">
        <!-- container -->
        <div class="wrapper">
            <!-- main content -->
            <div class="w3l-form-info">
                <div class="w3_info">
                    <h1>FUTURE CARE</h1>
                    <p class="sub-para">Welcome Back</p>
                    <h2>Sign Up</h2>
                    <form method="post" name="myForm" onsubmit="return validateForm()">
                        <div class="input-group">
                            <span><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" placeholder="Sponser ID" required="" name="s_id" value="<?php echo $_GET[d_id];?>"  onKeyUp="showHint(this.value)" autofocus>
                        </div> 
                        <div class="input-group">
                            <span><i class="fa fa-user" aria-hidden="true"></i></span>
                            <?php
						    
						     function isNumber($c) {
                                return preg_match('/[0-9]/', $c);
                            }
                            $stringds=$_GET[d_id];
                               
                            $chars = '';
                            $d_id = '';
                            for ($index=0;$index<strlen($stringds);$index++) {
                                if(isNumber($stringds[$index]))
                                {
                                    $d_id .= $stringds[$index];
                                }
                                else {
                                    $chars .= $stringds[$index];}
                             
                            //echo $_GET[d_id];
                            //echo $d_id;
						    $fdf="SELECT * FROM `distributor` WHERE `d_id`='$d_id'";
						    $scv=$con->query($fdf);
						    $dckm=$scv->fetch_assoc();
						    }?>
                            <input type="text" placeholder="Sponser Name" required="" name="s_name" value="<?php echo $dckm[name];?>" id="txtHint" required="" readonly>
                            <span id="upline_msg" style="color: red"></span>
                        </div>
                        <div class="input-group">
                            <span><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" placeholder="Full Name" required="" name="name">
                        </div>
                        <div class="input-group">
                            <span><i class="fa fa-phone" aria-hidden="true"></i></span>
                            <input type="text" placeholder="Mobile No." required="" name="mobile"  onKeyUp="showHint_mob(this.value)">
                            <span id="text_mob" style="color: red"></span>
								<span id="text_mobw" style="color: red"></span>
								<input type="hidden" name="mobile_ck" value="Please Check Your Mobile Number" id="txtHint_mob" readonly />
                        </div>
                        <div class="input-group">
                            <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <input type="email" placeholder="Email ID" required="" name="email">
                        </div>
                        <div class="input-group">
                            <span><i class="fa fa-map" aria-hidden="true"></i></span>
                            <input type="text" placeholder="City" required="" name="city">
                        </div>
                       
                        <div class="input-group two-groop">
                            <span><i class="fa fa-key" aria-hidden="true"></i></span>
                            <input type="password" placeholder="Password" required="" name="password">
                        </div>
                        <div class="input-group two-groop">
                            <span><i class="fa fa-key" aria-hidden="true"></i></span>
                            <input type="password" placeholder="Confirm Password" required="" name="c_password">
                        </div>
                        
                       
                        <input type="submit" name="sub_reg" value="Sign Up" class="btn btn-primary btn-block"/>
                    </form>
                    
                
                    <p class="account">Already have an account? <a href="index.php">Sign In</a></p>
                </div>
            </div>
            <!-- //main content -->
        </div>
        <!-- //container -->
        <!-- footer -->
        <div class="footer">
            <p>&copy; 2021 Future Care. All Rights Reserved</p>
        </div>
        <!-- footer -->
    </div>

</body>

</html>
<?php
	if(isset($_POST[sub_reg]))
	{
	    
        
            $string=$_POST[s_id];
               
            $chars = '';
            $ssd_id = '';
            for ($index=0;$index<strlen($string);$index++) {
                if(isNumber($string[$index]))
                {
                    $ssd_id .= $string[$index];
                }
                else {
                    $chars .= $string[$index];}
            }
            
            
            //////////////////////////////
function password_generate($chars) 
{
  $data = '123456789';
  return substr(str_shuffle($data), 0, $chars);
}
for($x=0; $x<100; $x++)
{
    //echo $x;
    $d_id=password_generate(6);
    $sqsqqs="SELECT * FROM `distributor` WHERE `d_id`='$d_id'";
    $qur=$con->query($sqsqqs);
    if(mysqli_num_rows($qur)==0)
    {
        break;
    }
}

	    $s_d="SELECT * FROM `distributor` WHERE `d_id`='$ssd_id'";
	    $d=$con->query($s_d);
	    if($d->num_rows>0)
	    {
	        $mob_id="SELECT * FROM `distributor` WHERE `mobile`='$_POST[mobile]'";
	        $dsp_fd=$con->query($mob_id);
	        $dvgffid=$dsp_fd->fetch_assoc();
	        if($dsp_fd->num_rows==0)
	        {
	        
    	        $s_info=$d->fetch_assoc();
    	        if($s_info[a_status]=="y")
    	        {
    	        if($_POST[password]==$_POST[c_password])
    	        {
    	            $ss="INSERT INTO `distributor` (`d_no`, `d_id`, `s_id`, `name`, `mobile`, `dob`, `password`, `email`, `r_date`, `r_time`, `pancard_no`, `adharcard_no`, `bank_acc_no`, `bank_ifsc`, `bank_name`, `addreass`, `city`, `state`, `a_status`, `a_plan`, `global_status`) VALUES (NULL, '$d_id', '$ssd_id', '$_POST[name]', '$_POST[mobile]', '', '$_POST[password]', '$_POST[email]', '$date', '$time', '', '', '', '', '', '', '$_POST[city]', '', 'N', '0', 'N');";
    	            
    	            $ck="INSERT INTO `plan_income_manage` (`d_id`, `plan1`, `plan2`, `plan3`, `plan4`, `plan5`, `plan6`, `plan7`, `plan8`, `plan9`, `plan10`, `plan11`, `o1`, `o2`, `o3`, `o4`, `o5`, `o6`, `o7`, `o8`, `o9`, `o10`, `o11`) VALUES ('$d_id', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');";
    	            //$ss="INSERT INTO `distributor` (`d_id`, `s_id`, `name`, `dob`, `mobile`, `a_mobile`, `password`, `addreass`, `city`, `state`, `pancard_no`, `adhar_card_no`, `reg_date`, `reg_time`, `a_status`, `a_date`, `a_time`, `withdrawal_wallet`, `recharge_wallet`, `ludo_wallet`, `pin_wallet`, `pan_a`, `tds_wallet`, `block_status`, `shoping_point`, `kyc_status`, `main_wallet`) VALUES ('$d_id', '$ssd_id', '$_POST[name]', '', '$_POST[mobile]', '', '$_POST[password]', '', '', '', '', '', '$date', '$time', 'n', '', '', '0', '0', '0', '0', 'n', '0', 'n', '0', 'n', '0');";
    	            if($con->query($ss)===TRUE && $con->query($ck)===TRUE)
    	            {
    	                /*$message='Welcome '.$_POST[name].' You are sucessfully Register Your ID=DS'.$d_id.' and Pass='.$_POST[password].' Dreamsway Sure Pvt Ltd';
    	                $dd = str_replace(' ', '%20', $message);
    	$url = 'http://sms.hspsms.com/sendSMS?username=cmd&message='.$dd.'&sendername=NGACTY&smstype=TRANS&numbers='.$_POST[mobile].'&apikey=e8ab1258-683f-45cf-ab3e-082efac6a9b3';
    	$ch = curl_init($url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	$response = curl_exec($ch);
    	
    	$sms_query="INSERT INTO `sms_handling` (`sh_id`, `d_id`, `message`, `date`, `time`, `response`, `mobile`, `session_d_id`) VALUES (NULL, '$d_id', '$message', '$date', '$time', '$response', '$_POST[mobile]', '$_SESSION[d_id]');";
    	$con->query($sms_query);*/
    	                echo "<script>location.href='signup_detail.php?d_id=".$d_id."';</script>";
    	            }
    	        
    	            else{
    	                $ef="INSERT INTO `entry_fail_report` (`efr_id`, `date`, `time`, `d_id`, `admin_id`, `url`, `failed_query_n`) VALUES (NULL, '$date', '$time', '$_SESSION[d_id]', '', '$url', 'New Registration');";
    	                $con->query($ef);
    	                echo "<script>alert('Query Failed! Plz try again');location.href='registration.php';</script>";
    	                
    	            }
	        }else{
	            echo "<script>alert('Password And Confirm Password Did not Matched');location.href='registration.php';</script>";
	        }
	        
	        }else{
	            echo "<script>alert('You Cant Refer ID! First you should Active It');location.href='registration.php';</script>";
	        }
	        }else{echo "<script>location.href='signup_detail.php?d_id=".$dvgffid[d_id]."';</script>";}
	    }else{echo "<script>alert('Sponser Is incorrect plz try Again');location.href='registration.php';</script>";}
	}
	?>