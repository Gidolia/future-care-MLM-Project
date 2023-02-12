<?php include "../../../database_connect.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Future Care || Login</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post">
              <h1>Admin Login Form</h1>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                  <input type="submit" class="btn btn-default" name="submit_log" value="login">
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Future Care</h1>
                  <p>©2021 All Rights Reserved. Future Care</p>
                </div>
              </div>
            </form>
          </section>
        </div>
<?php
	function isNumber($c) {
        return preg_match('/[0-9]/', $c);
    }

if(isset($_POST[submit_log]))
{
    //echo "fd";
    session_start();

    $sel="SELECT * FROM `admin_password` WHERE `password`='$_POST[password]'";
    $res=$con->query($sel);
    if ($res->num_rows > 0)
    {echo "fd";
      
      $_SESSION[a_password]=$_POST[password];
      
      //echo $_SESSION[d_id];
	  //echo $_SESSION[d_password];
      echo "<script>location.href='index.php';</script>";
    }
    else{
        echo "fd";
      	echo "<script>alert('Invalid user name or Password');
    	location.href='login.php';</script>";
    }
    
}
?>

      </div>
    </div>
  </body>
</html>
