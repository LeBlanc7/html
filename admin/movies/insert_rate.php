<?php
   include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm = "SELECT * FROM RT WHERE RT_NM='$_POST[rate]'";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
    if(oci_fetch_assoc($result))
    {
        echo ("<script>alert('DB에 같은 이름의 등급이 존재합니다'); location.replace('insert_rate.html');</script>");
    }
    else{
	$query = "INSERT INTO RT (RT_NUM,RT_NM) VALUES (RATE_SEQ.NEXTVAL,'$_POST[rate]')";
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
			echo("<script>alert('DB에 성공적으로 입력되었습니다!'); location.replace('insert_rate.html');</script>"); 
		}
	}
    	else {
		$err = oci_error($stmt);
		echo("<script>alert('DB 입력에 실패하였습니다!'); location.replace('insert_rate.html');</script>");	
	}
    }
?>
