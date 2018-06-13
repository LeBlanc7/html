<?php
   include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm = "SELECT * FROM LOC,THT WHERE LOC_NM='$_POS[loc]' AND THT_NM='$_POST[tht_nm]' AND LOC.LOC_NUM=THT.LOC_NUM";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
    if(oci_fetch_assoc($result))
    {
        echo ("<script>alert('DB에 같은 이름의 상영관이 존재합니다'); location.replace('insert_tht.html');</script>");
    }
    else{	
	$confirm = "SELECT COUNT(*) AS THTCOUNT FROM LOC,THT WHERE LOC.LOC_NM='$_POST[loc]' AND LOC.LOC_NUM=THT.LOC_NUM";
	$result = oci_parse($conn,$confirm);
	oci_execute($result);

	$row = oci_fetch_assoc($result);
	$tht_num = $row['THTCOUNT'] + 1;   

	$confirm = "SELECT * FROM LOC WHERE LOC_NM='$_POST[loc]'";
	$result = oci_parse($conn,$confirm);
	oci_execute($result);
	$row = oci_fetch_assoc($result);
	$loc_num = $row['LOC_NUM'];

	$query = "INSERT INTO THT(THT_NUM,LOC_NUM,THT_NM) VALUES ('$tht_num','$loc_num','$_POST[tht_nm]')";
	$stmt = oci_parse($conn,$query);
	$success = oci_execute($stmt,OCI_DEFAULT);
	if($success){
	// Commit transaction
	$committed = oci_commit($conn);
	// Test whether commit was successful. If error occurred, return error message
	if (!$committed) {
		$error = oci_error($conn);
		echo 'Commit failed. Oracle reports: ' . $error['message'];
		}
	}
	    
	$seat = $_POST['seatN'];
	if ( $seat == 240 )
	{
		for($i=1;$i<=240;$i++)
		{	
			if($i <= 20){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','A',$i)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);	
			}else if(20< $i && $i <= 40){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','B',$i-20)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(40< $i && $i <= 60){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','C',$i-40)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(60< $i && $i <= 80){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','D',$i-60)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(80< $i && $i <= 100){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','E',$i-80)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(100< $i && $i <= 120){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','F',$i-100)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(120< $i && $i <= 140){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','G',$i-120)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(140< $i && $i <= 160){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','H',$i-140)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(160< $i && $i <= 180){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','I',$i-160)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(180< $i && $i <= 200){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','J',$i-180)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(200< $i && $i <= 220){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','K',$i-200)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else{
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','L',$i-220)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}
			if($success){
				// Commit transaction
				$committed = oci_commit($conn);
				 // Test whether commit was successful. If error occurred, return error message
				if (!$committed) {
					$error = oci_error($conn);
					echo 'Commit failed. Oracle reports: ' . $error['message'];
				}
			}
		}
	}
	else{
		for($i=1;$i<=300;$i++)
		{	
			if($i <= 20){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','A',$i)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);	
			}else if(20< $i && $i <= 40){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','B',$i-20)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(40< $i && $i <= 60){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','C',$i-40)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(60< $i && $i <= 80){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','D',$i-60)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(80< $i && $i <= 100){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','E',$i-80)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(100< $i && $i <= 120){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','F',$i-100)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(120< $i && $i <= 140){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','G',$i-120)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(140< $i && $i <= 160){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','H',$i-140)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(160< $i && $i <= 180){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','I',$i-160)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(180< $i && $i <= 200){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','J',$i-180)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(200< $i && $i <= 220){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','K',$i-200)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(220< $i && $i <= 240){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','L',$i-220)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(240< $i && $i <= 260){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','M',$i-240)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else if(260< $i && $i <= 280){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','N',$i-260)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}else {
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','O',$i-280)";
				$stmt = oci_parse($conn,$query);
				$success = oci_execute($stmt,OCI_DEFAULT);
			}
			if($success){
				// Commit transaction
				$committed = oci_commit($conn);
				 // Test whether commit was successful. If error occurred, return error message
				if (!$committed) {
					$error = oci_error($conn);
					echo 'Commit failed. Oracle reports: ' . $error['message'];
				}
			}
		}
	}

	$query = "DROP SEQUENCE SEAT_SEQ";
	$stmt = oci_parse($conn,$query);
	$success = oci_execute($stmt,OCI_DEFAULT);
	if($success){
		// Commit transaction
		$committed = oci_commit($conn);
		 // Test whether commit was successful. If error occurred, return error message
		if (!$committed) {
			$error = oci_error($conn);
			echo 'Commit failed. Oracle reports: ' . $error['message'];
		}
	}		
	$query = "CREATE SEQUENCE SEAT_SEQ START WITH 1 INCREMENT BY 1 NOMAXVALUE MINVALUE 1";
	$stmt = oci_parse($conn,$query);
	$success = oci_execute($stmt,OCI_DEFAULT);
	if($success){
		// Commit transaction
		$committed = oci_commit($conn);
		 // Test whether commit was successful. If error occurred, return error message
		if (!$committed) {
			$error = oci_error($conn);
			echo 'Commit failed. Oracle reports: ' . $error['message'];
		}
	}

	echo("<script>alert('DB 입력에 성공하였습니다!'); location.replace('insert_tht.html');</script>");	
	
    }
?>
