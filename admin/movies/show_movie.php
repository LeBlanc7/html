<?php
	include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm = "SELECT MV_NM,SCR_TIME,DIR_NM,DBTR_NM,ATR_NM FROM MV";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
	echo "<p> 등록된 영화 : </p>";
    while($row=oci_fetch_row($result))
    {
	    echo "<p> - 영화 제목 : $row[0] </p> ";	
        echo "<p> - 상영시간 : $row[1] 분 / 감독 : $row[2] / 배급사 : $row[3]</p> ";
        echo "<p> - 출연배우 : $row[4] </p> ";	
    }
?>
