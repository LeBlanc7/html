<?php
// utf-8 setting
putenv("NLS_LANG=KOREAN_KOREA.KO16KSC5601");

// Create connection to Oracle

$server = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=mydbinstance.chbkz2j61mlx.ap-northeast-2.rds.amazonaws.com)(PORT=1521))(CONNECT_DATA=(SERVICE_NAME=ORCL)))";
$username = "YongJun";
$password = "123456789";

$conn = oci_connect($username, $password,$server);
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
else {
   print "Connected to Oracle!";
}

?>
