<?php
    include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm = "SELECT THT.THT_NM FROM LOC,THT WHERE LOC.LOC_NUM=THT.LOC_NUM AND LOC.LOC_NM = '왕십리'";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
        	
    echo "<script type='text/javascript'>";

    while($row=oci_fetch_row($result))
    {
	echo "$('#tht_nm').html('<option value=".$row[0]."> $row[0] </option>');";	

    }

    echo "</script>";

?>
