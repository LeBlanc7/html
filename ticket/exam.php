<?php
   include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $que = "SELECT THT_NUM,LOC_NUM FROM SCR_SCH WHERE SCH_NUM = '42' ";
    $res = oci_parse($conn,$que);
    oci_execute($res);
    $row=oci_fetch_row($res);
    $tht_num = $row[0];
    $loc_num = $row[1];
	
    echo "<script>alert($tht_num);</script>";
    echo "<script>alert($loc_num);</script>";	
    
?>
