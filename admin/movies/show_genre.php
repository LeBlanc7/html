<?php
	include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm = "SELECT GNR_NM FROM MV_GNR";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);

	echo "<p> 등록된 장르 : </p>";
    while($row=oci_fetch_row($result))
    {
	echo "$row[0]/ ";	
    }
?>
