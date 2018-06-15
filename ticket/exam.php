<?php
	session_start();
   include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $user = $_SESSION['user_id'];
                                        $que = "SELECT PNT FROM MEM WHERE MEM_ID = '$user' ";
                                        $res = oci_parse($conn,$que);
                                        oci_execute($res);
                                        $row=oci_fetch_row($res);
                                        $point = $row[0];
	
    echo "<script>alert($point);</script>";
   
    
?>
