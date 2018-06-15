<?php
	session_start();
	
	include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';

	if(isset($_SESSION['user_id']))
	{	
		$confirm = "SELECT PY_MTD_NUM FROM PY_MTD WHERE PY_MTD_NM='$_POST[py_mtd_nm]'";
		$result = oci_parse($conn,$confirm);
		oci_execute($result);
		$temp = oci_fetch_row($result);
		$py_mtd_num = $temp[0];

		$py_day = date("Ymd");
		$py_time = date("His");
	
		$query = "INSERT INTO PY (PY_NUM,PY_AVAB,PY_PRC,PY_DAY,PY_MTD_NUM,MEM_ID) VALUES (PY_SEQ.NEXTVAL,'Y','$_POST[money]','$py_day','$py_mtd_num','$_SESSION[user_id]')";
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
				for($i=0;$i<$_POST['seat_count'];$i++)
				{
					$var = (string)($i+1);
					$seat = "seat".$var;
					$seat_nm = $_POST[$seat];
					$seat_row = substr($seat_nm,0,1);
					$seat_col = substr($seat_nm,1);
			
					$sch_num = $_POST['sch_num'];
							
					$que = "SELECT THT_NUM,LOC_NUM FROM SCR_SCH WHERE SCH_NUM = '$sch_num' ";
                                        $res = oci_parse($conn,$que);
                                        oci_execute($res);
                                        $row=oci_fetch_row($res);
                                        $tht_num = $row[0];
                                       $loc_num = $row[1];
      	
					
					$que = "SELECT SEAT_NUM FROM SEAT WHERE THT_NUM='$tht_num' AND LOC_NUM='$loc_num' AND SEAT_ROW='$seat_row' AND SEAT_COL='$seat_col' ";
                                        $res = oci_parse($conn,$que);
                                        oci_execute($res);
                                        $row=oci_fetch_row($res);
                                        $seat_num = $row[0];
                                                                                
					$query1 = "INSERT INTO SEAT_AVAB(SEAT_AVAB_NUM,SCH_NUM,SEAT_NUM,THT_NUM,LOC_NUM) VALUES (SEAT_AVAB_SEQ.NEXTVAL,'$_POST[sch_num]','$seat_num','$tht_num','$loc_num')";
					$result1 = oci_parse($conn,$query1);
					$success1 = oci_execute($result1,OCI_DEFAULT);
					oci_commit($conn);
					
					$query1 = "INSERT INTO TCK(TCK_NUM,STD_PRC,TCKT_AVAB,RSV_DAY,RSV_TIME,SEAT_AVAB_NUM,PY_NUM) VALUES (TCK_SEQ.NEXTVAL,'8000','N','$py_day','$py_time',SEAT_AVAB_SEQ.CURRVAL,PY_SEQ.CURRVAL)";
                                        $result1 = oci_parse($conn,$query1);
                                        $success1 = oci_execute($result1,OCI_DEFAULT);
                                        oci_commit($conn);
					
					
				}
				echo "<script>alert('성공적으로 예매가 되었습니다.');location.replace('/index.html');</script>"; 
			}	
		}	
    		else {
			$err = oci_error($stmt);
			echo("<script>alert('예매에 실패하였습니다!'); location.replace('ticket.html');</script>");	
		}
	}
?>
