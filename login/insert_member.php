<?php
   // 회원가입 정보를 DB의 회원테이블(CTMR)에 입력하는 쿼리를 담은 php 파일

    include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm = "SELECT * FROM CTMR WHERE CTMR_ID='$_POST[id]'";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
    if(oci_fetch_assoc($result))
    {
        echo ("<script>alert('DB에 같은 이름의 ID가 존재합니다'); location.replace('member.html');</script>");
    }
    else{
    	$query = "INSERT INTO CTMR (CTMR_ID,CTMR_PW,CTMR_NM,PH_NUM,BTDY,PNT) VALUES ('$_POST[id]','$_POST[pw]','$_POST[mem_nm]','$_POST[ph_num]','$_POST[btdy]','0')";
    	$stmt = oci_parse($conn,$query);
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
			echo("<script>alert('회원가입이 되었습니다! 환영합니다.'); location.replace('/login/login.html');</script>"); 
		}
	}
    	else {
		$err = oci_error($stmt);
		echo("<script>alert('DB 입력에 실패하였습니다!'); location.replace('member.html');</script>");	
	}
    }
?>
