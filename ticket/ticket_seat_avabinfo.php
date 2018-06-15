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
		

	$i = 1;
	$flag = 0;

	while($row = oci_fetch_row($result))
	{
		$seat_num = $row[0];
		$seat_row = $row[1];
		$seat_col = $row[2];			
		$seat_nm = $seat_row.$seat_col;

		$confirm = "SELECT COUNT(*) AS COUNT FROM SEAT_AVAB WHERE THT_NUM='$tht_num' AND LOC_NUM='$loc_num' AND SCH_NUM='$_GET[sch_num]' AND SEAT_NUM='$seat_num'";
		$result1 = oci_parse($conn,$confirm);
		oci_execute($result1);
		$temp = oci_fetch_row($result1);
		$valid = $temp[0];

		if($valid>0)
		{
			if($flag==0)
			{
				echo "<div id='".$seat_row."'>";
				echo "<input type='checkbox' name='check[]' disabled value='".$seat_nm."'>";
				$flag = 1;
			}
			else
			{
				echo "<input type='checkbox' name='check[]' disabled value='".$seat_nm."'>";
			}
			if(($i%20)==0)
			{
				echo "</div>";
				$flag = 0;
			}
		}
		else
		{			
			if($flag==0)
			{
				echo "<div id='".$seat_row."'>";
				echo "<input type='checkbox' name='check[]' value='".$seat_nm."'>";
				$flag = 1;
			}
			else
			{
				echo "<input type='checkbox' name='check[]' value='".$seat_nm."'>";
			}
			if(($i%20)==0)
			{
				echo "</div>";
				$flag = 0;
			}					
		}
		$i++;					

	}
	
		
?>
