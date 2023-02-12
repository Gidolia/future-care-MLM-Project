<?php include("../../../database_connect.php");

$q = $_REQUEST["q"];
function isNumber($c) {
        return preg_match('/[0-9]/', $c);
    }
    $string=$q;
       
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
$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
  $sqlkj="SELECT name FROM `distributor` WHERE `d_id`='$d_id'";
  $dfgh=$con->query($sqlkj);
	if($dfgh->num_rows > 0)
	{
		$rfg=mysqli_fetch_assoc($dfgh);
		$hint=$rfg['name'];
	}
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "Please check your upline number" : $hint;
?>