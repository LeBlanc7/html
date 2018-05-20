<?php
   include 'dbconnect.php';

   $stid = oci_parse($conn,'select * from DEPARTMENT');
   oci_execute($stid);

   while ($row = oci_fetch_assoc($stid)) {
    print_r($row);
    echo "<br>";
}

oci_free_statement($stid);
?>
