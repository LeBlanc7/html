<?php
include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm = "SELECT LOC_NM FROM LOC";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
	echo "<p> 등록된 지점 : </p>";
    while($row=oci_fetch_row($result))
    {
	echo "$row[0]/ ";	
    }
?>
