<?php
//error_reporting(E_ERROR | E_PARSE);
$host="localhost";
$username="futurecare";
$pass="futurecare123";
$db_name="futurecare";

/////////////////connection
$con=new MySQLi($host, $username, $pass, $db_name);

if($con->connect_error){
	die("connection failed: " . $con->connect_error);

}
date_default_timezone_set('Asia/Calcutta');
$time=date("H:i:s");
$date=date("Y-m-d");
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
$ipad=get_client_ip();
$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$site_open_info="INSERT INTO `site_open_info` (`soi_id`, `url`, `date`, `time`, `session_id`, `ip_addreass`, `admin_id`) VALUES (NULL, '$url', '$date', '$time', '$_SESSION[d_id]', '$ipad', '');";
$con->query($site_open_info);

?>