<?php
   include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $query = "INSERT INTO RT (RT_NUM,RT_NM) VALUES (RATE_SEQ.NEXTVAL,'$_POST[rate]')";
    $stmt = oci_parse($conn,$query);
    
    // Execute statement
    oci_execute($stmt, OCI_DEFAULT);
    
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
    
    oci_close($conn);
?>
