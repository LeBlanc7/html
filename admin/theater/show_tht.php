<?php
include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm = "SELECT LOC_NUM,LOC_NM FROM LOC";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
	echo "<p> 지점별 상영관 : </p>";
    while($row=oci_fetch_row($result))
    {
	$loc_num = $row[0];
	$loc_nm = $row[1];
	
	echo "<p> $loc_nm </p><p>";
	$confirm = "SELECT THT_NUM,THT_NM FROM THT WHERE LOC_NUM='$loc_num'";
    	$res = oci_parse($conn,$confirm);
    	oci_execute($res);
	while($temp=oci_fetch_row($res))
	{
		$tht_num = $temp[0];
		$tht_nm = $temp[1];
		
		$confirm = "SELECT COUNT(*) AS COUNT FROM SEAT WHERE LOC_NUM='$loc_num' AND THT_NUM='$tht_num'";
        	$resu = oci_parse($conn,$confirm);
        	oci_execute($resu);
		$temp_row = oci_fetch_row($resu);
		$seatN = $temp_row[0];
		
		echo "$tht_nm : $seatN 석 /";
	}
	echo "</p>";
		
    }
?>
