<?php
   include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm = "SELECT PY_MTD_NM,DR FROM PY_MTD";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
    while($row=oci_fetch_row($result))
    {
	echo "<option value='$row[1]'> $row[0] </option>";	
    }
?>
