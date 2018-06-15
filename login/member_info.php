<?php
	session_start();
		
	include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';	

	$mem_id = $_SESSION['user_id'];

	$confirm = "SELECT MEM_NM,PH_NUM,BTDY,PNT FROM MEM WHERE MEM_ID='$mem_id'";
    	$result = oci_parse($conn,$confirm);
    	oci_execute($result);
    	$row=oci_fetch_row($result);
    	
	echo "<p> 회원이름 : $row[0] </p>";	
	echo "<p> 연 락 처 : $row[1] </p>";
	echo "<p> 생년월일 : $row[2] </p>";
	echo "<p> 포인트 : $row[3] </p>";
    	

?>
