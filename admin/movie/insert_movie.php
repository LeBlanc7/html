<?php
   include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm1 = "SELECT * FROM MV WHERE MV_NM like '%$_POST[mv_nm]%'";
    $result = oci_parse($conn,$confirm1);
    oci_execute($result);
    if(oci_fetch_assoc($result))
    {
        echo ("<script>alert('DB에 같은 이름의 영화가 존재합니다'); location.replace('insert_movie.html');</script>");
    }
    else{
	// get RT_NUM from RT
	$confirm2 = "SELECT RT_NUM FROM RT WHERE RT_NM='$_POST[rate]'";
	$result2 = oci_parse($conn,$confirm2);
	oci_execute($result2);
	$row2 = oci_fetch_assoc($result2);
	$rt_num = $row2['RT_NUM'];

    	// GET GNR_NUM FROM MV_GNR
    	$confirm3 = "SELECT GNR_NUM FROM MV_GNR WHERE GNR_NM='$_POST[genre]'";
   	$result3 = oci_parse($conn,$confirm3);
    	oci_execute($result3);
    	$row3 = oci_fetch_assoc($result3);
    	$gnr_num = $row3['GNR_NUM'];

    	$query = "INSERT INTO MV(MV_NUM,MV_NM,DIR_NM,MV_INT,DBTR_NM,SCR_TIME,RT_NUM,GNR_NUM)VALUES
		 ('3','$_POST[mv_nm]','$_POST[dir_nm]','$_POST[mv_int]','$_POST[dbtr_nm]',
		  '$_POST[scr_time]','$rt_num','$gnr_num')";
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
			echo("<script>alert('DB에 성공적으로 입력되었습니다!'); location.replace('insert_movie.html');</script>"); 
		}
	}
    	else {
		$err = oci_error($stmt);
		echo("<script>alert('DB 입력에 실패하였습니다!'); location.replace('insert_movie.html');</script>");	
	}
    }
    oci_close($conn);
?>
