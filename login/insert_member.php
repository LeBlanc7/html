<?php
    include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm = "SELECT * FROM MEM WHERE ID='$_POST[id]'";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
    if(oci_fetch_assoc($result))
    {
        echo ("<script>alert('DB에 같은 이름의 ID가 존재합니다'); location.replace('member.html');</script>");
    }
    else{
	$rrnum = "$_POST[rrnum1]"."$_POST[rrnum2]";
	
	$query1 = "INSERT INTO CTMR(CTMR_NUM,MEM_AVAB) VALUES(CTMR_SEQ.NEXTVAL,'T')";
        $stmt1 = oci_parse($conn,$query1);
        $success1 = oci_execute($stmt1, OCI_DEFAULT);

    	$query2 = "INSERT INTO MEM (CTMR_NUM,ID,PW,MEM_NM,PH_NUM,RRNUM,PNT) VALUES (CTMR_SEQ.CURRVAL,'$_POST[id]','$_POST[pw]','$_POST[mem_nm]','$_POST[ph_num]','$rrnum','0')";
    	$stmt2 = oci_parse($conn,$query2);
    	$success2 = oci_execute($stmt2, OCI_DEFAULT);
    	
    	if($success1&&$success2){
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
