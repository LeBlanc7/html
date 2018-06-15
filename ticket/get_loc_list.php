<?php
	include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
	// Parse SQL
	$confirm = "SELECT DISTINCT LOC_NUM FROM SCR_SCH WHERE MV_NUM = '$_POST[mv_num]' ORDER BY LOC_NUM ASC";
	$result = oci_parse($conn,$confirm);
	oci_execute($result);
	
	while($row=oci_fetch_row($result))
	{
		$loc_num = $row[0];
		$query = "SELECT LOC_NUM,LOC_NM FROM LOC WHERE LOC_NUM='$loc_num'";
		$temp = oci_parse($conn,$query);
		oci_execute($temp);
		$temp_row = oci_fetch_row($temp);
			
		$data[] = array("loc_num"=>$temp_row[0],"loc_nm"=>$temp_row[1]);
	}
	
	echo json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

?>
