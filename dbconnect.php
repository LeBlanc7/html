<?php
// Create connection to Oracle

$server = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=mydbinstance.chbkz2j61mlx.ap-northeast-2.rds.amazonaws.com)(PORT=1521))(CONNECT_DATA=(SERVICE_NAME=ORCL)))";
$username = "YongJun";
$password = "123456789";

$conn = oci_connect($username, $password,$server,'AL32UTF8');
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
else {
   print "Connected to Oracle!";
}

?>
