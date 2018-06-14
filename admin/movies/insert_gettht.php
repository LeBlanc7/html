<?php
    include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm = "SELECT THT.THT_NM FROM LOC,THT WHERE LOC.LOC_NUM=THT.LOC_NUM AND LOC.LOC_NM = '$_POST[loc]'";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
     
    while($row=oci_fetch_row($result))
    {
	$data[] = array("tht_nm"=>$row[0]);	
    }

    echo json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	   
?>
