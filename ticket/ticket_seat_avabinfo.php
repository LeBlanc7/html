<?php
	include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
	// Parse SQL
	$confirm = "SELECT THT_NUM,LOC_NUM FROM SCR_SCH WHERE SCH_NUM = '$_GET[sch_num]'";
	$result = oci_parse($conn,$confirm);
	oci_execute($result);
	$row = oci_fetch_row($result);
	$tht_num = $row[0];
	$loc_num = $row[1];

	$confirm = "SELECT COUNT(*) AS COUNT FROM SEAT WHERE THT_NUM='$tht_num' AND LOC_NUM='$loc_num'";
        $result = oci_parse($conn,$confirm);
        oci_execute($result);
	$temp = oci_fetch_row($result);
	$seatN = $temp[0];

	$confirm = "SELECT SEAT_NUM,SEAT_ROW,SEAT_COL FROM SEAT WHERE THT_NUM='$tht_num' AND LOC_NUM='$loc_num'";
	$result = oci_parse($conn,$confirm);
	oci_execute($result);
	
	if($temp == 240) 
	{
		int $i = 1;

		while($row = oci_fetch_row($result))
		{
			$seat_row = $row[1];
			$seat_col = $row[2];
			$seat_nm = $seat_row + $seat_col;
			
			if($i<=20)
			{

			}
			else if(20< $i && $i <=40)
			{

			}
			
			

			$i++;					

		}
	}
	else
	{

	}	
	
?>
