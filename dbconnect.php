<?php
// 오라클 서버와 웹페이지를 연결해주는 PHP

$server = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=mydbinstance.chbkz2j61mlx.ap-northeast-2.rds.amazonaws.com)(PORT=1521))(CONNECT_DATA=(SERVICE_NAME=ORCL)))";
$username = "YongJun";
$password = "123456789";

$conn = oci_connect($username, $password,$server,'AL32UTF8');
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}


?>
