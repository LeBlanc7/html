<?php
	include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
	// Parse SQL
	$confirm = "SELECT DISTINCT THT_NUM FROM SCR_SCH WHERE MV_NUM = '$_POST[mv_num]' AND LOC_NUM='$_POST[loc_num]' AND SCH_DAY='$_POST[date_num]' ORDER BY THT_NUM ASC";
	$result = oci_parse($conn,$confirm);
	oci_execute($result);
	
	while($row=oci_fetch_row($result))
	{
		$tht_num = $row[0];
		$query = "SELECT SCH_NUM,SCR_STT_TIME FROM SCR_SCH WHERE MV_NUM = '$_POST[mv_num]' AND LOC_NUM='$_POST[loc_num]' AND SCH_DAY='$_POST[date_num]' AND THT_NUM='$tht_num' ORDER BY SCH_NUM ASC";
		$res = oci_parse($conn,$query);
		oci_execute($res);
		while($temp_row=oci_fetch_row($res))
		{
			$sch_num = $temp_row[0];
			$scr_stt_time = $temp_row[1];

			$query1 = "SELECT COUNT(*) AS COUNT FROM SEAT WHERE LOC_NUM='$_POST[loc_num]' AND THT_NUM='$tht_num'";
                        $temp1 = oci_parse($conn,$query1);
                        oci_execute($temp1);
                        $temp_row1 = oci_fetch_row($temp1);
                        $seatN = $temp_row1[0];


			$query = "SELECT COUNT(*) AS COUNT FROM SEAT_AVAB WHERE SCH_NUM='$sch_num' AND LOC_NUM='$_POST[loc_num]' AND THT_NUM='$tht_num'";
                	$temp = oci_parse($conn,$query);
                	oci_execute($temp);
			$temp_row1 = oci_fetch_row($temp);
			$used = $temp_row1[0];
			
			$seatN = $seatN - $used;			
			
			$data[] = array("tht_num"=>$tht_num,"sch_num"=>$sch_num,"scr_stt_time"=>$scr_stt_time,"seatN"=>$seatN);
		}		
	}
	
	echo json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
?>
