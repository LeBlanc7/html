<?php
   include 'dbconnect.php';

   $stid = oci_parse($conn,'select * from DEPARTMENT');
   oci_execute($stid);

   while ($row = oci_fetch_assoc($stid)) {
    echo $row['DEPTNO'], $row['DEPTNAME'];
        if(strcmp($row['DEPTNAME'],'영업')==0)
        {
                echo "<p>hi</p>";
        }
    echo "<br>";
}

oci_free_statement($stid);
?>
