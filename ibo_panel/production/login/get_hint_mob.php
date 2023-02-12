<?php include("../../../database_connect.php");

$q = $_REQUEST["q"];

if(preg_match('/^[0-9]{10}+$/', $q)==1)
{

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
  $sqlkj="SELECT mobile FROM `distributor` WHERE `mobile`='$q'";
  $dfgh=$con->query($sqlkj);
	if($dfgh->num_rows > 0)
	{
	
	$hint="This Mobile Number is Already Register";
	}
	else
	{
	    $hint="Correct";
	}
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint;
}
else{ echo "Please Check Your Mobile Number";}
?>