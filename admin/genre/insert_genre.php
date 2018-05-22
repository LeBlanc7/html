<?php
   include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm = "SELECT * FROM MV_GNR WHERE GNR_NM='$_POST[genre]'";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
    if(oci_fetch_assoc($result))
    {
        echo ("<script>alert('DB에 같은 이름의 장르가 존재합니다'); location.replace('insert_genre.html');</script>");
    }
    else{

    	$query = "INSERT INTO MV_GNR (GNR_NUM,GNR_NM) VALUES (GENRE_SEQ.NEXTVAL,'$_POST[genre]')";
    	$stmt = oci_parse($conn,$query);
    
    	// Execute statement
    	oci_execute($stmt, OCI_DEFAULT);
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
			echo("<script>alert('DB에 성공적으로 입력되었습니다!'); location.replace('insert_genre.html');</script>"); 
		}
	}
    	else {
		$err = oci_error($stmt);
		echo("<script>alert('DB 입력에 실패하였습니다!'); location.replace('insert_genre.html');</script>");	
	}
    }
?>
