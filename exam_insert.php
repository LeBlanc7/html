<?php

    include 'dbconnect.php';
   // Parse SQL
    $query = "INSERT INTO DEPARTMENT (DEPTNO,DEPTNAME,FLOOR) VALUES (DEPT_SEQ.NEXTVAL,'기획','5')";
    $stmt = oci_parse($conn,$query);

    /* Execute statement
       OCI_DEFAULT tells oci_execute() 
       not to commit statement immediately */
    oci_execute($stmt, OCI_DEFAULT);

    /*
    ....
    Parsing and executing other statements here ...
    ....
    */
    
    // Commit transaction
    $committed = oci_commit($conn);

    // Test whether commit was successful. If error occurred, return error message
    if (!$committed) {
        $error = oci_error($conn);
        echo 'Commit failed. Oracle reports: ' . $error['message'];
    }
    else
    {
	echo "<p>success!</p>";
    }
?>
