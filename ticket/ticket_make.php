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
				echo "<script>alert('성공적으로 예매가 되었습니다.');location.replace('ticket_paying.html');</script>"; 
			}	
		}	
    		else {
			$err = oci_error($stmt);
			echo("<script>alert('DB 입력에 실패하였습니다!'); location.replace('ticket_paying.html');</script>");	
		}
		
	}

?>
