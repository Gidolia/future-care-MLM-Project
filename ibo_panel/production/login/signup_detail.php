<?php
include "../../../database_connect.php";
$rd="SELECT * FROM `distributor` WHERE `d_id`='$_GET[d_id]'";
$rm=$con->query($rd);
$fet=$rm->fetch_assoc();



?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Future Care</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <!-- //Meta tag Keywords -->
    <link href="//fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="all">
<style>
table, td, th {  
  border: 1px solid #FFF;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 15px;
  color: #FFF;
}
</style>
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
                    <h2>You Successfully Registered</h2>
                    <table border="1">
                        <tr><th>Name</th><td><?php echo $fet[name];?></td></tr>
                        <tr><th>User ID</th><th>FC<?php echo $fet[d_id];?></th></tr>
                        <tr><th>Password</th><th><?php echo $fet[password];?></th></tr>
                    </table>
                   
                    
                    <p class="account">Click Here To Login <a href="index.php">Login</a></p>
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