<?php
   include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm = "SELECT * FROM THT WHERE THT_NM='$_POST[tht_nm]'";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
    if(oci_fetch_assoc($result))
    {
        echo ("<script>alert('DB에 같은 이름의 상영관이 존재합니다'); location.replace('insert_tht.html');</script>");
    }
    else{
	$seat = $_POST['seatN'];
	if ( $seat == 240 )
	{
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

		for($i=0;$i<240;$i++)
		{	
			if($i < 20){
				$query = "INSERT INTO SEAT(SEAT_NUM,THT_NUM,LOC_NUM,SEAT_ROW,SEAT_COL) VALUES (SEAT_SEQ.NEXTVAL,'$tht_num','$loc_num','A','$i')";
               	 		$stmt = oci_parse($conn,$query);
                		$success = oci_execute($stmt,OCI_DEFAULT);	
			}else if($i/20 == 1){

			}else if($i/20 == 2){

                        }else if($i/20 == 3){

                        }else if($i/20 == 4){

                        }else if($i/20 == 5){

                        }else if($i/20 == 6){

                        }else if($i/20 == 7){

                        }else if($i/20 == 8){

                        }else if($i/20 == 9){

                        }else if($i/20 == 10){

                        }else if($i/20 == 11){

                        }else{

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

		echo("<script>alert('240!'); location.replace('insert_tht.html');</script>");	
	}
	else
	{
		echo("<script>alert('300!'); location.replace('insert_tht.html');</script>");
	}
    }
?>
