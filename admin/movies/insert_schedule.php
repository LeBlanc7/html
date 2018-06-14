<?php
    	include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   	// Parse SQL
    	$confirm = "SELECT * FROM MV WHERE MV_NM='$_POST[mv_nm]'";
	$result = oci_parse($conn,$confirm);
	oci_execute($result);
	$row = oci_fetch_assoc($result);
	$mv_num = $row['MV_NUM'];

	$confirm = "SELECT * FROM LOC WHERE LOC_NM='$_POST[loc]'";
	$result = oci_parse($conn,$confirm);
	oci_execute($result);
	$row = oci_fetch_assoc($result);
	$loc_num = $row['LOC_NUM'];

	$confirm = "SELECT * FROM THT WHERE THT_NM='$_POST[tht_nm]' AND LOC_NUM='$loc_num'";
	$result = oci_parse($conn,$confirm);
	oci_execute($result);
	$row = oci_fetch_assoc($result);
	$tht_num = $row['THT_NUM'];	

    	$confirm = "SELECT COUNT(*) AS COUNT FROM SCR_SCH WHERE LOC_NUM='$loc_num' AND MV_NUM ='$mv_num' AND SCH_DAY > '$_POST[sch_day]'";
    	$result = oci_parse($conn,$confirm);
    	oci_execute($result);
	$row = oci_fetch_assoc($result);
	$valid1 = $row['COUNT'] ;
	
	$confirm = "SELECT COUNT(*) AS COUNT FROM SCR_SCH WHERE LOC_NUM='$loc_num' AND MV_NUM ='$mv_num' AND SCH_DAY = '$_POST[sch_day]' AND SCR_STT_TIME > '$_POST[scr_stt_time]'";
        $result = oci_parse($conn,$confirm);
        oci_execute($result);
        $row = oci_fetch_assoc($result);
        $valid2 = $row['COUNT'] ;
        
    	if($valid1 > 0 ||$valid2 > 0)
    	{
        	echo ("<script>alert('해당 영화를 그 상영 기간에 등록할 수 없습니다.'); location.replace('insert_schedule.html');</script>");
    	}
    	else{
		$confirm = "SELECT COUNT(*) AS COUNT FROM SCR_SCH WHERE LOC_NUM='$loc_num' AND  MV_NUM ='$mv_num' AND SCH_DAY < '$_POST[sch_day]'";
        	$result = oci_parse($conn,$confirm);
        	oci_execute($result);
        	$row = oci_fetch_assoc($result);
        	$scr_tms = $row['COUNT'] ;
	
		$confirm = "SELECT COUNT(*) AS COUNT FROM SCR_SCH WHERE LOC_NUM='$loc_num' AND MV_NUM ='$mv_num' AND SCH_DAY = '$_POST[sch_day]' AND SCR_STT_TIME <= '$_POST[scr_stt_time]'";
        	$result = oci_parse($conn,$confirm);
        	oci_execute($result);
        	$row = oci_fetch_assoc($result);
        	$scr_tms = $scr_tms + $row['COUNT'] + 1;

		$query = "INSERT INTO SCR_SCH (SCH_NUM,MV_NUM,SCH_DAY,SCR_STT_TIME,SCR_TMS,THT_NUM,LOC_NUM) VALUES (SCH_SEQ.NEXTVAL,'$mv_num','$_POST[sch_day]','$_POST[scr_stt_time]','$scr_tms','$tht_num','$loc_num')";
    		$stmt = oci_parse($conn,$query);
    
    		// Execute statement
    		$success = oci_execute($stmt, OCI_DEFAULT);
    		if($success){
    		// Commit transaction
    		$committed = oci_commit($conn);
    		// Test whether commit was successful. If error occurred, return error message
		if (!$committed) {
			$error = oci_error($conn);
			echo 'Commit failed. Oracle reports: ' . $error['message'];
		}
		else
		{
			echo("<script>alert('DB에 성공적으로 입력되었습니다!'); location.replace('insert_schedule.html');</script>"); 
		}
	}
    	else {
		$err = oci_error($stmt);
		echo("<script>alert('DB 입력에 실패하였습니다!'); location.replace('insert_schedule.html');</script>");	
	}
    }
?>
