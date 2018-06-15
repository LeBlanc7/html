<?php
	include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
	// Parse SQL
	$confirm = "SELECT THT_NUM FROM SCR_SCH WHERE SCH_NUM = '$_POST[sch_num]'";
	$result = oci_parse($conn,$confirm);
	oci_execute($result);
	
	while($row=oci_fetch_row($result))
	{
		$data[] = array("tht_num"=>$row[0]);
	}
	
	echo json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
?>
