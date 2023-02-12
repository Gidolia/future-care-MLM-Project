<?php
include "../../../database_connect.php";
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login || Future Care</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <!-- //Meta tag Keywords -->
    <link href="//fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="all">

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
                    <h2>Log In</h2>
                    <form method="post">
                        <div class="input-group">
                            <span><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" placeholder="User ID" required="" name="id">
                        </div>
                        <div class="input-group two-group">
                            <span><i class="fa fa-key" aria-hidden="true"></i></span>
                            <input type="Password" placeholder="Password" required="" name="password">
                        </div>
                        <div class="form-row bottom">
                            <div class="form-check">
                                <input type="checkbox" id="remenber" name="remenber" value="remenber">
                                <label for="remenber"> Remember me?</label>
                            </div>
                            <a href="#url" class="forgot">Forgot password?</a>
                        </div>
                        <input type="submit" name="sub_login" value="Sign In" class="btn btn-primary btn-block"/>
                    </form>
                    <?php
	function isNumber($c) {
        return preg_match('/[0-9]/', $c);
    }
if(isset($_POST[sub_login]))
{
        $string=$_POST[id];
       
    $chars = '';
    $d_id = '';
    for ($index=0;$index<strlen($string);$index++) {
        if(isNumber($string[$index]))
        {
            $d_id .= $string[$index];
        }
        else {
            $chars .= $string[$index];}
        
    }
    session_start();
    if($chars=="FC" || $chars=="fc")
    {
        $sel="SELECT * FROM `distributor` WHERE `d_id`='$d_id' AND `password`='$_POST[password]'";
        $res=$con->query($sel);
        if ($res->num_rows > 0)
        {
          $_SESSION[d_id]=intval($d_id);
          $_SESSION[d_password]=$_POST[password];
          
          //echo $_SESSION[d_id];
    	  //echo $_SESSION[d_password];
          echo "<script>location.href='../';</script>";
        }
        else{
          	echo "<script>alert('Invalid user name or Password');
        	location.href='index.php';</script>";
        }
    }
    else{
          	echo "<script>alert('Invalid user name or Password');
        	location.href='index.php';</script>";
        }
}
?>	
                
                    <p class="account">Don't have an account? <a href="registration.php">Register</a></p>
                </div>
            </div>
            <!-- //main content -->
        </div>
        <!-- //container -->
        <!-- footer -->
        <div class="footer">
            <p>&copy; 2021 Future Care. All Rights Reserved </p>
        </div>
        <!-- footer -->
    </div>

</body>

</html>