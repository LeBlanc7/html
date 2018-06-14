<?php
	include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
	// Parse SQL
	$confirm = "SELECT DISTINCT SCH_DAY FROM SCR_SCH WHERE MV_NUM = '$_POST[mv_num]' AND LOC_NUM='$_POST[loc_num]' ORDER BY SCH_DAY ASC";
	$result = oci_parse($conn,$confirm);
	oci_execute($result);
	
	while($row=oci_fetch_row($result))
	{
		$data[] = array("sch_day"=>$row[0]);
	}
	
	echo json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
?>
