<?php
	include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm = "SELECT RT_NM FROM RT";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
	echo "<p> 등록된  : </p>";
    while($row=oci_fetch_row($result))
    {
	echo "$row[0]/ ";	
    }
?>
