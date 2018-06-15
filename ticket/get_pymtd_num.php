<?php
	include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
	// Parse SQL
	$confirm = "SELECT PY_MTD_NUM,DR FROM PY_MTD WHERE PY_MTD_NM='$_POST[py_mtd_nm]'";
	$result = oci_parse($conn,$confirm);
	oci_execute($result);
	$row = oci_fetch_row($result);
	
	$data[] = array("py_mtd_num"=>$row[0],"dr"=>$row[1]);
		
	echo json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

