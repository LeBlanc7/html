<?php
    include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm = "SELECT LOC_NUM FROM LOC WHERE LOC_NM = '$_POST[loc]'";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
    $row=oci_fetch_row($result);
    $loc_num = $row[0];

    $confirm = "SELECT THT_NUM FROM THT WHERE THT_NM = '$_POST[tht_nm]' AND LOC_NUM = '$loc_num'";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
    $row=oci_fetch_row($result);
    $tht_num = $row[0];
  
    $confirm = "SELECT SCR_SST_TIME FROM SCR_SCH WHERE LOC_NUM='$loc_num' AND THT_NUM = '$tht_num' AND SCH_DAY='$_POST[sch_day]'";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
     
    while($row=oci_fetch_row($result))
    {
	$data[] = array("time"=>$row[0]);	
    }
    echo json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	   
?>
