<?php
	include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
	// Parse SQL

	$confirm = "SELECT MV_NUM,SCH_DAY,SCR_STT_TIME,THT_NUM,LOC_NUM FROM SCR_SCH WHERE SCH_NUM = '$_GET[sch_num]'";
	$result = oci_parse($conn,$confirm);
	oci_execute($result);
	$row = oci_fetch_row($result);
	$mv_num = $row[0];
	$sch_day = $row[1];
	$scr_stt_time = $row[2];
	$tht_num = $row[3];
	$loc_num = $row[4];

	$confirm = "SELECT MV_NM,SCR_TIME FROM MV WHERE MV_NUM = '$mv_num'";
        $result = oci_parse($conn,$confirm);
        oci_execute($result);
        $row = oci_fetch_row($result);
        $mv_nm = $row[0];
	$scr_time = $row[1];	
	
	$scr_stt_time = $scr_stt_time / 100;
	$temp = (string)$scr_stt_time;
	$scr_stt_time_hour = substr($temp,0,2);
	$scr_stt_time_min = substr($temp,2,3);

	$hour = (int)($scr_time/60);
	$min = $scr_time%60;
	$scr_end_time = $scr_stt_time + $hour*100 + $min;

	$temp = (string)$scr_end_time;
	$scr_end_time_hour = substr($temp,0,2);
	$scr_end_time_min = substr($temp,2,3);

	$confirm = "SELECT LOC_NM FROM LOC WHERE LOC_NUM = '$loc_num'";
        $result = oci_parse($conn,$confirm);
        oci_execute($result);
        $row = oci_fetch_row($result);
        $loc_nm = $row[0];

	$confirm = "SELECT THT_NM FROM THT WHERE LOC_NUM = '$loc_num' AND THT_NUM='$tht_num'";
        $result = oci_parse($conn,$confirm);
        oci_execute($result);
        $row = oci_fetch_row($result);
        $tht_nm = $row[0];

	$query1 = "SELECT COUNT(*) AS COUNT FROM SEAT WHERE LOC_NUM='$loc_num' AND THT_NUM='$tht_num'";
        $temp1 = oci_parse($conn,$query1);
        oci_execute($temp1);
        $temp_row1 = oci_fetch_row($temp1);
        $seatN = $temp_row1[0];
		
	$query = "SELECT COUNT(*) AS COUNT FROM SEAT_AVAB WHERE SCH_NUM='$_GET[sch_num]' AND LOC_NUM='$loc_num' AND THT_NUM='$tht_num'";
        $temp = oci_parse($conn,$query);
        oci_execute($temp);
	$temp_row1 = oci_fetch_row($temp);
	$used = $temp_row1[0];
	$seat_avab = $seatN - $used;

	echo "<p>영화 이름 : $mv_nm </p>";
	echo "<p>지점 : $loc_nm </p>";
	echo "<p>상영관 : $tht_nm </p>";
	echo "<p>남은 좌석 : $seat_avab / $seatN </p>";
	echo "<p>상영 날짜 : $sch_day</p>";
	echo "<p>상영 시간 : $scr_stt_time_hour:$scr_stt_time_min ~ $scr_end_time_hour:$scr_end_time_min </p>";

?>

