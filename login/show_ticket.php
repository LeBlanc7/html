<?php
	session_start();
		
	include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';	
	$mem_id = $_SESSION['user_id'];

	$confirm = "SELECT PY_NUM FROM PY WHERE MEM_ID='$mem_id'";
    	$result = oci_parse($conn,$confirm);
    	oci_execute($result);
    	
	while($row=oci_fetch_row($result)){
    		$py_num = $row[0];
		$que = "SELECT TCK_NUM,TCKT_AVAB,RSV_DAY,SEAT_AVAB_NUM,STD_PRC FROM TCK WHERE PY_NUM='$py_num'";
        	$res1 = oci_parse($conn,$que);
        	oci_execute($res1);
		while($temp = oci_fetch_row($res1)){

		$tck_num = $temp[0];
		$tckt_avab = $temp[1];
		$rsv_day = $temp[2];
		$seat_avab_num = $temp[3];
		$std_prc = $temp[4];

		$que = "SELECT SCH_NUM,SEAT_NUM,THT_NUM,LOC_NUM FROM SEAT_AVAB WHERE SEAT_AVAB_NUM='$seat_avab_num'";
                $res = oci_parse($conn,$que);
                oci_execute($res);
                $temp = oci_fetch_row($res);

		$sch_num = $temp[0];
		$seat_num = $temp[1];
		$tht_num = $temp[2];
		$loc_num = $temp[3];

		$que = "SELECT SEAT_ROW,SEAT_COL FROM SEAT WHERE SEAT_NUM='$seat_num'";
                $res = oci_parse($conn,$que);
                oci_execute($res);
                $temp = oci_fetch_row($res);
		$seat_row = $temp[0];
		$seat_col = $temp[1];
		$seat = $seat_row.$seat_col;

		$que = "SELECT MV_NUM,SCH_DAY,SCR_STT_TIME FROM SCR_SCH WHERE SCH_NUM='$sch_num'";
                $res = oci_parse($conn,$que);
                oci_execute($res);
                $temp = oci_fetch_row($res);
                $mv_num = $temp[0];
		$sch_day = $temp[1];
                $scr_stt_time = $temp[2];

		$que = "SELECT MV_NM,SCR_TIME FROM MV WHERE MV_NUM='$mv_num'";
                $res = oci_parse($conn,$que);
                oci_execute($res);
                $temp = oci_fetch_row($res);
                $mv_nm = $temp[0];
                $scr_time = $temp[1];

		$que = "SELECT LOC_NM FROM LOC WHERE LOC_NUM='$loc_num'";
                $res = oci_parse($conn,$que);
                oci_execute($res);
                $temp = oci_fetch_row($res);
                $loc_nm = $temp[0];
                
		$que = "SELECT THT_NM FROM THT WHERE THT_NUM='$tht_num'";
                $res = oci_parse($conn,$que);
                oci_execute($res);
                $temp = oci_fetch_row($res);
                $tht_nm = $temp[0];

		$stt_time = (string)$scr_stt_time;
		$stt_hour = substr($stt_time,0,2);
		$stt_min = substr($stt_time,2,2);

		echo "<p> - 티켓번호 : $tck_num / 좌석번호: $seat</p>";
		echo "<p>   영화제목 : $mv_nm  / 지점 : $loc_nm / 상영관 : $tht_nm  </p>";
		echo "<p>   상영날짜 : $sch_day  / 상영시작 : $stt_hour:$stt_min / 상영시간 : $scr_time 분 </p>";
		echo "<p>   표가격 : $std_prc / 예매일자 :$rsv_day / 발권여부 : $tckt_avab</p>";
		}
		
    	}
?>
